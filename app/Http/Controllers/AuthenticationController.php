<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInformation;
use GuzzleHttp\Exception\ClientException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class AuthenticationController extends Controller
{

  protected function createToken($user) {
    return $user->createToken(env('SANCTUM_USER_TOKEN_SECRET'))->plainTextToken;
  }

  /**
   * Generate resopnse with an embedded Authorisation header
   *
   * @param $response array
   * @param $token string
   * @param $status int
   * @return response
   *
   */
  protected function generateTokenisedResponse($response, $token, $status = 200) {

    return response($response, $status, [
      'Authorization' => 'Bearer '.$token
    ]);
  }

  /**
   * @param $provider
   * @return JsonResponse
   */
  protected function validateProvider($provider)
  {
    // TODO: Add providers here
    if (!in_array($provider, ['linkedin'])) {
      return response()->json(['message' => 'Please login using linkedin'], 422);
    }
  }

  public function register(Request $request)
  {
    $fields = $request->validate([
      'name' => 'string',
      'email' => 'required|email:rfc|string|unique:users,email',
      'password' => 'required|string|confirmed'
    ]);

    // Create user row
    $user = User::create([
      'name' => $fields['name'],
      'email' => $fields['email'],
      'password' => bcrypt($fields['password'])
    ]);

    // Create row in user_information table
    $user_info = UserInformation::create([
      'user_id' => $user->id,
      'role_id' => 1
    ]);

    // Generate firt token
    $token = $this->createToken($user);

    $response = [ 'user' => $user, 'info' => $user_info, 'token' => $token ];

    return $this->generateTokenisedResponse($response, $token);
  }

  public function signin(Request $request)
  {
    $fields = $request->validate(
      [
        'email' => 'required|email:rfc|string',
        'password' => 'required|string'
      ]
    );

    // Find user and respond if either it does not exist or if
    // the password does not match the hash
    $user = User::where('email', $fields['email'])->first();
    if (!$user || !Hash::check($fields['password'], $user->password))
      return response([ 'message' => 'Credentials not valid' ], 400);

    // Find other general information about user
    $userInfo = UserInformation::where('user_id', $user->id)->first();

    // Generate token
    $token = $this->createToken($user);

    $response = [ 'user' => $user, 'info' => $userInfo, 'token' => $token ];

    return $this->generateTokenisedResponse($response, $token);
  }

  public function signout()
  {
    // Delete all tokens
    if(auth()&&auth()->user()&&auth()->user()->tokens())
    auth()->user()->tokens()->delete();
    return [
      'message' => 'Signed out'
    ];
  }

  public function resetPassword(Request $request)
  {
    $fields = $request->validate([
      'current_password' => ['required', 'string'],
      'new_password' => ['required', 'string', 'confirmed']
    ]);

    $user = auth()->user();

    // Respond if either no one is found or if
    // the current password does not match
    if (!$user || !Hash::check($fields['current_password'], $user->password))
      return ['message' => 'Credentials not valid'];

    // Switch the current password with the new one
    $user->update(['password' => bcrypt($fields['new_password'])]);

    // Delete all current tokens and give them a new one
    // $this->signout();
    $token = $this->createToken($user);

    $response = [
      'message' => 'Password changed and all devices logged out',
      'user' => $user,
      'token' => $token,
    ];

    return redirect($request->query('redirect_to', '/feed'), 302,
      [
        'Authorization' => 'Bearer '.$token
      ]);

    // return $this->generateTokenisedResponse($response, $token);
  }

  public function forgotPassword(Request $request)
  {
    $fields = $request->validate([
      'email' => ['required', 'email:rfc', 'string']
    ]);

    // Find the user and respond if no one is found
    $user = User::where('email', $fields['email'])->first();
    if (!$user)
      return ['message' => 'User not found'];

    // Generate a temporary password
    $temporaryPassword = Str::random(12);

    // Switch the current password with the temporary one
    $user->update(['password' => bcrypt($temporaryPassword)]);

    // TODO: send email with the temporary password

    // Sign out of all clients
    $this->signout();

    // TODO: Change the message
    $response = [
      'message' => 'Feature under implementation, temporary password is '
        .$temporaryPassword
    ];

    return response($response);
  }

  /**
   * Obtain the user information from Provider.
   *
   * @param $provider
   * @return JsonResponse
   */
  public function handleCallback(Request $request, $provider)
  {
    $validated = $this->validateProvider($provider);
    if (!is_null($validated)) {
      return $validated;
    }
    try {
      $user = Socialite::driver($provider)->stateless()->user();
    } catch (ClientException $exception) {
      return response()->json([
        'message' => 'Invalid credentials provided.'
      ], 422);
    }

    $userCreated = User::firstOrCreate(
      [
        'email' => $user->getEmail()
      ],
      [
        'email_verified_at' => now(),
        'name' => $user->getName(),
        'status' => true,
      ]
    );
    $userCreated->providers()->updateOrCreate(
      [
        'provider' => $provider,
        'provider_id' => $user->getId(),
      ],
      [
        'avatar' => $user->getAvatar(),
      ]
    );

    // Find other general information about user
    $userInfo = UserInformation::updateOrCreate(
      [
        'user_id' => $userCreated->id,
      ],
      [
        ($provider.'_avatar') => $user->getAvatar(),
      ]
    );

    $token = $this->createToken($userCreated);
    $response = [
      'user' => $userCreated,
      'token' => $token,
      'info' => $userInfo,
      'provider' => $provider
    ];

    $json_response = json_encode($response);
    $encoded_response = base64_encode($json_response);
    $query_params = http_build_query(
      [
        'token'=> $encoded_response,
        'redirect_to' => $request->get('redirect_to')
      ]
    );
    return Redirect::to(env('CLIENT_DOMAIN').'/enter?'.$query_params);
  }

  /**
   * Redirect the user to the Provider authentication page.
   *
   * @param $provider
   * @return JsonResponse
   */
  public function redirectToProvider($provider)
  {
    $validated = $this->validateProvider($provider);
    if (!is_null($validated)) {
      return $validated;
    }

    return Socialite::driver($provider)->stateless()->redirect();
  }

}

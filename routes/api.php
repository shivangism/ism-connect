<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HereController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\FeedController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NoticeController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\download2Controller;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Available routes

// Auth
Route::post('/auth/register', [AuthenticationController::class, 'register']);
Route::post('/auth/signin', [AuthenticationController::class, 'signin']);
Route::post('/auth/password/forgot', [AuthenticationController::class, 'forgotPassword']);

// Social login
Route::get('/auth/{provider}', [AuthenticationController::class, 'redirectToProvider']);
Route::get('/auth/{provider}/callback', [AuthenticationController::class, 'handleCallback']);

// Here - sanbox routes
Route::get('/heres', [HereController::class, 'index']);
Route::get('/heres/{id}', [HereController::class, 'show']);

// Notification -- routes
Route::get('/notification', [NotificationController::class, 'index']);
Route::get('/notification/{id}', [NotificationController::class, 'show']);
// ----
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Protected routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::group(['middleware' => ['json']], function () {
        // Auth
        Route::post('/auth/signout', [AuthenticationController::class, 'signout']);
        Route::post('/auth/password/reset',
            [AuthenticationController::class, 'resetPassword']);

        // Here - sandbox routes
        Route::post('/heres', [HereController::class, 'store']);
        Route::put('/heres/{id}', [HereController::class, 'update']);
        Route::delete('/heres/{id}', [HereController::class, 'destroy']);

        // user - routes
        Route::get('/users', [UserController::class, 'index']);
        Route::get('/users/{id}', [UserController::class, 'show']);
        Route::put('/users/{id}',[UserController::class, 'update']);
        Route::delete('/users/{id}',[UserController::class, 'delete']);

        // feed - routes
        Route::post("/feedImages",[FeedController::class,'returnFeedImages']);
        Route::post('/findFeed',[FeedController::class,'returnFeeds']);
        Route::get('/feed', [FeedController::class, 'index']);
        Route::get('/feed/{id}', [FeedController::class, 'show']); //specific post
        Route::post('/feed', [FeedController::class, 'store']);
        Route::put('/feed/{id}', [FeedController::class, 'update']);
        Route::delete('/feed/{id}', [FeedController::class, 'delete']);

        // Comments
        Route::get('/comment', [CommentController::class, 'index']);
        Route::get('/comment/{id}', [CommentController::class, 'show']); //specific post
        Route::post('/comment', [CommentController::class, 'store']);
        Route::put('/comment/{id}', [CommentController::class, 'update']);
        Route::delete('/comment/{id}', [CommentController::class, 'delete']);

        // notification - routes
        Route::post('/findNotification',[NotificationController::class,'returnNotifications']);
        Route::get('/notification', [NotificationController::class, 'index']);
        Route::get('/notification/{id}', [NotificationController::class, 'show']);
        Route::post('/notification', [NotificationController::class, 'store']);
        Route::put('/notification/{id}', [NotificationController::class, 'update']);
        Route::delete('/notification/{id}', [NotificationController::class, 'delete']);

        //notices-routes
        Route::post('/findNotice',[NoticeController::class,'returnNotices']);
        Route::get('/notice', [NoticeController::class, 'index']);
        Route::get('/notice/{id}', [NoticeController::class, 'show']);
        Route::post('/notice', [NoticeController::class, 'store']);
        Route::put('/notice/{id}', [NoticeController::class, 'update']);
        Route::delete('/notice/{id}', [NoticeController::class, 'delete']);

        //mail
        Route::get('/mail',[Mail_Controller::class,'send_mail']);
    });
});

//Search routes

Route::get('/search',[SearchController::class,'search_all']);
Route::get('/download',[download2Controller::class,'download']);
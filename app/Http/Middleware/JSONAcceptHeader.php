<?php

namespace App\Http\Middleware;

// use \App\Http\Middleware\JSONAcceptHeader as Middleware;
use Closure;
use Illuminate\Http\Request;

class JSONAcceptHeader
{
    /**
     * Enforce json
     * Courtesy: [https://stackoverflow.com/a/44453966](https://stackoverflow.com/a/44453966)
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $request->headers->set('Accept', 'application/json');
        return $next($request);
    }
}

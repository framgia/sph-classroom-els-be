<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class cors
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', 'GET, POST, PUT, PATCH, DELETE, OPTIONS')
            ->header('Access-Control-Allow-Headers', ' Origin, Content-Type, Accept, Authorization, X-Request-With, DNT,User-Agent,X-Requested-With,If-Modified-Since,Cache-Control, Range')
            ->header('Access-Control-Allow-Credentials', ' true')
            ->header('Access-Control-Expose-Headers', 'Content-Length,Content-Range');
    }
}

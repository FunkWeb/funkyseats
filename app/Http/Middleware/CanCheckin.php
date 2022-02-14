<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CanCheckin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Request::ip() == config('checkin.checkin_ip') || Request::ip() == '127.0.0.1') {
            return $next($request);
        }

        abort(403, 'Sorry, you must be logged onto the office WiFi to perform this action');
    }
}

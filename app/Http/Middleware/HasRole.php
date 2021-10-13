<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Models\User;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        //hasRole might show as error depending on editor/ide, but it works
        if (auth()->check() && auth()->user()->hasRole($role)) {
            return $next($request);
        }

        App::abort(404);
    }
}

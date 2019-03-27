<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;


use Closure;


class CanView
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user = Auth::user();
        if( $user->canView())
            return $next($request);
        else
            return redirect('/');
    }
}

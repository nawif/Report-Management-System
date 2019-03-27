<?php

namespace App\Http\Middleware;

use Closure;
use App\Report;
use Illuminate\Support\Facades\Auth;

class canViewReport
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
        $report = Report::find($request->id)->where('group_id', $user->id);
        if( $user->canView() && $report)
            return $next($request);
        else
            return redirect('/');
    }
}

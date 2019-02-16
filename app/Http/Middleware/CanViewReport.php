<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Auth;


use Closure;
use App\Report;

class CanViewReport
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
        $authGroups=$user->getGroups();
        $report = Report::find($request->report_id);
        if(in_array($report->group(),$authGroups)){
            return $next($request);
        }
        dd('unauth');
        // return $next($request);
    }
}

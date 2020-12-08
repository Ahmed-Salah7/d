<?php

namespace App\Http\Middleware;

use Closure;

class AgencyStaff
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
        if( \Auth::check() &&  \Auth::user()->role_id == 3 ){
                return redirect('/office-work/cv');
        }
        return $next($request);
    }
}

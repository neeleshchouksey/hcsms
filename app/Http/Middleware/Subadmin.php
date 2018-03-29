<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class Subadmin
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
        
        if ( Auth::check() && Auth::guard('admin')->user()->role_id == '1' )
        {
            return $next($request);
        }
        elseif ( Auth::check() && Auth::guard('admin')->user()->role_id == '2' )
        {
            return $next($request);
        }

        return redirect('/admin/dashboard');
    }
}

<?php

namespace App\Http\Middleware;

use Closure;
use Session;


class isAdminLoggedOut
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
        $admin = Session::get('admin');

        if(!$admin && empty($admin)){
            return $next($request);    
        }

        return redirect()->route('reseller.admin-dashboard');
    }
}

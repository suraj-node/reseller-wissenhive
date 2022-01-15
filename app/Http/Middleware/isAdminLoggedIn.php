<?php

namespace App\Http\Middleware;

use Closure;
use Session;

class isAdminLoggedIn
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
        
        if(isset($admin) && !empty($admin)){

            return $next($request);

        }
        
        return redirect()->route('reseller.admin');
    }
}

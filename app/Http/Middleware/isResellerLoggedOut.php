<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Config;
use Closure;
use Session;

class isResellerLoggedOut
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
        $reseller = Session::get(Config::get('constant.reseller_session_key'));
        
        if(!$reseller && empty($reseller)){
            return $next($request);    
        }

        return redirect()->route('reseller.dashboard');
    }
}

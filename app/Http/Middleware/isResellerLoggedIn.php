<?php

namespace App\Http\Middleware;

use Illuminate\Support\Facades\Config;
use Closure;
use Session;
use App\Resellers;

class isResellerLoggedIn
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
        
        if($reseller && !empty($reseller)){
            
            $getinfo = Resellers::where('url',$reseller->url)->first();
            
            if($getinfo->status == 1){

                session()->forget(Config::get('constant.reseller_session_key'));
                session()->flush();
                return redirect()->route('web.login', ['company_name'=>$reseller->url])->with(['error'=>'Your account has been deactivated by the admin']);

            }

            return $next($request);
        }

        return redirect()->route('web.login');

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resellers;
use Redirect;
use Hash;
use Session;
use Illuminate\Support\Facades\Config;

class AuthController extends Controller
{
    public function index(Request $request, $companyName=Null){

    	if($companyName==Null){

    		return redirect('https://www.wissenhive.com/partner-programme');

    	}else{
    		
    		$resellers = Resellers::where('url',$companyName);

    		if($resellers->count() > 0){
    			return view('web.login', ['reseller'=>$resellers->first()]);	
    		}else{
				return redirect('https://www.wissenhive.com/partner-programme');    			
    		}
    		

    	}

    }

    public function login(Request $request){

    	$validatedData = $request->validate([
        		'email' 	=> 'required|email',
        		'password' 	=> 'required',
    		]);


    	$reseller = Resellers::where('email',$request->email);

    	if($reseller->count() > 0){

    		if($reseller->first()->status == 1){
				return Redirect::back()->with(['error'=>'Your account is temprory disable! Contact to admin for further']);    			
    		}else{
    			if(Hash::check($request->password, $reseller->first()->password)){

    				Session::put(Config::get('constant.reseller_session_key'), $reseller->first());

    				return redirect()->route('reseller.dashboard')->with(['success'=>'Welcome back']);

    			}else{
					return Redirect::back()->with(['error'=>'Invalid credentials provided! Contact to admin for further']);    				
    			}
    		}

    	}else{

    		return Redirect::back()->with(['error'=>'This email id is not registered with us! Contact to admin for further']);

    	}
    }



    public function logout(Request $request){
    	$url_string = '';
    	if(Session::has(Config::get('constant.reseller_session_key'))){
    		
    		$url = Session::get(Config::get('constant.reseller_session_key'));
    		$url_string = Session::get(Config::get('constant.reseller_session_key'))->url;
    		
            session()->forget(Config::get('constant.reseller_session_key'));
            session()->flush();
            return redirect()->route('web.login', ['company_name'=>$url_string])->with('success', 'You have been successfully Logged-out');
        }

    }
}

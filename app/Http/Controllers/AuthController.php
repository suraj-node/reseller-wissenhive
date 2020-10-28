<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resellers;
use Redirect;
use Hash;
use Session;
use Illuminate\Support\Facades\Config;
use App\ActivityLoggerTrait;

class AuthController extends Controller
{   

    use ActivityLoggerTrait;

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

                    $this->logActivity('Login at reseller portal', $reseller->first()->id, '0', 'Nothing to do');

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
    		$this->logActivity('Logout at reseller portal', $url->id, '0', 'Nothing to do');
            session()->forget(Config::get('constant.reseller_session_key'));
            session()->flush();
            return redirect()->route('web.login', ['company_name'=>$url_string])->with('success', 'You have been successfully Logged-out');
        }

    }

    public function verifyPassword(Request $request){

        $validatedData = $request->validate([
                'old_password'     =>  'required',
                'new_password'     =>  'required_with:confirm_password|same:confirm_password|min:8',
                'confirm_password' =>   'required',
            ]);

        $reseller = Session::get(Config::get('constant.reseller_session_key'));

        $reseller_password = $reseller->password;
        
        if(Hash::check($request->old_password, $reseller_password)){

            $update = Resellers::where('id',$reseller->id)->update(['password'=>Hash::make($request->new_password)]);

            if($update){
                $this->logActivity('Change password at reseller portal', $reseller->id, $reseller->id, 'Nothing to do');
                return response()->json(['done'=>'1', 200]);
            }

        }else{

            return response()->json(['custom_error'=>'Password doesnt match with our database! try again', 422]);

        }

    }

    public function forcedLogout(Request $request){

        $reseller = Session::get(Config::get('constant.reseller_session_key'));

        session()->forget(Config::get('constant.reseller_session_key'));
                session()->flush();
                return redirect()->route('web.login', ['company_name'=>$reseller->url])->with('success', 'Your password has been successfully updated! Kindly login again to configure your new settings');

    }
}

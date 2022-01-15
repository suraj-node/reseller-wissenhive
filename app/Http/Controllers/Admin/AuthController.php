<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Resellers;
use App\Admin;
use Hash;
use Session;
use Redirect;

class AuthController extends Controller
{
    public function index(Request $request){

        echo "hello world";

    }

    public function validateAdmin(Request $request){
		
        if($request->isMethod('post')){

    		$validatedData = $request->validate([
        		'email' => 'required|email',
        		'password' => 'required|string',
    		]);

             
    	$admin = Admin::where('email',$request->email)->first();
		
    	if($admin){
    		if($admin->account_status == 1){
    			return Redirect::back()->withErrors(['server_error'=>'Your account has been deactivated by one of the moderators']);	
    		}

    		if(Hash::check($request->password, $admin->password)){

    			Session::put('admin',$admin);
			
    			return redirect()->route('reseller.admin-dashboard');
				
    		}else{

    			return Redirect::back()->withErrors(['server_error'=>'Invalid credential! please check your email and password']);		
    		}

    	}else{


    		return Redirect::back()->withErrors(['server_error'=>'You are not registered with us']);
    	}

    	}else{
    		return view('web.login');
    	}

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resellers;

class AuthController extends Controller
{
    public function index(Request $request, $companyName=Null){

    	if($companyName==Null){

    		return redirect('https://www.wissenhive.com/partner-programme');

    	}else{
    		
    		$resellers = Resellers::where('url',$companyName)->first();

    		return view('web.login', ['reseller'=>$resellers]);

    	}

    }
}

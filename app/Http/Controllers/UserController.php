<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellerStudents;
use Session;
use Illuminate\Support\Facades\Config;

class UserController extends Controller
{
    public function index(Request $request){

    	$reseller = Session::get(Config::get('constant.reseller_session_key'));
    	
    	if(isset($reseller)){

    		$reseller_id = $reseller->id;
    		
    		$students = ResellerStudents::where('added_by',$reseller_id)->orderBy('fname','ASC')->get();

    		return view('dashboard.students', ['students'=>$students]);
    	}
    }

    public function enrollment(Request $request){

    	return view('dashboard.enroll');

    }
}

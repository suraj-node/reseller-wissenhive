<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellerStudents;
use Session;
use DB;
use Illuminate\Support\Facades\Config;
use App\ActivityLoggerTrait;

class UserController extends Controller
{   

    use ActivityLoggerTrait;

    public function index(Request $request){

    	$reseller = Session::get(Config::get('constant.reseller_session_key'));
    	
    	if(isset($reseller)){

    		$reseller_id = $reseller->id;
    		
    		$students = ResellerStudents::with('course_taken')->where('added_by',$reseller_id)->orderBy('fname','ASC')->get();

    		return view('dashboard.students', ['students'=>$students]);
    	}
    }

    
    public function addNewuser(Request $request){

    	$reseller = Session::get(Config::get('constant.reseller_session_key'));

    	$validatedData = $request->validate([
    			'fname'		=>	'required|alpha',
    			'lname'		=>	'required|alpha',
        		'email' 	=> 'required|email',
        		'mobile' 	=> 'required',
        		'country' 	=> 'required',
        		'status'	=>	'required',
    		], [

    			'fname.required'=>'First name is required', 'fname.alpha'=>'First name may only contains letters',
    			'lname.required'=>'Last name is required', 'lname.alpha'=>'Last name may only contains letters'
    		   ]);

    	$data = array(
    			
    				'fname' 	=> ucfirst($request->fname),
    				'lname' 	=> ucfirst($request->lname),
    				'email' 	=> $request->email,
    				'mobile' 	=> $request->mobile,
    				'country' 	=> $request->country,
    				'status' 	=> $request->status,
    				'added_by'	=> $reseller->id,
    			);


    	$create = ResellerStudents::create($data);

    	if($create){
            $string = 'Added a new student '.ucfirst($request->fname);

            $this->logActivity($string, $reseller->id, '0', 'Nothing to do','reseller');

    		return response()->json(['success'=>'Student successfully added', 200]);
    	}

    }


    public function updateStudent(Request $request){

    	$reseller = Session::get(Config::get('constant.reseller_session_key'));

    	$validatedData = $request->validate([
    			'fnameupd'		=>	'required|alpha',
    			'lnameupd'		=>	'required|alpha',
        		'emailupd' 	=> 'required|email',
        		'mobileupd' 	=> 'required',
        		'countryupd' 	=> 'required',
        		'statusupd'	=>	'required',
    		], [

    			'fnameupd.required'=>'First name is required', 'fnameupd.alpha'=>'First name may only contains letters',
    			'lnameupd.required'=>'Last name is required', 'lnameupd.alpha'=>'Last name may only contains letters',
    			'emailupd.required'=>'Email is required', 'email.email'=>'Invalid email id provided',
    			'mobileupd.required'=>'Mobile number is required',
    			'countryupd.required'=>'Country is required',
    			'statusupd.required'=>'Status is required',

    		   ]);

    	$data = array(
    			
    				'fname' 	=> ucfirst($request->fnameupd),
    				'lname' 	=> ucfirst($request->lnameupd),
    				'email' 	=> $request->emailupd,
    				'mobile' 	=> $request->mobileupd,
    				'country' 	=> $request->countryupd,
    				'status' 	=> $request->statusupd,
    				'added_by'	=> $reseller->id,
    			);


    	$update = ResellerStudents::where('id',$request->student_id)->update($data);

    	if($update){
            $string = 'Updated a existing student '.ucfirst($request->fnameupd);
            $this->logActivity($string, $reseller->id, '0', 'Nothing to do','reseller');
    		return response()->json(['success'=>'Student successfully updated', 200]);
    	}

    }

    public function updateUserStatus($value, $id){

            $reseller = Session::get(Config::get('constant.reseller_session_key'));
    		$student = ResellerStudents::where('id',$id);
            $changeValue = $student->update(['status'=>$value]);
            if($changeValue){
                $status = $value == 0 ? 'Verifed':'Not Verifed';
                $studentName = $student->first()->fname.' '.$student->first()->lname;
                $string = 'Updated the status of '.$studentName;
                $this->logActivity($string, $reseller->id, '0', 'Nothing to do','reseller');
                return redirect()->route('reseller.users')->with(['success'=>'Status successfully updated']);    
            } 
        
    }
}


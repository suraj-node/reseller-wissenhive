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
    		$qry = $request->user_type;

			if(isset($qry)){
				
				$students = ResellerStudents::with('course_taken')->where('added_by',$reseller_id)->where('type',$qry)->orderBy('fname','ASC')->get();
			}else{
				$students = ResellerStudents::with('course_taken')->where('added_by',$reseller_id)->orderBy('fname','ASC')->get();
			}

    		

    		return view('dashboard.students', ['students'=>$students]);
    	}
    }

    
    public function addNewuser(Request $request){

    	$reseller = Session::get(Config::get('constant.reseller_session_key'));

		$user_type = $request->type;

		$data = [];

    	$validatedData = $request->validate([
    			'fname'		=>	'required|alpha',
    			'lname'		=>	'required|alpha',
        		'email' 	=> 'required|email',
        		'mobile' 	=> 'required',
        		'country' 	=> 'required',
    		], [

    			'fname.required'=>'First name is required', 'fname.alpha'=>'First name may only contains letters',
    			'lname.required'=>'Last name is required', 'lname.alpha'=>'Last name may only contains letters'
    		   ]);
		

		if($user_type == 1){

			$validatedData = $request->validate([
    			'coated_amount'			=>	'required',
    			'interested_course'		=>	'required',
    		], [

    			'coated_amount.required'	=>'Coated amount is required',
    			'interested_course.required'=>'Enter the course name manually',
    		   ]);
		}

		if($user_type == 2){

			$validatedData = $request->validate([
    			'sales_amount'			=>	'required',
    			'amount_paid'			=>	'required',
				'balance'				=>	'required',
				'mode_of_payment'		=>	'required',
    		], [

    			'sales_amount.required'		=>'Sales amount is required',
    			'amount_paid.required'		=>'Enter paid amount',
				'balance.required'			=>'Balance if any',
				'mode_of_payment.required'	=>'Mode of payment is required',
    		   ]);


		}

    	$data = array(
    			
    				'fname' 	=> ucfirst($request->fname),
    				'lname' 	=> ucfirst($request->lname),
    				'email' 	=> $request->email,
    				'mobile' 	=> $request->mobile,
    				'country' 	=> $request->country,
    				'status' 	=> 0,
    				'added_by'	=> $reseller->id,
					'type'		=> $request->type,
					'coated_amount'		=>	$request->coated_amount ? $request->coated_amount:NULL,
					'interested_course'	=>	$request->interested_course ? $request->interested_course:NULL,
					'sales_amount'	=>	$request->sales_amount ? $request->sales_amount:NULL,
					'amount_paid'	=>	$request->amount_paid ? $request->amount_paid:NULL,
					'balance'	=>	$request->balance ? $request->balance:NULL,
					'mode_of_payment'	=>	$request->mode_of_payment ? $request->mode_of_payment:NULL,
					'linkedin_url'	=>	$request->linkedin_url ? $request->linkedin_url:NULL,
    			);
		
		
    	$create = ResellerStudents::create($data);

    	if($create){
            $string = 'Added a new student '.ucfirst($request->fname);
    		return response()->json(['success'=>'Student successfully added', 200]);
    	}

    }


    public function updateStudent(Request $request){
		
    	$reseller = Session::get(Config::get('constant.reseller_session_key'));
		$user_type = $request->type;
    	$validatedData = $request->validate([
			'fnameupd'		=>	'required|alpha',
			'lnameupd'		=>	'required|alpha',
			'emailupd' 		=> 'required|email',
			'mobileupd' 	=> 'required',
			'countryupd' 	=> 'required',
		], [

			'fname.required'=>'First name is required', 'fname.alpha'=>'First name may only contains letters',
			'lname.required'=>'Last name is required', 'lname.alpha'=>'Last name may only contains letters'
		   ]);

			if($user_type == 1){

				$validatedData = $request->validate([
					'coated_amountupd'			=>	'required',
					'interested_courseupd'		=>	'required',
				], [
	
					'coated_amountupd.required'	=>'Coated amount is required',
					'interested_courseupd.required'=>'Enter the course name manually',
					]);
			}
	
			if($user_type == 2){
	
				$validatedData = $request->validate([
					'sales_amountupd'			=>	'required',
					'amount_paidupd'			=>	'required',
					'balanceupd'				=>	'required',
					'mode_of_paymentupd'		=>	'required',
				], [
	
					'sales_amountupd.required'		=>'Sales amount is required',
					'amount_paidupd.required'		=>'Enter paid amount',
					'balanceupd.required'			=>'Balance if any',
					'mode_of_paymentupd.required'	=>'Mode of payment is required',
					]);
	
	
			}


			$data = array(
    			
					'fname' 	=> ucfirst($request->fnameupd),
    				'lname' 	=> ucfirst($request->lnameupd),
    				'email' 	=> $request->emailupd,
    				'mobile' 	=> $request->mobileupd,
    				'country' 	=> $request->countryupd,
    				'status' 	=> 0,
    				'added_by'	=> $reseller->id,
					'type'		=> $request->typeupd,
					'coated_amount'		=>	$request->coated_amountupd ? $request->coated_amountupd:NULL,
					'interested_course'	=>	$request->interested_courseupd ? $request->interested_courseupd:NULL,
					'sales_amount'	=>	$request->sales_amountupd ? $request->sales_amountupd:NULL,
					'amount_paid'	=>	$request->amount_paidupd ? $request->amount_paidupd:NULL,
					'balance'	=>	$request->balanceupd ? $request->balanceupd:NULL,
					'mode_of_payment'	=>	$request->mode_of_paymentupd ? $request->mode_of_paymentupd:NULL,
					'linkedin_url'	=>	$request->linkedin_urlupd ? $request->linkedin_urlupd:NULL,
			);
			
    	$update = ResellerStudents::where('id',$request->student_id)->update($data);

    	if($update){
            $string = 'Updated a existing student '.ucfirst($request->fnameupd);
            
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
                
                return redirect()->route('reseller.users')->with(['success'=>'Status successfully updated']);    
            } 
        
    }
}


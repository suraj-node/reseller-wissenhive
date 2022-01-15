<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ResellerStudents;
use App\Course;
use Session;
use Illuminate\Support\Facades\Config;
use App\Invoice;
use App\Resellers;
use DB;

class StudentController extends Controller
{
    public function index(Request $request){

        $students = ResellerStudents::orderBy('id','DESC')->get();
        
        return view('admin.students');
    }


    public function addNewuser(Request $request){

    	$reseller = Session::get(Config::get('constant.reseller_session_key'));

		$user_type = $request->type;

		$data = [];

    	$validatedData = $request->validate([
    			'fname'		=>	'required|alpha',
    			'lname'		=>	'required|alpha',
        		'email' 	=> 'required|email',
                'added_by'  =>  'required',
        		'mobile' 	=> 'required',
        		'country' 	=> 'required',
    		], [

    			'fname.required'=>'First name is required', 'fname.alpha'=>'First name may only contains letters',
    			'lname.required'=>'Last name is required', 'lname.alpha'=>'Last name may only contains letters',
                'added_by.required'=>'Reseller is mandatory'
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
    				'added_by'	=> $request->added_by,
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
    				'added_by'	=> $request->added_byupd,
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

	public function invoice(Request $request){

		$invoice = Invoice::orderBy('id','DESC')->get();

		if($invoice){
			foreach($invoice as $inv){
				$reseller = Resellers::where('id',$inv->reseller_id)->first();
				$candidate = ResellerStudents::where('id',$inv->candidate_id)->first();
				$inv->reseller_name = $reseller->company_name;
				$inv->candidate_name = $candidate->fname.' '.$candidate->lname;
			}
		}

		$updateStatus = Invoice::where('notification_status_admin',0)->update(['notification_status_admin'=>1]);

		return view('admin.invoice', ['invoices'=>$invoice]);

	}


	public function updateInvoice(Request $request){

		$admin = Session::get('admin');
		
		$validatedData = $request->validate([
			'admin_comment'		=>	'required',
		]);

		$data = [

			'admin_comment'	=>	$request->admin_comment,
			'status'		=>	$request->status,
			'notification_status_reseller'	=>	0,
			'admin_id'		=>	$admin->id,
		];

		$updateStatus = Invoice::where('id',$request->invoice_id)->update($data);

		if($updateStatus){

			return response()->json(['success'=>'Student successfully updated', 200]);
		}
	}

	public function remove($invoice_id){

		if($invoice_id){

			$delete = Invoice::where('id',$invoice_id)->delete();

			if($delete){

				return redirect()->route('reseller.admin-invoice');

			}

		}

	}

	public function enrollmentNotifications(Request $request){

		$notifications = DB::table('resellers_enroll_students')->get();

		if($notifications){
			foreach($notifications as $notify){
				$candidate = ResellerStudents::where('id',$notify->student_id)->first();
				$notify->student_name = $candidate->fname.' '.$candidate->lname;
				$reseller = Resellers::where('id',$notify->assign_by)->first();
				$notify->reseller_name = $reseller->company_name;
				$course = Course::where('id',$notify->course_id)->first();
				$notify->course_name = $course->title;
			}
		}

		$update = DB::table('resellers_enroll_students')->update(['notify_admin'=>0]);
		return view('admin.enrollmentnotifications', compact('notifications'));
	}

}

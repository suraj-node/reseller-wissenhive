<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellersEnrollStudents;
use App\ResellerStudents;
use App\Course;
use App\Invoice;
use Session;
use Illuminate\Support\Facades\Config;

class CourseController extends Controller
{
	public function index(Request $request){
                      
		//$course = ResellersEnrollStudents::with('course')->get()->groupBy('course_id');
		$course = Course::orderBy('id','DESC')->get();
		return view('dashboard.course', ['courses'=>$course]);

	}

	public function sendInvoice(Request $request){

		$reseller = Session::get(Config::get('constant.reseller_session_key'));

		$validatedData = $request->validate([
			'amount'			=>	'required',
			'course'			=>	'required',
		], [

			'amount.required'	=>'Amount is required',
			'course.required'=>'Enter the course name manually',
		   ]);
		

		$data = [

			'amount'					=>	$request->amount,
			'course'					=>	$request->course,
			'mode_of_payment'			=>	$request->mode_of_payment,
			'reseller_comment'			=>	$request->comment ? $request->comment:NULL,
			'notification_status_admin'	=>	0,
			'candidate_id'				=>	$request->candidate_id,
			'reseller_id'				=>	$reseller->id,
		];


		$create = Invoice::create($data);

		if($create){

			

			$update = ResellerStudents::where('id',$request->candidate_id);

			if($update->first()->type == 0){
				$update->update(['status'=>1, 'type'=>1]);
			}else{
				$update->update(['status'=>1]);
			}

			
			return response()->json(['success'=>'Invoice successfully sent', 200]);
		}

	}

}

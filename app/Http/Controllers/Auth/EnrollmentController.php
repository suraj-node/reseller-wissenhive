<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellerStudents;
use App\Course;
use App\Schedule;
use App\CourseOptions;
use Illuminate\Support\Facades\Config;
use App\ActivityLoggerTrait;
use Session;

class EnrollmentController extends Controller
{
	use ActivityLoggerTrait;

    public function index(Request $request){

    	$id = Session::get(Config::get('constant.reseller_session_key'))->id;

    	$users = ResellerStudents::where('added_by', $id)->get();
    	$course = Course::where('status',0)->get();

    	return view('enrollment.enroll', ['users'=>$users, 'courses'=>$course]);

    }

    public function getSchedule(Request $request){

    	$id = $request->id;
    	
    	$schedules = Schedule::where('course_id',$id)->get();

    	return response()->json(['data'=>$schedules], 200);

    }

    public function getAmount(Request $request){

    	$course_id = $request->course_id;
    	$schedule_id = $request->schedule_id;
    	$currency = $request->currency;

    	$amount = CourseOptions::where('course_id',$course_id)->where('id',$schedule_id)->first();
    	
    	if($currency == '1'){
    		return response()->json(['data'=>$amount->indian_price]);
    	}else{
    		return response()->json(['data'=>$amount->foreign_price]);
    	}

    }
}

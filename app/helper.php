<?php
use Illuminate\Support\Facades\Config;


if(!function_exists('countries')){

	function countries(){

		$countries = DB::table('countries')->get();

		return $countries;

	}

}

if(!function_exists('notification')){

	function notification(){

		$count = DB::table('invoice')->where('notification_status_admin',0)->count();

		return $count;

	}

}

if(!function_exists('notificationForReseller')){

	function notificationForReseller(){

		$reseller = Session::get(Config::get('constant.reseller_session_key'));

		$count = DB::table('invoice')->where('notification_status_reseller',0)->where('reseller_id',$reseller->id)->count();

		return $count;

	}

}

if(!function_exists('EnrollmentnotificationForAdmin')){

	function EnrollmentnotificationForAdmin(){
		
		$count = DB::table('resellers_enroll_students')->where('notify_admin',1)->count();

		return $count;

	}

}
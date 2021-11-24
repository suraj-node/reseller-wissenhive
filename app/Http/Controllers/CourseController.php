<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellersEnrollStudents;

class CourseController extends Controller
{
    

	public function index(Request $request){
                      
		$course = ResellersEnrollStudents::with('course')->get()->groupBy('course_id');
		
		return view('dashboard.course', ['courses'=>$course]);

	}

}

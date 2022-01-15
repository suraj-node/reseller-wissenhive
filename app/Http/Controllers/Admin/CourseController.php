<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Course;

class CourseController extends Controller
{
    public function index(Request $request){

        $courses = Course::orderBy('id','DESC')->get();

        return view('admin.course', ['courses'=>$courses]);

    }

    public function removeCourse($course_id){

        $course_id = base64_decode($course_id);

        $remove = Course::where('id', $course_id)->delete();

        if($remove){
            return redirect()->route('reseller.course')->with(['success'=>'Course successfully removed']);
        }else{
            return redirect()->route('reseller.course')->with(['server_error'=>'Failed to remove try again']);
        }

    }

    public function add(Request $request){

        return view('admin.course-add');

    }


    public function addMake(Request $request){

    	if($request->isMethod('post')){

    		$validatedData = $request->validate([
        		
        		'title' 		=> 'required',
    		]);

            if($request->amount == NULL && $request->one_on_one == NULL && $request->interview_preparation == NULL && $request->project_support == NULL){

                return redirect()->route('reseller.course-add')->with(['server_error'=>'Add atleast one amount field']);

            }else{
                
                $data = array(
    						
                    'title'  	    => $request->title,
                    'amount' 	    => $request->amount ? $request->amount:NULL,
                    'one_on_one' 	    => $request->one_on_one ? $request->one_on_one:NULL,
                    'interview_preparation' 	    => $request->interview_preparation ? $request->interview_preparation:NULL,
                    'project_support' 	    => $request->project_support ? $request->project_support:NULL,
                    'status'        => 0,
                );

                    $checkIfExist = Course::where('title', $request->title)->count();

                    if($checkIfExist > 0){
                        
                        return redirect()->route('reseller.course-add')->with(['server_error'=>'This course is already created! you can update it if you want']);

                    }else{

                        $create = Course::create($data);
                    
                        if($create){
                            return redirect()->route('reseller.course')->with(['success'=>'Course successfully created']);
                        }else{
                            return redirect()->route('reseller.course')->with(['server_error'=>'Failed create try again']);
                        }

                    }

            }

    	}

    }

    public function CourseInfo($course_id){

        if($course_id == Null){

    		return Redirect::back();

    	}else{

    		$course_id = base64_decode($course_id);

    		$course = Course::findOrFail($course_id);

    		return view('admin.course-edit', ['course'=>$course]);

    	}

    }

    public function editMake(Request $request){

        if($request->isMethod('post')){

            $course_id = $request->course_id;

    		$validatedData = $request->validate([
        		
        		'title' 		=> 'required',
    		]);

            if($request->amount == NULL && $request->one_on_one == NULL && $request->interview_preparation == NULL && $request->project_support == NULL){

                return redirect()->route('reseller.course-edit', ['course_id'=>base64_encode($course_id)])->with(['server_error'=>'Add atleast one amount field']);

            }else{

                $data = array(
    						
                    'title'  	    => $request->title,
                    'amount' 	    => $request->amount ? $request->amount:NULL,
                    'one_on_one' 	    => $request->one_on_one ? $request->one_on_one:NULL,
                    'interview_preparation' 	    => $request->interview_preparation ? $request->interview_preparation:NULL,
                    'project_support' 	    => $request->project_support ? $request->project_support:NULL,
                    'status'        => 0,
                );


                    
            
            

                    $getCourseInfo = Course::where('id', $course_id);
                
                    $update = Course::where('id', $course_id)->update($data);
                
                    if($update){
                        return redirect()->route('reseller.course')->with(['success'=>'Course successfully created']);
                    }else{
                        return redirect()->route('reseller.course')->with(['server_error'=>'Failed create try again']);
                    }

            }
    	}

    }

}

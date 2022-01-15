<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ResellerStudents;
use App\Course;
use App\Resellers;
use App\Schedule;
use App\ResellersEnrollStudents;
use App\UserCourseHistory;
use App\UserPaymentHistory;
use App\User;
use Hash;
use App\CourseOptions;
use Illuminate\Support\Facades\Config;
use App\ActivityLoggerTrait;
use Session;
use Carbon\Carbon;
use Mail;

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
    	$course_type = $request->course_type;
    	$currency = $request->currency;

    	$amount = CourseOptions::where('course_id',$course_id)->where('heading',$course_type)->first();
    	
    	if($currency == '1'){
    		return response()->json(['data'=>$amount->indian_price]);
    	}else{
    		return response()->json(['data'=>$amount->foreign_price]);
    	}

    }

    public function assignCourse(Request $request){
       
        $validatedData = $request->validate([
                '_student'     => 'required',
                '_course'      => 'required',
                '_amount'      => 'required',
                '_schedule_id' => 'required',
            ], ['_schedule_id.required'=>'Group training is required']);
        

        $id = Session::get(Config::get('constant.reseller_session_key'))->id;
        
        $assigner = Session::get(Config::get('constant.reseller_session_key'))->company_name;
        
        $course_type = '';
        $student = ResellerStudents::where('id',$request->_student)->first();
        $course = Course::find($request->_course);
        
        if($course){

            if($student){

            $data = array(

                        'student_id'  => $request->_student,
                        'course_id'   => $request->_course,
                        'schedule_id' => $request->_schedule_id,
                        'currency'    => 'usd',
                        'amount'      => $request->_amount,
                        'amount_status'=>$request->amount_status == 'on'? 0:1,
                        'assign_by'   => $id,
                        'notify_admin'=> 1,
                    );

            
            $ifExist_ = ResellersEnrollStudents::where('student_id',$request->_student)->where('course_id',$request->_course)->where('assign_by',$id);
            
            if($ifExist_->count() > 0){

                return response()->json(['error_msg'=>'This student is already registered with this course']);

            }else{
                $create = ResellersEnrollStudents::create($data);
                
                return response()->json(['success_msg'=>'User successfully assigned with selected course']);

                

                // if($create){
                    
                //     $userCourseHistory = array(

                //                                 'user_id'           =>  $request->_student,
                //                                 'user_email'        =>  $student->email,
                //                                 'course_id'         =>  $request->_course,
                //                                 'course_type'       =>  $request->_coursetype,
                //                                 'course_schedule'   =>  $request->_schedule,
                //                                 'course_amount'     =>  $request->_amount,
                //                                 'salt'              =>  $this->random_strings(20),
                //                                 'is_payment'        =>  1,
                //                             );

                //     $create_user_history = UserCourseHistory::create($userCourseHistory);

                //     if($create_user_history){
                        
                //         $UserPaymentHistory = array(

                //                                         'user_id'           =>  $request->_student,
                //                                         'course_id'         =>  $request->_course,
                //                                         'course_history_id' =>  $create_user_history->id,

                //                                    );

                //         $UserPaymentHistoryCreate = UserPaymentHistory::create($UserPaymentHistory);

                //         if($UserPaymentHistory){

                //             $checkUser = User::where('email',$student->email)->count();

                //             if(!$checkUser > 0){

                //                 $createUser = array(
                                                
                //                                 'fname'             => $student->fname,
                //                                 'lname'             => $student->lname,
                //                                 'avatar'            => 'default.png',
                //                                 'email'             =>  $student->email,
                //                                 'password'          =>  Hash::make($this->random_strings(20)),
                //                                 'country'           =>  $student->country,
                //                                 'mobile'            =>  $student->mobile,
                //                                 'dob'               =>  'None',
                //                                 'gender'            =>  'None',
                //                                 'ip_address'        =>  'None',
                //                                 'status'            =>  0,
                //                                 'user_type'         =>  0,
                //                                 'email_verified_at' =>  Carbon::now(),
                //                                 );

                //                 $userMake = User::create($createUser);

                //             }

                            
                //             // CODE FOR MAIL

                //             $fullname = ucfirst($student->fname).' '.$student->lname;

                //             if($request->course_type == 1){
                //                 $course_type = 'Selfpaced course';
                //             }else if($request->course_type == 2){
                //                 $course_type = 'Live Virtual course';
                //             }else{
                //                 $course_type = 'One On One Training';
                //             }

                //             $sender_email   = Config::get('constant.email_config.sender_email');
                //             $reciver_email  = $student->email; 
                //             $subject        = Config::get('constant.email_config.course_assigned_subject');

                //             $data = ['name'=>$fullname, 'assigner'=>ucfirst($assigner), 'date'=>Carbon::now(), 'course_type'=>$course_type, 'course_name'=>$course->title];
                            
                //             Mail::send('emails.enroll', ['data' => $data], function ($m) use ($data, $sender_email, $reciver_email, $subject) {
                //                 $m->from($sender_email, 'Wissenhive');
    
                //                 $m->to($reciver_email, $data['name'])->subject($subject);
                //             });

                //             // CODE FOR MAIL FINISHED

                //             $string = $assigner.' Assigned a new course to '.$fullname;

                            
                //             return response()->json(['success_msg'=>'User successfully assigned with selected course']);

                //         }

                //     }

                // }else{
                //     return 'failed to added';
                // }

            }

        }

      }
    }



    public function affiliateReport(Request $request){


        $reseller_id = Session::get(Config::get('constant.reseller_session_key'))->id;

        $students_records = ResellersEnrollStudents::with('students','course')->where('assign_by', $reseller_id)->orderBy('id','DESC')->get();
         
        return view('enrollment.affiliate', ['records'=>$students_records]);

    }

    private function random_strings($length_of_string){ 
              
                $str_result = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; 
              
                return substr(str_shuffle($str_result), 0, $length_of_string); 
            } 
}

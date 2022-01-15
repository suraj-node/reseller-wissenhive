<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Session;
use App\Resellers;
use App\ResellerStudents;
use App\ResellersEnrollStudents;
use DB;

class HomeController extends Controller
{
    public function index(Request $request){

        return view('admin.dashboard');

    }


    public function forcedLogout(Request $request){

        $reseller = Session::get('admin');

        session()->forget('admin');
                session()->flush();
                return redirect()->route('reseller.admin')->with('success', 'You have been successfully logged-out');

    }

    public function resellers(Request $request){


        $resellers = Resellers::orderBy('id', 'DESC')->get();

        return view('admin.resellers', ['resellers'=>$resellers]);

    }

    public function resellerRemove($reseller_id){

        $id = base64_decode($reseller_id);

        $get = Resellers::where('id', $id);

        if($get->count() > 0){

            $get->delete();
            return redirect()->route('reseller.admin-resellers')->with('success', 'Reseller successfully removed');
            
        }

    }

    public function resellerStudents($reseller_id){

        $id = base64_decode($reseller_id);
        
        $students = ResellerStudents::where('added_by', $id)->orderBy('id','DESC')->get();
        
        $countries = DB::table('countries')->get();
        $resellers = Resellers::orderBy('id','desc')->get();
        $admin = Resellers::where('id',$id)->first();
        
        if($students){

            foreach($students as $student){
                
                $check_status = ResellersEnrollStudents::where('student_id', $student->id)->get();

                $student->enrollment_status = $check_status;
            }
        }
        return view('admin.students', ['students'=>$students, 'countries'=>$countries, 'resellers'=>$resellers, 'admin'=>$admin]);

    }

}

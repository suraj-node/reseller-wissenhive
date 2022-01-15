<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Admin;
use Hash;

class AdminController extends Controller
{
    public function index(Request $request){

        $admins = Admin::orderBy('id','DESC')->get();

        return view('admin.admins', ['admins'=>$admins]);

    }

    public function removeAdmin($admin_id){

        $admin_id = base64_decode($admin_id);

        $remove = Admin::where('id', $admin_id)->delete();

        if($remove){
            return redirect()->route('reseller.admin-home')->with(['success'=>'Admin successfully removed']);
        }else{
            return redirect()->route('reseller.admin-home')->with(['server_error'=>'Failed to remove try again']);
        }

    }


    public function changePassword($admin_id){

        $admin_id = base64_decode($admin_id);
        
        return view('admin.admin-change-password', ['admin_id'=>$admin_id]);

    }


    public function changePasswordMake(Request $request){

        $validatedData = $request->validate([
            'password' 		=> 'required|min:8',
        ]);

        $update = Admin::where('id', $request->admin_id)->update(['password'=>Hash::make($request->password)]);

        if($update){
            return redirect()->route('reseller.admin-home')->with(['success'=>'Password successfully updated']);
        }else{
            return redirect()->route('reseller.admin-home')->with(['server_error'=>'Failed to update try again']);
        }

    }


    public function add(Request $request){

        return view('admin.admin-add');

    }

    public function addMake(Request $request){

    	if($request->isMethod('post')){

    		$validatedData = $request->validate([
        		'email' 		=> 'required|email|unique:resellers',
        		'password' 		=> 'required|min:8',
        		'full_name'	    =>  'required|string',
    		]);


    		
    		
    		$data = array(
    						'email' 		=> $request->email,
    						'password'  	=> Hash::make($request->password),
    						'name' 	        => ucwords($request->full_name),
    						
    					);
			
    		$create = Admin::create($data);
			
    		if($create){
    			return redirect()->route('reseller.admin-home')->with(['success'=>'Reseller successfully created']);
    		}else{
                return redirect()->route('reseller.admin-home')->with(['server_error'=>'Failed create try again']);
            }

    	}

    }

    public function AdminInfo($admin_id){

        if($admin_id == Null){

    		return Redirect::back();

    	}else{

    		$admin_id = base64_decode($admin_id);

    		$admin = Admin::findOrFail($admin_id);

    		return view('admin.admin-edit', ['admin'=>$admin]);

    	}

    }



    public function editMakeAdmin(Request $request){

    	if($request->isMethod('post')){

    		$validatedData = $request->validate([
        		'email' 		=> 'required|email|unique:resellers',
        		'full_name'	    =>  'required|string',
    		]);

    		$data = array(
    						'email' 		=> $request->email,
    						'name' 	        => ucwords($request->full_name),
    						
    					);
			
    		$update = Admin::where('id', $request->admin_id)->update($data);
			
    		if($update){
    			return redirect()->route('reseller.admin-home')->with(['success'=>'Admin successfully updated']);
    		}else{
                return redirect()->route('reseller.admin-home')->with(['server_error'=>'Failed to update try again']);
            }

    	}

    }
}

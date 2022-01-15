<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Image;
use File;
use App\Resellers;
use Hash;

class ResellerController extends Controller
{
    public function add(Request $request){

        return view('admin.reseller-add');

    }

    public function addMake(Request $request){

    	if($request->isMethod('post')){

    		$validatedData = $request->validate([
        		'email' 		=> 'required|email|unique:resellers',
        		'password' 		=> 'required|min:8',
        		'company_name'	=>  'required',
        		'logo'			=>	'required|mimes:jpeg,png,jpg,svg,webp',
        		'url'			=>	'required|unique:resellers,url',
				'profit'		=>  'required',
				'type'			=>  'required',
    		]);


    		$url = public_path('resellers/logo/');

    		if(!file_exists($url)) {mkdir($url, 0777, true);}

    		$ext = $request->logo->extension();
    		$avatar = time().'.'.$ext;
    		Image::make($request->logo)->save($url.$avatar);
    		
    		$data = array(
    						'email' 		=> $request->email,
    						'password'  	=> Hash::make($request->password),
    						'company_name' 	=> $request->company_name,
    						'logo' 			=> $avatar, 
    						'url'	 		=> str_replace(' ', '-', strtolower($request->url)),
							'profit'		=> $request->profit,
							'type'			=> $request->type,
    						'status'		=> 0,	
    					);
			
    		$create = Resellers::create($data);
			
    		if($create){
    			return redirect()->route('reseller.admin-resellers')->with(['success'=>'Reseller successfully created']);
    		}

    	}

    }

    public function getResellerInfo($reseller_id){

        if($reseller_id == Null){

    		return Redirect::back();

    	}else{

    		$reseller_id = base64_decode($reseller_id);

    		$reseller = Resellers::findOrFail($reseller_id);

    		return view('admin.reseller-edit', ['reseller'=>$reseller]);

    	}

    }


    public function editMake(Request $request){

    	if($request->isMethod('post')){

    		$validatedData = $request->validate([
        		'email' 		=> 'required|email|unique:resellers,email,'.$request->reseller_id,
        		'company_name'	=>  'required',
        		'url'			=>	'required|unique:resellers,url,'.$request->reseller_id,
				'profit'		=>  'required',
				'type'			=>  'required',
    		]);

    		$oldLogo = substr($request->reseller_old_logo, strrpos($request->reseller_old_logo, 'reseller'));
			
            $filename = '';

    		if($request->hasFile('logo')){
    			
                $url = public_path('resellers/logo/');

    			$validatedData = $request->validate(['logo'=>'mimes:jpeg,png,svg,jpg,webp']);
    			
    			$ext = $request->logo->extension();
    			$filename = time().'.'.$ext;
			
                $newImage = Image::make($request->logo)->save($url.$filename);

    			
    			File::delete($url.$oldLogo);
    			
    		}else{
    			$filename = $oldLogo;
    		}


    		$data = array(
    						'email' 		=> $request->email,
    						'company_name' 	=> $request->company_name,
    						'logo' 			=> $filename, 
    						'url'	 		=> str_replace(' ', '-', strtolower($request->url)),
							'profit'		=> $request->profit,
							'type'			=> $request->type,
    					);

    		$update = Resellers::where('id',$request->reseller_id)->update($data);

    		if($update){

    			return redirect()->route('reseller.admin-resellers')->with(['success'=>'Reseller successfully updated']);

    		}

    	}

    }


    public function changePassword($reseller_id){

        $reseller_id = base64_decode($reseller_id);
        
        return view('admin.change-password', ['reseller_id'=>$reseller_id]);

    }

    public function changePasswordMake(Request $request){

        $validatedData = $request->validate([
            'password' 		=> 'required|min:8',
        ]);

        $update = Resellers::where('id', $request->reseller_id)->update(['password'=>Hash::make($request->password)]);

        if($update){
            return redirect()->route('reseller.admin-resellers')->with(['success'=>'Password successfully updated']);
        }else{
            return redirect()->route('reseller.admin-resellers')->with(['server_error'=>'Failed to update try again']);
        }

    }

}

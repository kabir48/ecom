<?php

namespace App\Http\Controllers\Admin;

use DB;
use App\Policy;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use File;
use Session;

class PolicyController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    
    public function index(){
        Session::put('page','policy');
        $data['title']="Policy and Privacy Page";
        $data['policyCount']=Policy::where('status',1)->count();
        $data['policies']=Policy::where('status',1)->get();
        return view('admin.policy.index',$data);
    }
    
  
     
    public function store(Request $request,$id=null){
         
        if($id==''){
            $title="Privacy And Policy Page";
            $message="Page Created Succssfully";
            $policy=new Policy();
        }else{
            $title="Privacy And Policy Page";
            $message="Page Updated Succssfully";
            $policy=Policy::find($id);  
        }
        
        if($request->isMethod('post')){
            
            $data=$request->all();
            $policy->name_en= $data['name_en'];
            $policy->name_bn=$data['name_bn'];
            $policy->detail_bn=$data['detail_bn'];
            $policy->detail_en=$data['detail_en'];
            if ($request->hasFile('banner')) {
                if(!empty($policy->banner)){
                    $policy =Policy::find($id);
                    $location='public/media/policy/'.$policy->banner;
                    if(File::exists($location)){
                        File::delete($location);
                    }
                }
                $image_tmp = $request->file('banner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.' . $extension;
                    $path = 'public/media/policy/' . $imageName;
                    Image::make($image_tmp)->resize(1000,284)->save($path,60);
                    $policy->banner = $imageName;
                }
            }
            $policy->save();
            Session::flash('success',$message);
            return redirect('admin/policy-lists');
        }
        return view('admin.policy.create',compact('title','policy'));
        
     }


}

<?php

namespace App\Http\Controllers\Admin;

use App\VoiceCustomer;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class VoiceCustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $voice=VoiceCustomer::all();
        return view('admin.voice.index',compact('voice'));
    }
    public function addEdit(Request $request,$id=null){
        if($id==''){
            $title='Add customer Voices';
            $message="Successfully customer Voices Added";
            $voice=new VoiceCustomer;
        }else{
            $title='Updated customer Voices';
            $message="Successfully customer Voices Updated";
            $voice=VoiceCustomer::find($id);
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $voice->name=$data['name'];
            $voice->name_bangla=$data['name_bangla'];
            $voice->comment=$data['comment'];
            $voice->comment_bangla=$data['comment_bangla'];
            if($request->hasFile('image_one')){
            	$image_tmp = $request->file('image_one');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =$image_name.'-'.rand(111,99999).'.'.$extension;
                    $flygar_path_one = 'public/media/voice/'.$imageName;
     				Image::make($image_tmp)->resize(70,70)->save($flygar_path_one);
     				$voice->image_one = $imageName;
                }
            }
            $voice->save();
            $notification=array(
                 'messege'=>'Query Has Been Placed Successfully!',
                 'alert-type'=>'success'
                       );
        return Redirect('admin/voice-customer-comment-add-index')->with($notification);
        }
        return view('admin.voice.create',compact('title','voice'));
    }
     public function Inactive($id)
    {
         VoiceCustomer::where('id',$id)->update(['status'=> 1]);
         $notification=array(
                     'messege'=>'Successfully  Active ',
                     'alert-type'=>'success'
                    );
         return Redirect()->back()->with($notification);
    }

    public function Active($id)
    {
        VoiceCustomer::where('id',$id)->update(['status'=> 0]);
         $notification=array(
                     'messege'=>'Successfully  inAactive ',
                     'alert-type'=>'success'
                    );
         return Redirect()->back()->with($notification);
    }

}

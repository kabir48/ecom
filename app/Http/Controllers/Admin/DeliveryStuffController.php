<?php

namespace App\Http\Controllers\Admin;

use App\District;
use App\DeliveryStuff;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
class DeliveryStuffController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $delivery=DeliveryStuff::where('status',1)->get();
        return view('admin.Delivery.index',compact('delivery'));
    }
    public function addEdit(Request $request,$id=null){
        $districts=District::where('status',1)->get()->toArray();
        if($id == ""){
            $title="Add New Delivery Stuffs";
            $delivery=new DeliveryStuff;
             $message="Delivery Stuff Added Successfully!";
        }else{
            $title="Update Delivery Stuffs";
             $delivery=DeliveryStuff::find($id);
             $message="Delivery Stuff Update Successfully!";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $this->validate($request,[
                'name'=>'required',
                'phone'=>'required',
                'address'=>'required',
            ]);
            //echo"<pre>";print_r($data);die;
            $delivery->name=$data['name'];
            $delivery->email=$data['email'];
            $delivery->phone=$data['phone'];
            $delivery->city=$data['city'];
            $delivery->address=$data['address'];
            $delivery->status=1;
            // Upload Image
            if($request->hasFile('image_one')){
            	$image_tmp = $request->file('image_one');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name=$image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =$image_name.'-'.rand(111,99999).'.'.$extension;
                    $bpticar_path = 'public/media/deliveryman/'.$imageName;
     				Image::make($image_tmp)->resize(90,70)->save($bpticar_path);
     				$delivery->image_one = $imageName;
                }
            }
            $delivery->save();
            $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
        return Redirect()->route('admin.deliveryman.stuff')->with($notification);
    }
    return view('admin.Delivery.create',compact('title','delivery','districts'));


    }
}

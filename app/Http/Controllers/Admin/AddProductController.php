<?php

namespace App\Http\Controllers\Admin;

use App\ProductAdd;
use App\User;
use App\Subscriber;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Session;
use File;
use DB;
use Mail;
class AddProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
  public function index(){
      Session::put('page','adds');
      $title="Adds Banner";
      $data=ProductAdd::get();
      return view('admin.productadd.index',compact('data','title'));

  }
   public function addEdit(Request $request,$id=null){

        if($id==""){
            $title="Advertise Information";
            $addproduct=new ProductAdd;
            $message="Add  Added Successfully!";

        }else{
            $title="Updated Information";
            $addproduct=ProductAdd::find($id);
            $message="Advertise UPDATED Successfully!";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            //echo"<pre>";print_r($data);die;
            $addproduct->add_title=$data['add_title'];
            $addproduct->date=$data['date'];
            $addproduct->add_short_detail=$data['add_short_detail'];
            $addproduct->location=$data['location'];
            if($data['location']==="listing"){
                $addproduct->status=1;
            }else{
                $addproduct->status=0; 
            }
           
            if($request->hasFile('image_one')){
                if(!empty($addproduct->image_one)){
                     $location='public/media/addproduct/'.$addproduct->image_one;
                    // dd($location_three);
                     if(File::exists($location)){
                         //dd('ok');
                         File::delete($location);
                     }
                }
            	$image_tmp = $request->file('image_one');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $imageName =rand(111,99999).'.'.$extension;
                    $flygar_path_one = 'public/media/addproduct/'.$imageName;
     				Image::make($image_tmp)->save($flygar_path_one);
     				$addproduct->image_one = $imageName;
                }
            }
            $addproduct->save();
            Session::flash('success',$message);
        return Redirect()->route('admin.index-addproduct');
    }
    return view('admin.productadd.create',compact('title','addproduct'));

  }
  
    public function sendMail($id){
        $message="Email Send Successfully";
        $addproduct=ProductAdd::find($id); 
        if($addproduct->status==0){
            $addproduct->status=1;
            $addproduct->save();
            if($addproduct['location']==="front"){
                $users=Subscriber::latest()->get();
                $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                foreach($users as $user){
                   $email=$user->email;
                   list($localPart, $domain) = explode('@', $email);
                   $name = $localPart;
                   $name = str_replace('.', ' ', $name);
                   $name = ucwords($name);
                   $messageData=
                    [
                       'name'=>$name,
                       'title'=>$addproduct->add_short_detail,
                       'messageView'=>$addproduct->add_short_detail,
                       'banner'=>'https://bigbenbd.com/public/media/addproduct/'.$addproduct->image_one,
                       'sitesetting'=>$sitesetting,
                       
                    ];
                    Mail::send('emails.ads',$messageData,function($message)use ($email){
                        $message->to($email)->subject('Offer Offer!!');
                    });
                }
                
            }
            
            Session::flash('success',$message);
            return Redirect()->route('admin.index-addproduct');
        }
    }
    public function deleteAds($id){
        $addproduct=ProductAdd::find($id);
        $location='public/media/addproduct/'.$addproduct->image_one;
        // dd($location_three);
        if(File::exists($location)){
             //dd('ok');
            File::delete($location);
        }
        $addproduct->delete();
        Session::flash('success','Ads Deleted');
        return Redirect()->route('admin.index-addproduct');
    }
}

<?php

namespace App\Http\Controllers\Ladystore;

use App\Product;
use App\LadyBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Image;
use DB;
use App\AboutLady;

class LadystoreController extends Controller
{
    //

     public function __construct()
    {
        $this->middleware('auth:admin');
    }



       public function Bannerindex(){
       $tear=DB::table('ladybanners')->get()->count();
        $ladybanner=DB::table('ladybanners')->get()->toArray();
        //echo "<pre>",print_r($ladybanner);die;
        return view('Ladystore.banner.index',compact('ladybanner','tear'));
    }
    public function create(){
       return view('Ladystore.banner.create');
    }
    public function edit($id){
        $data['alldata']=DB::table('ladybanners')->find($id);
        return view('Ladystore.banner.create',$data);
     }
     public function store(Request $request){
         $this->validate($request,[
             'product_name'=>'required|max:60',
             'product_name_bangla'=>'required|max:60',
             'meta_title'=>'required|max:40',
             'meta_title_bangla'=>'required|max:40',
             'event_status'=>'required|max:40',
             'event_status_bangla'=>'required|max:40',
             'discount_status'=>'required|max:40',
             'discount_status_bangla'=>'required|max:40',
         ]);
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_title_bangla']=$request->meta_title_bangla;
        $data['product_name']=$request->product_name;
        $data['product_name_bangla']=$request->product_name_bangla;
        $data['event_status']=$request->event_status;
        $data['event_status_bangla']=$request->event_status_bangla;
        $data['discount_status']=$request->discount_status;
        $data['discount_status_bangla']=$request->discount_status_bangla;
        $data['status']=0;
        $image_one=$request->banner;
        $image=$request->image;
        if($image_one && $image){
               $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
                Image::make($image_one)->resize(870,290)->save('public/media/ladybanners/'.$image_one_name);
                $data['banner']='public/media/ladybanners/'.$image_one_name;

                $image_one_name= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
                Image::make($image)->resize(270,410)->save('public/media/ladybanners/'.$image_one_name);
                $data['image']='public/media/ladybanners/'.$image_one_name;

            DB::table('ladybanners')
                          ->insert($data);
                    $notification=array(
                     'messege'=>'Successfully Banner Inserted ',
                     'alert-type'=>'success'
                    );
               return Redirect()->route('ladystore.index-banner')->with($notification);
        }
     }
     public function update(Request $request,$id){
         $this->validate($request,[
             'product_name'=>'required|max:60',
             'product_name_bangla'=>'required|max:60',
             'meta_title'=>'required|max:40',
             'meta_title_bangla'=>'required|max:40',
             'event_status'=>'required|max:40',
             'event_status_bangla'=>'required|max:40',
             'discount_status'=>'required|max:40',
             'discount_status_bangla'=>'required|max:40',
         ]);
        $data=array();
        $data['meta_title']=$request->meta_title;
        $data['meta_title_bangla']=$request->meta_title_bangla;
        $data['product_name']=$request->product_name;
        $data['product_name_bangla']=$request->product_name_bangla;
        $data['event_status']=$request->event_status;
        $data['event_status_bangla']=$request->event_status_bangla;
        $data['discount_status']=$request->discount_status;
        $data['discount_status_bangla']=$request->discount_status_bangla;
          $old_one=$request->old_one;
          $old_two=$request->old_two;
          $image_one=$request->banner;
          $image=$request->image;
         if($request->has('banner')) {
           unlink($old_one);
           $image_one_name= hexdec(uniqid()).'.'.$image_one->getClientOriginalExtension();
           Image::make($image_one)->resize(870,290)->save('public/media/ladybanners/'.$image_one_name);
           $data['banner']='public/media/ladybanners/'.$image_one_name;

        }
        if($request->has('image')) {
               unlink($old_two);
               $image_one_name= hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
               Image::make($image)->resize(270,410)->save('public/media/ladybanners/'.$image_one_name);
               $data['image']='public/media/ladybanners/'.$image_one_name;
            }
           DB::table('ladybanners')->where('id',$id)->update($data);
            $notification=array(
                     'messege'=>'Banner Image  Updated ',
                     'alert-type'=>'success'
                    );
             return Redirect()->route('ladystore.index-banner')->with($notification);
     }


     public function DeletePolicy($id)
    {
        $pol=DB::table('ladybanners')->where('id',$id)->first();
        $image=$pol->banner;
        unlink($image);
        DB::table('ladybanners')->where('id',$id)->delete();
        $notification=array(
                     'messege'=>'Successfully Banner Deleted ',
                     'alert-type'=>'success'
                    );
         return Redirect()->back()->with($notification);

    }
        public function Inactive($id)
    {
         DB::table('ladybanners')->where('id',$id)->update(['status'=> 0]);
         $notification=array(
                     'messege'=>'Successfully banner Inactive ',
                     'alert-type'=>'success'
                    );
         return Redirect()->back()->with($notification);
    }

    public function Active($id)
    {
         DB::table('ladybanners')->where('id',$id)->update(['status'=> 1]);
         $notification=array(
                     'messege'=>'Successfully banner Aactive ',
                     'alert-type'=>'success'
                    );
         return Redirect()->back()->with($notification);
    }

    public function indexladystore(){
  $aboutCount=AboutLady::where('status',1)->count();
  $about=AboutLady::where('status',1)->get();
  return view('Ladystore.about.aboutindex',compact('about','aboutCount'));
 }
 public function addEditladystore(Request $request,$id=null){

  if($id==''){
    $title="About part page";
    $message="Successfull About pages created!";
    $about=new AboutLady;
  }else{
     $title="About part page for update";
     $message="Successfull About pages Updated!";
     $about=AboutLady::find($id);
  }
  if($request->isMethod('post')){
    $data=$request->all();
    $about->name=$data['name'];
    $about->name_bangla=$data['name_bangla'];
    $about->detail=$data['detail'];
    $about->detail_bangla=$data['detail_bangla'];
        if($request->hasFile('image')){
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                    $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/media/ladystore/large'.'/'.$fileName;
                    $medium_image_path = 'public/media/ladystore/medium'.'/'.$fileName;

                    Image::make($image_tmp)->save($large_image_path);
                    Image::make($image_tmp)->resize(230,300)->save($medium_image_path);
                    $about->image = $fileName;

                }
            }
     $about->save();
     $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
     return redirect('ladystore/get-ladystore-add-edit-index')->with($notification);
          }

          return view('Ladystore.about.aboutcreate',compact('title','about'));
      }
}

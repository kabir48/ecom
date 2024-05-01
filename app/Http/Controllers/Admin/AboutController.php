<?php

namespace App\Http\Controllers\Admin;
use Image;
use App\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Input;
use File;
use Session;

class AboutController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $data['aboutCount']=About::where('status',1)->count();
        $data['abouts']=About::where('status',1)->get();
        $data['title']="About Page List";
        return view('admin.about.index',$data);
    }

     public function addEditUpdate(Request $request,$id=Null){
         if($id==''){
             $title='Add About Us Part Page';
             $message='About part Pages Store Successfully!';
             $about=new About;
         }else{
            $title = 'Update About Us Part Page';
            $message = 'About Part Pages Update Successfully!';
            $about =About::find($id);
         }
         if($request->isMethod('post')){
             $this->validate($request,[
                'name'=>'required',
             ]);
             $data=$request->all();
             $about->name=$data['name'];
             $about->name_bn=$data['name_bn'];
             $about->about_company=$data['about_company'];
             $about->vision=$data['vision'];
             $about->vision_bn=$data['vision_bn'];
             $about->vision_text=$data['vision_text'];
             $about->vision_text_bn=$data['vision_text_bn'];
             $about->mission=$data['mission'];
             $about->mission_bn=$data['mission_bn'];
             $about->mission_text=$data['mission_text'];
             $about->mission_text_bn=$data['mission_text_bn'];
             $about->status=1;
            if ($request->hasFile('banner')) {
                if(!empty($about->banner)){
                    $about =About::find($id);
                    $location='public/media/about/'.$about->banner;
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
                    $path = 'public/media/about/' . $imageName;
                    Image::make($image_tmp)->resize(1000,600)->save($path,60);
                    $about->banner = $imageName;
                }
            }
             $about->save();
             Session::flash('success',$message);
         
            return Redirect('admin/about-lists');

         }
         return view('admin.about.create',compact('title','about'));
     }


    //  public function DeleteTearm($id)
    // {
    //     $about=DB::table('abouts')->where('id',$id)->first();
    //     $image=$about->banner;
    //     unlink($image);
    //     DB::table('abouts')->where('id',$id)->delete();
    //     $notification=array(
    //                  'messege'=>'Successfully Product Deleted ',
    //                  'alert-type'=>'success'
    //                 );
    //      return Redirect()->back()->with($notification);

    // }
}

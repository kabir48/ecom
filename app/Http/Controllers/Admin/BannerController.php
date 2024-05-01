<?php

namespace App\Http\Controllers\Admin;
use Image;
use App\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\QuickeeBanner;
use Session;
use File;

class BannerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $banners=Banner::get();
        $title="Home Page Banner";
        Session::put('page','banner');
        return view('admin.banner.index',compact('banners','title'));
    }

     public function storeUpdate(Request $request,$id=null){
        if ($id =='') {
            $title = 'Add Home Page Banner';
            $message = 'Home Page Banner Store Successfully!';
            $banner = new Banner;
        } else {
            $title = 'Update Home Page Banner';
            $message = 'Secure Home Page Banner Update Successfully!';
            $banner = Banner::find($id);
        }
        if ($request->isMethod('post')) {

            $data = $request->all();
            $banner->meta_title = $data['meta_title'];
            $banner->sub_title = $data['sub_title'];
            $banner->tag = $data['tag'];
            $banner->tag_one = $data['tag_one'];
            $banner->tag_two= $data['tag_two'];
            $banner->sort= $data['sort'];
            $banner->status = 1;
            if ($request->hasFile('banner')) {
                if(!empty($data['banner'])){
                    $location='public/media/banner/'.$banner->banner;
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
                    $bpticar_path = 'public/media/banner/' . $imageName;
                    Image::make($image_tmp)->resize(1920,600)->save($bpticar_path,80);
                    $banner->banner = $imageName;
                }
            }
            $banner->save();
            Session::flash('success',$message);
            return redirect('admin/banner-lists');
        }
        return view('admin.banner.create', compact('title', 'banner'));
     }


     public function delete($id)
    {
       $banner = Banner::find($id);
       $location='public/media/banner/'.$banner->banner;
        if(File::exists($location)){
            File::delete($location);
        }
        $banner->delete();
        Session::flash('success',$message);
        return redirect('admin/banner-lists');

    }
    
    
     public function updateCate(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Banner::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
       


}

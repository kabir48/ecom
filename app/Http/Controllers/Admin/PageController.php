<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\PageBuilder;
use Image;
use File;
use Session;

class PageController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $data['pages']=PageBuilder::where('status',1)->get();
        $data['title']="Page List";
        return view('admin.page.index',$data);
    }

    public function addEditUpdate(Request $request,$id=null){
         if($id==''){
             $title='Add Page';
             $message='Pages Store Successfully!';
             $page=new PageBuilder;
         }else{
            $title = 'Update Page';
            $message = 'Pages Update Successfully!';
            $page =PageBuilder::find($id);
         }
         if($request->isMethod('post')){
             $data=$request->all();
             $page->section=$data['section'];
             $page->text=$data['text'];
             $page->sub_title=$data['sub_title'];
             $page->vission=$data['vission'];
             $page->mission=$data['mission'];
             $page->sub_title=$data['sub_title'];
             $page->status=1;
             $words = explode(' ', $data['section']);
             $page->url=strtolower($words[0]);
             
            if($data['section']=='Login Page'){
                if ($request->hasFile('banner')) {
                    if(!empty($page->banner)){
                        $location='public/media/page/'.$page->banner;
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
                        $path = 'public/media/page/' . $imageName;
                        Image::make($image_tmp)->resize(1920,600)->save($path);
                        $page->banner = $imageName;
                    }
                } 
            }else{
                if ($request->hasFile('banner')) {
                    if(!empty($page->banner)){
                        $location='public/media/page/'.$page->banner;
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
                        $path = 'public/media/page/' . $imageName;
                        Image::make($image_tmp)->resize(976,284)->save($path);
                        $page->banner = $imageName;
                    }
                } 
            }
            
            $page->save();
            Session::flash('success',$message);
            return Redirect('admin/page-builder-lists');
        }
        $sections=['Login Page','About Page','Privacy Policy','Refund Page'];
        return view('admin.page.create',compact('title','page','sections'));
    }
}

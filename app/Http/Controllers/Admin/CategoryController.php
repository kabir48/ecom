<?php

namespace App\Http\Controllers\Admin;

use DB;
use Image;
use App\Section;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Product;
use Session;
use File;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function index()
    {
        Session::put('page','category');
        $title="Category Lists";
    	$category=Category::with(['section','parentcategory'])->where('status',1)->get();
    	return view('admin.category.index',compact('category','title'));
    }
    public function updateCate(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Category::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
    public function AddUpdateCategory(Request $request, $id=null)
    {
        if($id==""){
            $title="Category Create Page";
            $category =new Category;
            $categorydata =array();
            $getCategories =array();
            $message="Category Created Successfully";
        }else{
            $title="Edit Category";
            $categorydata=Category::where('id',$id)->first();
            $categorydata = json_decode(json_encode($categorydata),true);
            $getCategories= Category::with('subcategories')->where(['parent_id'=>0,'section_id'=>$categorydata['section_id']])->get();
            $getCategories = json_decode(json_encode($getCategories),true);
            $category = Category::find($id);
            $message="Category Updated Successfully";
        }
        if($request->isMethod('post')){
         
            $data=$request->all();
            if($request->hasFile('image')){
                $locationOne='public/media/category/large/'.$category->image;
                $locationTwo='public/media/category/medium/'.$category->image;
                if(File::exists($locationOne) && File::exists($locationTwo)){
                    File::delete($locationOne);
                    File::delete($locationTwo);
                }
            	$image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/media/category/large/'.$fileName;
                    $medium_image_path = 'public/media/category/medium/'.$fileName;
                    Image::make($image_tmp)->resize(565,565)->save($large_image_path,80);
                    Image::make($image_tmp)->resize(360,150)->save($medium_image_path,80);
     				$category->image = $fileName;
                }
            }
             if($request->hasFile('font')){
                $location='public/media/category/slide/'.$category->font;
                if(File::exists($location)){
                    File::delete($location); 
                }
            	$image_tmp = $request->file('font');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
	                $fileName = rand(111,99999).'.'.$extension;
                    $large_image_path = 'public/media/category/slide/'.$fileName;
                    Image::make($image_tmp)->resize(860,230)->save($large_image_path);
     				$category->font = $fileName;
                }
            }
            //jodi data base kicu na pathate caile
                if(empty($data['meta_title'])){
                    $data['meta_title']="";
                }
                if(empty($request['category_discount'])){
                    $request['category_discount']="";
                 }
                $category->category_name = $data['category_name'];
                $category->bangla_name = $data['bangla_name'];
                $category->url =$data['category_name'];
                $category->meta_keyword = $data['meta_keyword'];
                $category->parent_id = $data['parent_id'];
                $category->section_id = $data['section_id'];
                $category->category_discount = $data['category_discount'];
                $category->status=1;
                $category->save();
                Session::flash('success',$message);
                return Redirect('admin/category-lists');
                
        }

        $getSection=Section::where('status','1')->get();
        return view('admin.category.create')->with(compact('title','getSection','categorydata','getCategories','category'));

    }
    
        public function delete(Request $request,$id){
            $category = Category::find($id);
            if($request->isMethod('post')){
                $location='public/media/category/large/'.$category->image;
                $location_two='public/media/category/'.$category->image;
                if(File::exists($location) || File::exists($location_two)){
                    File::delete($location);
                    File::delete($location_two);
                }
                
                $getProduct=Product::where('category_id',$category->id)->delete();
                $category->delete();
                Session::flash('success',$message);
                return Redirect('admin/catgory-lists');
            }
            
            $title="Are You Sure To Delete?";
            
            return view('admin.category.append.index',compact('title','category'));
        }


  

    public function appendCate(Request $request){
        if($request->ajax()){
            $data=$request->all();
            //echo"<pre>"; print_r($data); die;
            $getCategories =Category::with('subcategories')->where(['section_id'=>$data['section_id'],'parent_id'=>0,'status'=>1])->get();
            $getCategories=json_decode(json_encode($getCategories),true);
             //echo"<pre>"; print_r($getCategories); die;
             return view('admin.category.append_category_level')->with(compact('getCategories'));
        }
    }

}

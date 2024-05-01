<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\Admin\Brand;
use Session;
use Image;
use File;

class BrandController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
      public function index()
    {
        $brands=Brand::get();
        $title="Product Brand Page";
        return view('admin.brand.index',compact('brands','title'));
    }

    public function storeAndUpdate(Request $request,$id=null)
    {
        if($id==''){
            $brand=new Brand;
            $message='Brand item Successfully Inserted!';
            $title='Brand Add Item';
        }else{
            $brand=Brand::find($id);
            $message='Brand item Successfully Updated!';
            $title='Brand Updated Item';
        }
        if($request->isMethod('post')){
            $data=$request->all();
            if ($request->hasFile('brand_logo')) {
                if(!empty($basicinfo->brand_logo)){
                    $basicinfo=Brand::find($id);
                    $location='public/media/brand/'.$basicinfo->brand_logo;
                    if(File::exists($location)){
                        File::delete($location);
                    }
                }
                $image_tmp = $request->file('brand_logo');
                if ($image_tmp->isValid()) {
                       // Upload Images after Resize
                       $image_name = $image_tmp->getClientOriginalName();
                       $extension = $image_tmp->getClientOriginalExtension();
                       $imageName =rand(111, 99999).'.'.$extension;
                       $logo_path = 'public/media/brand/'.$imageName;
                       Image::make($image_tmp)->resize(230,200)->save($logo_path,60);
                       $brand->brand_logo = $imageName;
                }
            }
            
            $brand->brand_name=$data['brand_name'];
            $brand->bangla_name=$data['bangla_name'];
            $brand->url=$data['brand_name'];
            $brand->save();
            Session::flash('success',$message);
            return redirect('admin/brand-lists');
        }
        return view('admin.brand.create',compact('title','brand'));
    }
    
    public function updateBrand(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Brand::where('id',$data['brand_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'brand_id'=>$data['brand_id']]);
            }
    }

}

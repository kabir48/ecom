<?php

namespace App\Http\Controllers\Admin;

use App\ShippingReturn;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Session;
use File;

class ShippingReturnController extends Controller
{
     public function __construct()
    {
        $this->middleware('admin');
    }
    public function index(){
        $data['title']="Shippiing Return Policy Page";
        Session::put('page','return');
        $data['shipping_return_count']=ShippingReturn::where('status',1)->count();
        $data['shipping_returns']=ShippingReturn::where('status',1)->get();
        return view('admin.shippingreturn.index',$data);
    }

     public function store(Request $request,$id=Null){
        if ($id == '') {
            $title = 'Add Return Policy Part Page';
            $message = 'Return Policy Part Page Store Successfully!';
            $shipping_return = new ShippingReturn;
        } else {
            $title = 'Update Return Policy Part Page';
            $message = 'Return Policy Part Page Update Successfully!';
            $shipping_return = ShippingReturn::find($id);
        }
        if ($request->isMethod('post')) {
            
            $data = $request->all();
            $shipping_return->name_en = $data['name_en'];
            $shipping_return->name_bn = $data['name_bn'];
            $shipping_return->detail_en = $data['detail_en'];
            $shipping_return->detail_bn = $data['detail_bn'];
            $shipping_return->status = 1;
            if ($request->hasFile('banner')) {
                if(!empty($shipping_return->banner)){
                    $shipping_return =ShippingReturn::find($id);
                    $location='public/media/shippingreturn/'.$shipping_return->banner;
                    if(File::exists($location)){
                        File::delete($location);
                    }
                }
                $image_tmp = $request->file('banner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = rand(111, 99999) . '.'.$extension;
                    $path = 'public/media/shippingreturn/'.$imageName;
                    Image::make($image_tmp)->resize(1000,380)->save($path,60);
                    $shipping_return->banner = $imageName;
                }
            }
            $shipping_return->save();
            Session::flash('success',$message);
            return redirect('admin/shipping-return-policy-lists');
        }
        return view('admin.shippingreturn.create', compact('title', 'shipping_return'));
     }
}

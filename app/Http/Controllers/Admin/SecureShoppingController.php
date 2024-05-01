<?php

namespace App\Http\Controllers\Admin;

use App\SecureShopping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Image;

class SecureShoppingController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $data['tear']=SecureShopping::where('status',1)->count();
        $data['tearm']=SecureShopping::where('status',1)->get();
        return view('admin.secureshipping.index',$data);
    }

     public function storeUpdate(Request $request,$id=Null){

        if ($id == '') {
            $title = 'Add Secure Part Page';
            $message = 'Secure Part Page Store Successfully!';
            $term = new SecureShopping;
        } else {
            $title = 'Update Secure Part Page';
            $message = 'Secure Part Page Update Successfully!';
            $term = SecureShopping::find($id);
        }
        if ($request->isMethod('post')) {
            $this->validate($request, [
                'name_en' => 'required',
                'name_bn' => 'required',
            ]);
            $data = $request->all();
            $term->name_en = $data['name_en'];
            $term->name_bn = $data['name_bn'];
            $term->detail_en = $data['detail_en'];
            $term->detail_bn = $data['detail_bn'];
            $term->status = 1;
            if ($request->hasFile('banner')) {
                $image_tmp = $request->file('banner');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageName = $image_name . '-' . rand(111, 99999).'.'.$extension;
                    $bpticar_path = 'public/media/secureshipping/'.$imageName;
                    Image::make($image_tmp)->resize(1170,380)->save($bpticar_path);
                    $term->banner = $imageName;
                }
            }
            $term->save();
            $notification = array(
                'messege' => $message,
                'alert-type' => 'success'
            );
            return redirect('admin/index-power-secureshipping')->with($notification);
        }
        return view('admin.secureshipping.create', compact('title', 'term'));

     }


}

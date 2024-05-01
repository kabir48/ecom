<?php

namespace App\Http\Controllers\Admin;
use Image;
use App\Help;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class HelpController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $data['tear']=Help::where('status',1)->count();
        $data['tearm']=Help::where('status',1)->get();
        return view('admin.help.index',$data);
    }

    public function storeUpdate(Request $request, $id = Null)
    {

        if ($id == '') {
            $title = 'Add Help Part Page';
            $message = 'Help Part Page Store Successfully!';
            $term = new Help;
        } else {
            $title = 'Update Help Part Page';
            $message = 'Help Part Page Update Successfully!';
            $term = Help::find($id);
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
                    $imageName = $image_name.'-'.rand(111, 99999).'.' . $extension;
                    $bpticar_path = 'public/media/help/'.$imageName;
                    Image::make($image_tmp)->resize(1170, 380)->save($bpticar_path);
                    $term->banner = $imageName;
                }
            }
            $term->save();
            $notification = array(
                'messege' => $message,
                'alert-type' => 'success'
            );
            return redirect('admin/index-power-help')->with($notification);
        }
        return view('admin.help.create', compact('title','term'));
    }

}

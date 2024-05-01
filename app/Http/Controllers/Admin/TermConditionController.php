<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TermConditionController extends Controller
{
    public function index(){
        $data['tear']=Tearm::where('status',1)->count();
        $data['tearm']=Tearm::where('status',1)->get();
        return view('admin.term.index',$data);
    }

     public function storeUpdated(Request $request,$id=Null){
        if ($id == '') {
            $title = 'Add Tearm and Condition Part Page';
            $message = 'Tearm and Condition Part Page Store Successfully!';
            $term = new Tearm;
        } else {
            $title = 'Update Tearm and Condition Part Page';
            $message = 'Tearm and Condition Part Page Update Successfully!';
            $term = Tearm::find($id);
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
                    $imageName = $image_name . '-' . rand(111, 99999) . '.' . $extension;
                    $bpticar_path = 'public/media/tearm/' . $imageName;
                    Image::make($image_tmp)->resize(1170,380)->save($bpticar_path);
                    $term->banner = $imageName;
                }
            }
            $term->save();
            $notification = array(
                'messege' => $message,
                'alert-type' => 'success'
            );
            return redirect('admin/get-tearm-condition-page')->with($notification);
        }
        return view('admin.term.create', compact('title', 'term'));
     }
     
}

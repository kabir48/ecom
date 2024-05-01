<?php

namespace App\Http\Controllers\Admin;

use App\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Session;

class SectionController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        Session::put('page','section');
        $title="Section Page View";
        $sections=Section::get();
        return view('admin.section.index',compact('sections','title'));
    }
 
 
    public function storeAndUpdate(Request $request,$id=null){
             
        if($id==''){
            $title="Section Create Page";
            $message="Section Part is Creaded Successfully";
            $section=new Section;
               
        }else{
            $title="Section Update Page";
            $message="Section Part is Updated Successfully";
            $section=Section::find($id);      
        }
        
        if($request->isMethod('post')){
            $data=$request->all();
            $section->name=$data['name'];
            $section->bangla_name=$data['bangla_name'];
            $section->status=1;
            $section->save();
            Session::flash('success',$message);
            return redirect('admin/section-lists');
        }
         return view('admin.section.create',compact('title','section'));
     }
    

   public function updateSection(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Section::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
}

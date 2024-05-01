<?php

namespace App\Http\Controllers\Admin;

use App\Faq;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FaqController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $title='Faq page';
        Session::put('page','faq');
        $faq=Faq::where('status',1)->get();
        return view('admin.faq.index',compact('faq','title'));
    }

    public function store(Request $request,$id=null){
        

        if($id==''){
            $faq=new Faq();
            $title="Faq Page Create";
            $messaeg="Faq pages created Successfully";
        }else{
            $faq=Faq::find($id);
            $title="Faq Page Updated";
            $messaeg="Faq pages Updated Successfully";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $faq->title=$data['title'];
            $faq->title_bn=$data['title_bn'];
            $faq->ans=$data['ans'];
            $faq->ans_bn=$data['ans_bn'];
            $faq->save();
            Session::flash('success',$messaeg);
            return redirect('admin/faq-lists');

        }
        return view('admin.faq.create',compact('title','faq'));

    }
    
       public function updateFaq(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Faq::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }

}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SmsGateway;
use Session;

class GatewayController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $title='Please Buy Thos SMS Packge from the SmS Provider and just insert those API, USERID,CLIENT ID,PASSWORD into form, You need to buy inly one package';
        Session::put('page','sms');
        $gateways=SmsGateway::get();
        return view('admin.sms.index',compact('gateways','title'));
    }

    public function store(Request $request,$id=null){
        

        if($id==''){
            $sms=new SmsGateway();
            $title="Sms Gateway Create Page ";
            $messaeg="Sms Gateway Create Successfully";
        }else{
            $sms=SmsGateway::find($id);
            $title="Sms Gateway Page Updated";
            $messaeg="Sms Gateway pages Updated Successfully";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $sms->title=$data['title'];
            $sms->sender_id=$data['sender_id'];
            $sms->api_key=$data['api_key'];
            $sms->client_id=$data['client_id'];
            $sms->save();
            Session::flash('success',$messaeg);
            return redirect('admin/sms-lists');

        }
        $title_two="Please buy one of the package to add";
        return view('admin.sms.create',compact('title','sms','title_two'));

    }
    
       public function updateSms(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                SmsGateway::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
}

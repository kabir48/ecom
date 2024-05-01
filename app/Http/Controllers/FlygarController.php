<?php

namespace App\Http\Controllers;

use App\Flygar;
use App\SMS;
use App\InfoFlygar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FlygarController extends Controller
{
    public function getRegister(){
        $SelectArray=array('One Way Trip','Round Way Trip');
        $page_name="listing";
        $flygarInfo=Flygar::where('status',1)->limit(3)->get()->toArray();
        //echo"<pre>";print_r($flygarInfo);die;
        $metaCount=Flygar::where('status',1)->first();
        $meta_title=$metaCount['meta_title'];
        $meta_keyword=$metaCount['meta_keyword'];
        $meta_description=$metaCount['meta_description'];
        return view('pages.flygar.flygar',compact('page_name','SelectArray','flygarInfo','meta_title','meta_keyword','meta_description'));
    }
    public function storeRegister(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $this->validate($request,[
                'name'=>'required',
                'email'=>'required',
                'phone'=>'required',
                'departure'=>'required',
                'arival'=>'required',
            ]);
            if(empty($data['status'])){
                 $message="Please Select checkbox!";
                 Session::flash('error',$message);
                  return redirect()->back();
            }
             if(empty($data['select_way'])){
                 $message="Please Select away!";
                 Session::flash('error',$message);
                  return redirect()->back();
            }
            $info=new InfoFlygar;
            $info->name=$data['name'];
            $info->email=$data['email'];
            $info->phone=$data['phone'];
            $info->departure=$data['departure'];
            $info->departure_date=$data['departure_date'];
            $info->arival=$data['arival'];
            $info->arival_date=$data['arival_date'];
            $info->select_way=$data['select_way'];
            $info->status=$data['status'];
            $info->save();
            $sitesetting=DB::table('sitesettings')->where('status',1)->first();
            $message="Dear Customer Email has Been Successfully Placed with equickee.com";
            $mobile=$data['phone'];
            SMS::sendSms($message,$mobile);
             $email=$data['email'];
             $messageData = [
                    'email' => $email,
                    'name' => $data['name'],
                    'phone' => $data['phone'],
                    'select_way' => $data['select_way'],
                    'departure'=>$data['departure'],
                    'arival'=>$data['arival'],
                    'sitesetting'=>$sitesetting,
                ];
                Mail::send('emails.query_email',$messageData,function($message) use($email){
                    $message->to($email)->subject('Thanks for your Query!');
                });
                $message="Thanks for Your Message We Will Notify You Very Soon!";
                Session::flash('success',$message);
                return redirect()->back();

        }

    }
}

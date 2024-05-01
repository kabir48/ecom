<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use App\Sitesetting;
use App\Admin;
use App\SmsGateway;
use Mail;
use Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Xenon\LaravelBDSms\Provider\Ssl;
use Xenon\LaravelBDSms\Provider\BDBulkSms;
use Xenon\LaravelBDSms\Provider\BulkSmsBD;
use Xenon\LaravelBDSms\Provider\Banglalink;
use Xenon\LaravelBDSms\Sender;

class LoginAdminController extends Controller
{
    public function login(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            if(Auth::guard('admin')->attempt(['email'=>$data['any_value'],'password'=>$data['password']]) || Auth::guard('admin')->attempt(['phone'=>$data['any_value'],'password'=>$data['password']])){
                    //remember ME FUNctionality
                    if(isset($data['remember']) && !empty($data['remember'])){

                        setcookie("any_value",$data['any_value'],time()+3600);

                        setcookie("password",$data['password'],time()+3600);

                    }else{
                        setcookie("any_value",'');
                        setcookie("password",'');
                    }

                Session::flash('success','Logged In Success');
                return redirect('admin/dashbord-home-page');

            }else{
                Session::flash('error','Password and Email Mismatch');
                return redirect('admin/admin-login-page');

            }
        }
        return view('auth.admin.login');
    }


    // for get Password
    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            //dd($data);
            $emailCount=Admin::where('email',$data['any_value'])
            ->orWhere('phone',$data['any_value'])
            ->count();
            //dd($emailCount);
            if($emailCount==0){
                $message="Your Email Does Not Exist!";
                    Session::flash('error',$message);
                    return redirect()->back();
                }
                //New Password
                $random_password= Str::random(8);
                $new_password = bcrypt($random_password);
                Admin::where('email',$data['any_value'])
                ->orWhere('phone',$data['any_value'])
                ->update(['password'=>$new_password]);
                $userName= Admin::select('name')->where('email',$data['any_value'])
                ->orWhere('phone',$data['any_value'])
                ->first();
                $messagesms='Dear '.$userName->name. 'Your New Password' .$random_password. 'Plz Change it Thanks';
                $site_setting=Sitesetting::where('status',1)->first();
                if($userName->phone){
                    $getSms=SmsGateway::where('status',1)->get();
                    if(count($getSms)>0){
                    
                        if($getSms[0]->title == 'ssl'){
                            
                            $sender = Sender::getInstance();
                            $sender->setProvider(Ssl::class); 
                            $sender->setMobile($userName->phone);
                            //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
                            $sender->setMessage($messagesms);
                            $sender->setQueue(true); //if you want to sent sms from queue
                            $sender->setConfig(
                               [
                                   'api_token' => $getSms[0]->api_key,
                                   'sid' =>  $getSms[0]->sender_id,
                                   'csms_id' =>$getSms[0]->ClientId,
                               ]
                            );
                            
                            $sender->send();
                        }elseif($getSms[0]->title == 'bulksmsbd'){
                            
                            $sender = Sender::getInstance();
                            $sender->setProvider(BDBulkSms::class); 
                            $sender->setMobile($userName->phone);
                            //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
                            $sender->setMessage($messagesms);
                            $sender->setQueue(true); //if you want to sent sms from queue
                            $sender->setConfig(
                               [
                                   'token' => $getSms[0]->api_key,
                               ]
                            );
                            
                            $sender->send();
                        }elseif($getSms[0]->title == 'bdbulksms'){
                            
                            $sender = Sender::getInstance();
                            $sender->setProvider(BDBulkSms::class); 
                            $sender->setMobile($userName->phone);
                            //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
                            $sender->setMessage($messagesms);
                            $sender->setQueue(true); //if you want to sent sms from queue
                            $sender->setConfig(
                               [
                                   'token' => $getSms[0]->api_key,
                               ]
                            );
                            
                            $sender->send();
                            
                        }elseif($getSms[0]->title == 'banglalink'){
                            
                            $sender = Sender::getInstance();
                            $sender->setProvider(Banglalink::class); 
                            $sender->setMobile($userName->phone);
                            //$sender->setMobile(['017XXYYZZAA','018XXYYZZAA']);
                            $sender->setMessage($messagesms);
                            $sender->setQueue(true); //if you want to sent sms from queue
                            $sender->setConfig(
                               [
                                   'userID' => $getSms[0]->sender_id,
                                   'passwd' => $getSms[0]->api_key,
                                   'sender' => $getSms[0]->ClientId,
                               ]
                            );
                            
                            $sender->send();
                            
                        }
                    }
                }
               
               
                $email =$data['any_value'];
                $name= $userName->name;
                $messageData =[
                    'name'=>$name,
                    'password'=>$random_password,
                    'sitesetting'=>$site_setting,
                    'email'=>$email
                ];
                Mail::send('emails.forgot_password',$messageData,function($message) use ($email){
                    $message->to($email)->subject('New Password for Your Account');
                });
                $message="Please Check Your Email For The New Password";
                Session::flash('success',$message);
                return redirect('admin/admin-login-page');
        }
        return view('auth.admin.forgot');
    }
    
    public function logout(){
        Auth::guard('admin')->logout();
        Session::flash('success','Log Out Successfully');
        return redirect('admin/admin-login-page');
    }

   
}

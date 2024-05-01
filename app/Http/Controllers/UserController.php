<?php

namespace App\Http\Controllers;
use App\SMS;
use Auth;
use  Session;
use App\User;
use App\CartModal;
use App\LadystoreCart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Cache;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Admin;
use App\Country;
use App\Shipping;
use App\Sitesetting;
use DB;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use URL;
class UserController extends Controller
{
    public function loginRegister(){
        $currentURL = url()->full();
        $setting=Sitesetting::where('status',1)->first();
        $home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$home_link.'/'.'public/media/logo/seo/'.$setting->seo;
        SEOMeta::setTitle("Login Page");
        SEOMeta::setCanonical($currentURL);
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("Login Page");
        $countries=Country::where('status',1)->get();
        return view('pages.user.login_register',compact('countries'));
    }
    public function registeruser(Request $request){
        if($request->isMethod('post')){
           
            $data=$request->all();
            //echo"<pre>";print_r($data);die;
            //check if the user exit
            $userCount=User::where('email',$data['email'])->count();
            $userCountPhone=User::where('phone',$data['phone'])->count();
            if($userCount>0 || $userCountPhone>0){
                $user = User::where('email', $data['email'])->orWhere('phone', $data['phone'])->first();
                Auth::login($user);
                if(!empty(Session::get('session_id'))){
                    $user_id=Auth::user()->id;
                    $session_id=Session::get('session_id');
                    CartModal::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }
            
                // Redirect the user after successful login
                Session::flash('success',"সফলভাবে, আপনি আমাদের পোর্টালে প্রবেশ করেছেন");
                return redirect('customer/user/checkout-pages');
            }elseif($data['name'] || $data['phone'] || $data['email'] || $data['country'] || $data['address']){
                $this->validate($request,[
                    'name'=>'required',
                    'phone'=>'required',
                    'address'=>'required',
                ]);
                $ipaddres=$request->ip();
                $user =new User;
                $user->name=$data['name'];
                $user->phone=$data['phone'];
                $user->email=$data['email'];
                $user->password=bcrypt(12345678);
                $user->status=1;
                $user->ip=$ipaddres;
                $user->save();
                $user_id=DB::getPdo()->lastInsertId();
                $shipping=new Shipping();
                $shipping->user_id=$user_id;
                $shipping->name=$data['name'];
                $shipping->phone=$data['phone'];
                $shipping->address=$data['address'];
                $shipping->country=$data['country'];
                $shipping->save();
                //send confirmation email user
                if($data['email']){
                   $email = $data['email'];
                    $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                    $messageData =[
                        'email'=>$data['email'],
                        'name'=>$data['name'],
                        'code'=>$data['password']??"12345678",
                        'sitesetting'=>$sitesetting,
                    ];
                    Mail::send('emails.confirmation',$messageData,function($message) use ($email){
                        $message->to($email)->subject('Confirm Your Account To Access');
                    }); 
                }
                
                Auth::login($user);
                
                if(!empty(Session::get('session_id'))){
                    $user_id=Auth::user()->id;
                    $session_id=Session::get('session_id');
                    CartModal::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }
                
                $cartUserExt=CartModal::where('session_id',$session_id)->orWhere('user_id',$user_id)->count();
                
                if($cartUserExt>0){
                    Session::flash('success',__('heading.success_bn'));
                    return redirect('customer/user/checkout-pages');
                }else{
                    Session::flash('success',__('heading.success_bn'));
                    return redirect('/');  
                }
            }else{
                Session::flash('error',__('heading.fail_bn'));
                return redirect()->back();
            }
        }
    }

    public function loginUser(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            //echo "<pre>";print_r($data);die;
            if(Auth::attempt(['email'=>$data['anyvalue'],'password'=>$data['password']]) || Auth::attempt(['phone'=>$data['anyvalue'],'password'=>$data['password']])){
                    //remember ME FUNctionality
                if(isset($data['remember']) && !empty($data['remember'])){

                    setcookie("anyvalue",$data['anyvalue'],time()+3600);

                    setcookie("password",$data['password'],time()+3600);

                }else{
                    setcookie("anyvalue",'');
                    setcookie("password",'');
                }
                $userStatus= User::where('email',$data['anyvalue'])
                ->orWhere('phone',$data['anyvalue'])
                ->first();
                if($userStatus->status==0){
                    Auth::logout();
                    $message="Your Account id Not Activated Yet!,Please Confirm your email";
                    Session::flash('error',$message);
                    return redirect()->back();
                }
                
                //update user cart
                
                if(!empty(Session::get('session_id'))){
                    $user_id=Auth::user()->id;
                    $session_id=Session::get('session_id');
                    CartModal::where('session_id',$session_id)->update(['user_id'=>$user_id]);
                }
                
                $cartUserExt=CartModal::where('session_id',$session_id)->orWhere('user_id',$user_id)->count();
                
                if($cartUserExt>0){
                    Session::flash('success','Log In Success');
                    return redirect('customer/user/checkout-pages');
                }else{
                    Session::flash('success','Log In Success');
                    return redirect('/');  
                }
                  
                

            }else{
                $message="Invalid Email or Password";
                Session::flash('error',$message);
                return redirect()->back();

            }
        }
    }
    public function forgotPassword(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $emailCount=User::where('email',$data['email'])->count();
            if($emailCount==0){
                $message="Your Email Does Not Exist!";
                    Session::flash('error',$message);
                    return redirect()->back();
                }

                //New Password
                $random_password= Str::random(10);
                $new_password = bcrypt($random_password);
                User::where('email',$data['email'])->update(['password'=>$new_password]);
                $userName= User::select('name')->where('email',$data['email'])->first();
                $email =$data['email'];
                $name= $userName->name;
                $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                $messageData =[
                    'email'=>$email,
                    'name'=>$name,
                    'password'=>$random_password,
                    'sitesetting'=>$sitesetting,
                ];
                Mail::send('emails.forgot_password',$messageData,function($message) use ($email){
                    $message->to($email)->subject('New Password for Your Account');
                });
                $message="Please Check Your Email For The New Password";
                Session::flash('success',$message);
                return redirect('user/login-registers');
        }
        $currentURL = url()->full();
        $setting=Sitesetting::where('status',1)->first();
        $home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$home_link.'/'.'public/media/logo/seo/'.$setting->seo;
        SEOMeta::setTitle("Forgot Password");
        SEOMeta::setCanonical($currentURL);
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("Forgot Password");
        return view('pages.user.forgot_password');
    }

    public function confirmAccount($email){
        $email=base64_decode($email);
        $userCount =User::where('email',$email)->count();
        if($userCount>0){
            //user email already activated or not
            $userDetails= User::where('email',$email)->first();
            if($userDetails->status==1){
                $message="Your Account Already Activated";
                Session::flash('success',$message);
                return redirect('user/login-registers');
            }else{
                //update status
                User::where('email',$email)->update(['status'=>1]);
                //send SMS to the user
                    $message ="Dear Customer,You have successfully Resistered..Happy Shopping.";
                    $mobile=$userDetails['phone'];
                    SMS::sendSms($message,$mobile);
                     $messageData=['name'=>$userDetails['name'],'phone'=>$userDetails['phone'],'email'=>$email];
                     Mail::send('emails.register_email',$messageData,function($message) use ($email){
                         $message->to($email)->subject('Thanks for The Registration.Happy Shopping!!');
                     });
                     //redirect to the user
                     $message="Your Email Account is Activited, You Can loggin in now";
                     Session::flash('success',$message);
                     return redirect('user/login-registers');
            }
        }else{
            abort(404);
        }

    }
    public function checkEmail(Request $request){
        $data= $request->all();
        $emailCount=User::where('email',$data['email'])->count();
        if($emailCount>0){
            return "false";
        }else{
            return "true";
        }

    }
   

       public function applyPasswordAdmin(Request $request){
        if($request->isMethod('post')){
            $data = $request->all();
            $emailCount=Admin::where('email',$data['email'])->count();
            if($emailCount==0){
                $message="Your Email Does Not Exist!";
                           $notification=array(
                     'messege'=>$message,
                     'alert-type'=>'error'
                    );
                    return redirect()->back()->with($notification);
                }

                //New Password
                $random_password= str_random(8);
                $new_password = bcrypt($random_password);
                Admin::where('email',$data['email'])->update(['password'=>$new_password]);
                $userName= Admin::select('name')->where('email',$data['email'])->first();
                $email =$data['email'];
                $name= $userName->name;
                $messageData =[
                    'email'=>$email,
                    'name'=>$name,
                    'password'=>$random_password,
                ];
                Mail::send('emails.forgot_password',$messageData,function($message) use ($email){
                    $message->to($email)->subject('New Password for Your Account');
                });
                $message="Please Check Your Email For The New Password";
                      $notification=array(
                     'messege'=>$message,
                     'alert-type'=>'success'
                    );
                return redirect('admin-quickee-staff-login')->with($notification);
        }
      return view('admin.auth.passwords.reset');
    }

}

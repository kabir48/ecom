<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\SMS;
use Session;
use App\User;
use App\Coupon;
use App\Section;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Coupon()
    {
        $title="Coupon Lists";
        Session::put('page','coupon');
    	$coupons=Coupon::with(['user'])->get()->toArray();
        //$coupons=json_decode(json_encode($coupons),true);
        //dd($coupons);die;
        //echo"<pre>";print_r($coupons);die;
    	return view('admin.coupon.index',compact('coupons','title'));
    }

    public function addEditCoupon(Request $request,$id=null)
    {
        if($id==""){
            //add coupon
            $coupon=new Coupon;
            $selUsers=array();
           //$selCats=array();
            $title="Add Coupon";
            $message="Coupon Pages Added Successfully";
        }else{
            //edit coupon
            $coupon=Coupon::find($id);
            $selUsers=explode(',',$coupon['users']);
            //$selCats=explode(',',$coupon['categpries']);
            $title="Edit Coupon";
            $message="Coupon Pages Updated Successfully";
        }
        if($request->isMethod('post')){
            $data= $request->all();
            $this->validate($request,[
                'coupon_option'=>'required',
                'amount_type'=>'required',
                'amount'=>'required|numeric',
                'expiry_date'=>'required',
            ]);
            //echo"<pre>";print_r($data);die;
            //echo "<br>";
            if(isset($data['users'])){
                $users= implode(',', $data['users']);
            }else{
                $users="";
            }
            if($data['coupon_option']=='Automatic'){
                $coupon_code =str_random(8);
            }else{
               $coupon_code=$data['coupon_code'];
            }

            $coupon->coupon_option=$data['coupon_option'];
            $coupon->coupon_code=$coupon_code;
            $coupon->users=$users;
            $coupon->coupon_type=$data['coupon_type'];
            $coupon->amount_type=$data['amount_type'];
            $coupon->amount=$data['amount'];
            $coupon->expiry_date=$data['expiry_date'];
            $coupon->status=1;
            $coupon->save();
            if(!empty($data['users'])){
            $users=User::select('email')->where('status',1)->get()->toArray();
            $sitesetting=DB::table('sitesettings')->where('status',1)->first();
            $email =$data['users'];
            $messageData=[
                'email'=>$email,
                'coupon_code'=>$coupon_code,
                'amount'=>$data['amount'],
                'amount_type'=>$data['amount_type'],
                'expiry_date'=>$data['expiry_date'],
                'sitesetting'=>$sitesetting,
                'amount_type'=>$data['amount_type'],
            ];
            Mail::send('emails.coupon_email',$messageData,function($message) use ($email){
                $message->to($email)->subject('Coupon Code generate.You Can Use It for Getting Discount!!'); });
            Session::flash('error',$message);
            return Redirect('admin/coupon-lists');
        }else{
             Session::flash('error','Sorry,It is Failed');
             return Redirect('admin/coupon-lists');
        }

            //echo $users; die;
            //echo"<pre>";print_r($data);die;
        }
        $users=User::select('email')->where('status',1)->get()->toArray();
        // $categories = Section::with('categories')->where('select_type','Quickee')->get();
        // $ladycategories = Section::with('categories')->where('select_type','Ladystore')->get();
        // $categories = json_decode(json_encode($categories),true);
        // $ladycategories = json_decode(json_encode($ladycategories),true);
        return view('admin.coupon.create',compact('title','coupon','users','selUsers'));

    }

    public function DeleteCoupon($id)
    {
    	DB::table('coupons')->where('id',$id)->delete();
    	Session::flash('error','Coupon Delete Done');
        return Redirect('admin/coupon-lists');
    }



    public function Newslater()
    {
        $sub=DB::table('subscribers')->get();
        return view('admin.coupon.newslater',compact('sub'));
    }

    public function DeleteSub($id)
    {
        DB::table('subscribers')->where('id',$id)->delete();
        $notification=array(
                 'messege'=>'Subscriber Delete Done',
                 'alert-type'=>'success'
                       );
        return Redirect()->back()->with($notification);
    }

    public function Seo()
    {
        $seo=DB::table('seo')->first();
        return view('admin.coupon.seo',compact('seo'));
    }

    public function UpdateSeo(Request $request)
    {
         $id=$request->id;
         $data=array();
         $data['meta_title']=$request->meta_title;
         $data['meta_author']=$request->meta_author;
         $data['meta_tag']=$request->meta_tag;
         $data['meta_description']=$request->meta_description;
         $data['google_analytics']=$request->google_analytics;
         $data['bing_analytics']=$request->bing_analytics;
         DB::table('seo')->where('id',$id)->update($data);
         Session::flash('error','Coupon Delete Done');
         return Redirect()->back();
    }
    public function updateCate(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Coupon::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }

}

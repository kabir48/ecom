<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Auth;
use Image;
use App\User;
use Illuminate\Support\Facades\Hash;
use App\SMS;
use Illuminate\Support\Facades\Mail;
class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function TodayOrder()
    {
    	  $today=date('d-m-y');
    	  $order=DB::table('orders')->where('status',0)->where('date',$today)->get();
    	  return view('admin.report.today_order',compact('order'));
    }

    public function TodayDelevered()
    {
          $today=date('d-m-y');
    	  $order=DB::table('orders')->where('status',3)->where('date',$today)->get();
    	  return view('admin.report.today_order',compact('order'));
    }

    public function ThisMonth()
    {
    	  $month=date('F');
    	  $order=DB::table('orders')->where('status',3)->where('month',$month)->get();
    	  return view('admin.report.today_order',compact('order'));
    }

    public function search()
    {
    	 return view('admin.report.search');
    }

    public function searchByYear(Request $request)
    {
    	 $year=$request->year;
    	 $total=DB::table('orders')->where('status',3)->where('year',$year)->sum('total');
         $order=DB::table('orders')->where('status',3)->where('year',$year)->get();
         return view('admin.report.search_report',compact('order','total'));

    }

    public function searchByMonth(Request $request)
    {
        $month=$request->month;
    	 $total=DB::table('orders')->where('status',3)->where('month',$month)->sum('total');
         $order=DB::table('orders')->where('status',3)->where('month',$month)->get();
         return view('admin.report.search_report',compact('order','total'));
    }

    public function searchByDate(Request $request)
    {
    	  $date=$request->date;
          $newdate = date("d-m-y", strtotime($date));
          $total=DB::table('orders')->where('status',3)->where('date',$newdate)->sum('total');
          $order=DB::table('orders')->where('status',3)->where('date',$newdate)->get();
         return view('admin.report.search_report',compact('order','total'));
    }

    public function UserRole()
    {
    	 $user=DB::table('admins')->where('type',2)->get();
    	 return view('admin.role.all_role',compact('user'));
    }

    public function UserCreate()
    {
    	  return view('admin.role.create');
    }

    public function UserStore(Request $request)
    {
        $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins'],
            'phone' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);
    	 $data=array();
    	 $data['name']=$request->name;
    	 $data['phone']=$request->phone;
    	 $data['email']=$request->email;
    	 $data['password']= Hash::make($request->password);
    	 $data['category']=$request->category;
    	 $data['blog']=$request->blog;
    	 $data['report']=$request->report;
    	 $data['contact']=$request->contact;
    	 $data['coupon']=$request->coupon;
    	 $data['order']=$request->order;
    	 $data['role']=$request->role;
    	 $data['comment']=$request->comment;
    	 $data['product']=$request->product;
    	 $data['other']=$request->other;
    	 $data['return']=$request->return;
    	 $data['setting']=$request->setting;
         $data['stock']=$request->stock;
         $data['tream']=$request->tream;
         $data['About']=$request->About;
         $data['Service']=$request->Service;
         $data['shipping']=$request->shipping;
         $data['Security']=$request->Security;
         $data['Help']=$request->Help;
         $data['Ladystore']=$request->Ladystore;
         $data['flygharholiday']=$request->flygharholiday;
         $data['BPTI']=$request->BPTI;
         $data['Refund']=$request->Refund;
         $data['Policy']=$request->Policy;
         $data['Delivery_stuff']=$request->Delivery_stuff;
         $data['type']=2;

        if ($request->hasFile('image_one')) {
            $image_tmp = $request->file('image_one');
            if ($image_tmp->isValid()) {
                // Upload Images after Resize
                $extension = $image_tmp->getClientOriginalExtension();
                $fileName = rand(111, 99999) . '.' . $extension;
                $small_image_path = 'public/media/adminphoto' . '/' . $fileName;
                Image::make($image_tmp)->resize(500,500)->save($small_image_path);
                $data['image_one'] = $fileName;
            }
        }

    	 DB::table('admins')->insert($data);
    	 $notification=array(
                 'messege'=>'Authority Create Successfully',
                 'alert-type'=>'success'
                       );
        return redirect('for-ladystore-quickee-create-role')->with($notification);

    }

    public function UserDelete($id)
    {
    	 DB::table('admins')->where('id',$id)->delete();
    	 $notification=array(
                 'messege'=>' Admin Delete Successfully',
                 'alert-type'=>'success'
                       );
         return Redirect('for-ladystore-quickee-create-role')->with($notification);
    }

    public function UserEdit($id)
    {
    	 $user=DB::table('admins')->where('id',$id)->first();
    	 return view('admin.role.edit_role',compact('user'));
    }

    public function UserUpdate(Request $request)
    {
    	 $id=$request->id;
    	 $data=array();
    	 $data['name']=$request->name;
    	 $data['phone']=$request->phone;
    	 $data['email']=$request->email;
    	 $data['category']=$request->category;
    	 $data['blog']=$request->blog;
    	 $data['report']=$request->report;
    	 $data['contact']=$request->contact;
    	 $data['coupon']=$request->coupon;
    	 $data['order']=$request->order;
    	 $data['role']=$request->role;
    	 $data['comment']=$request->comment;
    	 $data['product']=$request->product;
    	 $data['other']=$request->other;
    	 $data['return']=$request->return;
    	 $data['setting']=$request->setting;
         $data['stock']=$request->stock;
         $data['tream']=$request->tream;
         $data['About']=$request->About;
         $data['Service']=$request->Service;
         $data['shipping']=$request->shipping;
         $data['Security']=$request->Security;
         $data['Help']=$request->Help;
         $data['Ladystore']=$request->Ladystore;
         $data['flygharholiday']=$request->flygharholiday;
         $data['BPTI']=$request->BPTI;
         $data['Refund']=$request->Refund;
         $data['Policy']=$request->Policy;
         $data['Delivery_stuff']=$request->Delivery_stuff;
    	 DB::table('admins')->where('id',$id)->update($data);
    	 $notification=array(
                 'messege'=>'Child Admin Update Successfully',
                 'alert-type'=>'success'
                       );
        return Redirect('for-ladystore-quickee-create-role')->with($notification);


    }

    public function userStatusInactive($id){
        $userInactive=User::where('id',$id)->update(['status'=>'0']);
        $deliveryPhone = User::select('phone', 'email', 'name')->where('id',$id)->first()->toArray();
        $message = "Dear Customer,Your Account Has Been Diabled! For Further Info.You Can Contact Us";
        $mobile = $deliveryPhone['phone'];
        SMS::sendSms($message, $mobile);
        $sitesetting = DB::table('sitesettings')->where('status', 1)->first();
        $email = $deliveryPhone['email'];
        $messageData = [
            'name' => $deliveryPhone['name'],
            'phone' => $deliveryPhone['phone'],
            'email' => $email,
            'sitesetting' => $sitesetting,
        ];
        Mail::send('emails.status_disable', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('Account Disabled!!');
        });
        $notification = array(
            'messege' => 'User Successfully Inactive',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }


    public function userStatusActive($id)
    {
        $userInactive = User::where('id', $id)->update(['status' => '1']);
        $deliveryPhone = User::select('phone', 'email', 'name')->where('id', $id)->first()->toArray();
        $message = "Dear Customer,Your Account Has Been Enabled! You can Able To Login Now";
        $mobile = $deliveryPhone['phone'];
        SMS::sendSms($message, $mobile);
        $sitesetting = DB::table('sitesettings')->where('status', 1)->first();
        $email = $deliveryPhone['email'];
        $messageData = [
            'name' => $deliveryPhone['name'],
            'phone' => $deliveryPhone['phone'],
            'email' => $email,
            'sitesetting' => $sitesetting,
        ];
        Mail::send('emails.status_enable', $messageData, function ($message) use ($email) {
            $message->to($email)->subject('Account Enabled!!');
        });
        $notification = array(
            'messege' => 'User Successfully Active',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }


}

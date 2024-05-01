<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Admin;
use App\Announcement;
use App\OrderDetail;
use App\Product;
use App\Order;
use App\User;
use App\Role;
use App\Post;
use Session;
use Carbon\Carbon;
use Hash;
use Illuminate\Support\Str;
use Auth;
use App\VisitorIp;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
     
    public function index(){
        $getProduct=Product::where('status',1)->get();
        $getOrder=Order::where('status',4)->pluck('id');
        $orders=Order::where('status','!=',3)->latest()->take(10)->get();
        Session::put('page','dashboard');
        
        $currentYear=VisitorIp::whereYear('date',Carbon::now()->year)->get();
        
        $current_month_user_ip=VisitorIp::whereYear('date',Carbon::now()->year)->whereMonth('date',Carbon::now()->month)->count();
        
        $last_month_user_ip=VisitorIp::whereYear('date',Carbon::now()->year)->whereMonth('date',Carbon::now()->subMonth(1))->count(); 
        
        $last_last_month_user_ip=VisitorIp::whereYear('date',Carbon::now()->year)->whereMonth('date',Carbon::now()->subMonth(2))->count();
        
        $prev_month_user_ip=VisitorIp::whereYear('date',Carbon::now()->year)->whereMonth('date',Carbon::now()->subMonth(3))->count();
        
        $prev_prev_month_user_ip=VisitorIp::whereYear('date',Carbon::now()->year)->whereMonth('date',Carbon::now()->subMonth(4))->count();
        
        $prev_last_month_user_ip=VisitorIp::whereYear('date',Carbon::now()->year)->whereMonth('date',Carbon::now()->subMonth(5))->count();
        
        // order count
        
        $total_order=Order::where('status','3')->where('status','!=',2)->sum('total');
        $total_order_count=Order::count();
        $pending_order_count=Order::where('status','1')->count();
        $delivered_order_count=Order::where('status','3')->count();
        
        $pending_order_sum=Order::where('status','1')->where('status','!=',2)->count();
        
        $active_order_count=Order::where('status','0')->where('date',Carbon::now())->count();
        $return_order_count=Order::where('status','=','2')->count();
        $totalIncome =Order::where('status',4)->sum('total');
        
        return view('admin.dashboard.index',compact(
            'getProduct','getOrder','orders','current_month_user_ip','currentYear','last_month_user_ip','last_last_month_user_ip','prev_month_user_ip','prev_prev_month_user_ip','prev_last_month_user_ip',
            'total_order','total_order_count','pending_order_count','totalIncome','delivered_order_count','pending_order_sum','active_order_count','return_order_count'
            ));
    }
    
    public function changeProductValue(Request $request){
        if($request->ajax()){ 
            $data=$request->all();
            if($data['value']=='monthly'){
                $getOrder=Order::where('status',4)->orWhere('payment_type','prepaid')->whereMonth('date',Carbon::now()->month)->pluck('id');
                $getOrderDetails=OrderDetail::with('product')->select('product_id')->whereMonth('date',Carbon::now()->month)->whereIn('order_id',$getOrder)->groupBy('product_id')->pluck('product_id');
                $getProducts=Product::whereIn('id',$getOrderDetails)->get();  
                
                
                    if(count($getProducts)>0){
                           $output='';
                        foreach($getProducts as $key=>$data){
                            $getOrderDetailCount=Order::where('status',4)->orWhere('payment_type','prepaid')->whereMonth('date',Carbon::now()->month)->count();
                            $getOrderDetailSingleCount=OrderDetail::with('product')->where(['product_id'=>$data['id']])->whereMonth('date',Carbon::now()->month)->whereIn('order_id',$getOrder)->count();
                            //dd($getOrderDetailCount);
                            $per=$getOrderDetailSingleCount/$getOrderDetailCount * 100;
                          
                            $output.= '<tr>';
                                $output.='<td><img src="'.asset($data['image_one']).'" alt="Product Image"  class="productImage"></td>';
                                $output.='<td class="con_wrpper">';
                                    $output.='<h3 class="title">'.$data['product_name'].' (sale '.$getOrderDetailSingleCount.')</h3>';
                                     $output.='<ul>';
                                        $output.='<li><span class="cstatus"></span>';
                                            $output.='<span>'.$data['category']['category_name'].'</span></li>';
                                        $output.= '<li>|</li>';
                                        $output.='<li>';
                                            $output.='<img src="'.asset('public/image/trend-up.png').'" alt="">';
                                            $output.='<span>'.$per.'%</span>';
                                        $output.='</li>';
                                     $output.='</ul>';
                                $output.='</td>';
                               $output.= '<td>';
                                     $output.='<a href="#" class="cbtn"><img src="'.asset('public/image/right_angle.png').'" class="rightAngleIcon"></a>';
                                 $output.= '</td>';
                            $output.='</tr>';
                            
                       } 
                       return $output;
                    }
                }else{
                    $getOrder=Order::where('status',4)->orWhere('payment_type','prepaid')->whereYear('date',date('Y'))->pluck('id');
                    $getOrderDetails=OrderDetail::with('product')->select('product_id')->whereIn('order_id',$getOrder)->groupBy('product_id')->pluck('product_id');
                    $getProducts=Product::whereIn('id',$getOrderDetails)->get(); 
                   
                    
                     if(count($getProducts)>0){
                           $output='';
                        foreach($getProducts as $key=>$data){
                            $getOrderDetailCount=Order::where('status',4)->orWhere('payment_type','prepaid')->whereYear('date',date('Y'))->count();
                            $getOrderDetailSingleCount=OrderDetail::with('product')->where(['product_id'=>$data['id']])->whereIn('order_id',$getOrder)->count();
                            //dd($getOrderDetailCount);
                            $per=$getOrderDetailSingleCount/$getOrderDetailCount * 100;
                          
                            $output.= '<tr>';
                                $output.='<td><img src="'.asset($data['image_one']).'" alt="Product Image" class="productImage"></td>';
                                $output.='<td class="con_wrpper">';
                                    $output.='<h3 class="title">'.$data['product_name'].' (sale '.$getOrderDetailSingleCount.')</h3>';
                                    $output.='<ul>';
                                    $output.='<li><span class="cstatus"></span>';
                                        $output.='<span>'.$data['category']['category_name'].'</span></li>';
                                        $output.= '<li>|</li>';
                                        $output.='<li>';
                                            $output.='<img src="'.asset('public/image/trend-up.png').'" alt="">';
                                            $output.='<span>'.$per.'%</span>';
                                        $output.='</li>';
                                    $output.='</ul>';
                                $output.='</td>';
                                $output.= '<td>';
                                    $output.='<a href="#" class="cbtn"><img src="'.asset('public/image/right_angle.png').'" class="rightAngleIcon"></a>';
                                $output.= '</td>';
                            $output.='</tr>';
                            
                       } 
                       return $output;
                    }
                }
            
        }
    }
    
    

    public function viewUser(){
        Session::put('page','users');
        $title="User View List";
        //dd(\Auth::guard('admin')->user()->role_id);
        if(Auth::guard('admin')->user()->role_id==1){
            $admins=Admin::latest()->get();
        }else{
           $admins=Admin::where('id',Auth::guard('admin')->user()->id)
           ->get(); 
        }
        
        
        //dd($users);
        return view('admin.admin.index',compact('admins','title'));
    }

    public function show($id){
        $roles=Role::get();
        $data=User::with(['roleUser'])->where('id',$id)->first();
        return view('admin.user.show',compact('data','roles'));
    }
    
    // Role entry
    public function roleList(){
        Session::put('page','roles');
        $title="Role Page";
        $roles=Role::get();
        return view('admin.role.index',compact('roles','title'));
    }
    
    public function roleStore(Request $request,$id=null){
        
        if($id==''){
            $title="Role Create Page";
            $message="Role Created Successfully";
            $roles=new Role();
        }else{
           $title="Role Update Page";
            $message="Role Updated Successfully";
            $roles=Role::find($id); 
        }
        
        if($request->isMethod('post')){
            $data=$request->all();
            $roles->name=$data['name'];
            $roles->save();
            Session::flash('success',$message);
            return redirect('admin/role-lists');
        }
        
        return view('admin.role.create',compact('roles','title'));
    }
    
    
    public function store(Request $request){
        if($request->isMethod('post')){
            $request->validate([
                'name'=>'required',
                'email'   => 'required|unique:users,email|max:30',
                'password'   => 'required|min:7',
                'phone'   => 'required|min:11',
            ]);
            $data=$request->all();
            $user=new Admin();
            $user->name=$data['name'];
            $user->email=$data['email'];
            $user->phone=$data['phone'];
            $user->password=Hash::make($data['password']);
            $user->role_id=$data['role_id'];
            if ($request->hasFile('image_one')) {
                $image_tmp = $request->file('image_one');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    //$image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageNameContact = time().'.'. $extension;
                    $user_image_path = 'public/media/admin/'.$imageNameContact;
                    //here 40 is image compres
                    Image::make($image_tmp)->resize(100,100)->save($user_image_path,40);
                    $user['image_one'] = $imageNameContact;
                }
            }

            $user->save();
            Session::flash('success','User Created Successfully');
            return redirect('admin/user-list');

        }
        $title="Usser Create Page";
        $roles=Role::get();
        return view('admin.admin.create',compact('roles','title'));
    }

    public function update(Request $request,$id){
       // dd('ok');
        $user=Admin::find(Auth::guard('admin')->user()->id);
        if($request->isMethod('post')){
            $this->validate($request,[
               'email'=>"email|unique:users,email,$id",
            ]);

            
            if ($request->hasFile('image_one')) {

                $location='public/media/admin/'.$user->image_one;
                if(File::exists($location)){
                    File::delete($location);
                }
                $image_tmp = $request->file('image_one');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    //$image_name = $image_tmp->getClientOriginalName();
                    $extension = $image_tmp->getClientOriginalExtension();
                    $imageNameContact = time().'.'. $extension;
                    $user_image_path = 'public/media/admin/' . $imageNameContact;
                    //here 40 is image compress
                    Image::make($image_tmp)->resize(100,100)->save($user_image_path,40);
                }
            }else{
                $imageNameContact=$user->image_one;
            }

           Admin::where('id',$id)->update(['name'=>$request->name,'email'=>$request->email,'phone'=>$request->phone,'role_id'=>$request->role_id,'image_one'=>$imageNameContact]);
            Session::flash('success','User Updated Successfully');
            return redirect('admin/user-list');
        }
        $title="Update Page For ".Auth::guard('admin')->user()->name;
        $title_two="Password Change";
        $roles=Role::get();
        return view('admin.admin.password_change',compact('title','title_two','user','roles'));
            
    }

    public function passwordChange(Request $request,$id){
        
        if(Auth::attempt(['id'=>Auth::guard('admin')->user()->id,'password'=>$request->old_password])){
            $user=Admin::find(Auth::guard('admin')->user()->id);
            $user->password=bcrypt($request->new_password);
            $user->save();
            Session::flash('success','User password Updated Successfully');
            return redirect()->back();
        }else{
            Session::flash('success','Password Changes Failed');
            return redirect()->back();
        }

    }
    
    
      public function destroy(Request $request,$id){
        $user=Admin::find($id);
        if($request->isMethod('post')){
            $location='public/media/admin/'.$user->image_one;
            if(File::exists($location)){
                File::delete($location);
            }
            $user->delete();
            Session::flash('success','User Deleted Successfully');
            return redirect('admin/user-list');
        }
        
        $title="Are You Sure You Want To Delete?";
        
        return view('admin.admin.append.index',compact('user','title'));
        
    }
    
    public function check($id){
        $user=Admin::find($id); 
        $message="Role Status Changed Successfully";
        if($user->status==1){
            $user->status=0;
            $user->save();
            Session::flash('success',$message);
            return redirect('admin/user-list');
        }else{
            $user->status=1;
            $user->save();
            Session::flash('success',$message);
            return redirect('admin/user-list');
        }
    }

    public function chartDashboard(){
        return view('admin.admin_layouts');
    }
    
    public function getHighestProduct(){
        $orderId=Order::where('status',3)->pluck('id');
        $orderDetail=OrderDetail::whereIn('order_id',$orderId)->max('product_id');
    }
    
    // ============Announcement part===========//
    
    public function indexAnnouncement(){
        Session::put('page','announcement');
        $title="Announcement Page";
        $announcements =Announcement::get();
        return view('admin.announcement.index',compact('title','announcements'));
    }
    
    public function storeAnnouncement(Request $request,$id=null){
        if($id==''){
            $title="Announcement Create page";
            $message="Announcement Page Create Successfully";
            $announcement=new Announcement();
        }else{
            $title="Announcement Create page";
            $message="Announcement Page Create Successfully";
            $announcement=new Announcement();
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $announcement->trigger=$data['trigger'];
            $announcement->note=$data['note'];
            $announcement->save();
            Session::flash('success',$message);
            return redirect('admin/announcement-lists');
        }
        
        return view('admin.announcement.create',compact('title','announcement'));
    }
    
    public function updateStatusAnnouncement(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            Announcement::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }
    
    public function getUser(){
        $title="User Lists";
        Session::put('page','user');
        $users=User::get();
        $camCount=Post::count();
        $cams=Post::get();
        return view('admin.user.index',compact('users','title','camCount','cams'));
    }
    
    public function updatStatusUser(Request $request){
        if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                User::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
    public function updatStatusCam(Request $request){
        if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Post::where('id',$data['cam_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'cam_id'=>$data['cam_id']]);
            }
    }
    
    public function userDelete($id){
       $user=User::find($id)->delete();
       Session::flash('success','User Deleted Successfully');
       return redirect('admin/user-lists');
    }
    
    public function formatLargeNumber($val)
    {
        if ($val >= 1000 && $val < 1000000) {
            return "TK. " . number_format($val / 1000, 2) . ' thousand';
        } elseif ($val >= 1000000 && $val < 1000000000) {
            return "TK. " . number_format($val / 1000000, 2) . ' million';
        } elseif ($val >= 1000000000 && $val < 1000000000000) {
            return "TK. " . number_format($val / 1000000000, 2) . ' billion';
        } elseif ($val >= 1000000000000) {
            return "TK. " . number_format($val / 1000000000000, 2) . ' trillion';
        } else {
            return $val;
        }
    }
}

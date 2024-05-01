<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\SMS;
use Session;
use App\User;
use App\Admin;
use App\DeliveryStuff;
use App\OrderLog;
use App\AttributeProduct;
use App\Order;
use App\Product;
use App\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\OrderDetail;
use App\OrderStatus;
use App\ReturnProduct;
use App\ExchangeProduct;
use App\SmsGateway;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Xenon\LaravelBDSms\Provider\Ssl;
use Xenon\LaravelBDSms\Provider\BDBulkSms;
use Xenon\LaravelBDSms\Provider\BulkSmsBD;
use Xenon\LaravelBDSms\Provider\Banglalink;
use Xenon\LaravelBDSms\Sender;

class OrderController extends Controller
{
     public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {   Session::put('page','order');
        $title="Order Lists";
        $status=$request->status;
        $payment_type=$request->payment_type;
        $order_status=OrderStatus::where('status',1)->get();
        
        
        // if($status && $payment_type){
        //     $orders=Order::latest()->whereNotIn('return_order',[1,2])
        //     ->where('status',$status)
        //   ->where('payment_type',$payment_type)
        //     ->get();
    	   // return view('admin.order.index',compact('orders','title','order_status'));
        // }elseif($status){
        //     $orders=Order::latest()->whereNotIn('return_order',[1,2])
        //     ->where('status',$status)
        //     ->get();
    	   // return view('admin.order.index',compact('orders','title','order_status')); 
        // }elseif($payment_type){
        //     //dd('og');
        //     $orders=Order::latest()->whereNotIn('return_order',[1,2])
        //   ->where('payment_type',$payment_type)
        //     ->get();
            
           
    	   // return view('admin.order.index',compact('orders','title','order_status')); 
        // }
        
        if($status){
            //dd('og');
            $orders=Order::latest()->whereNotIn('return_order',[1,2])
           ->where('status',$status)
            ->get();
           
    	    return view('admin.order.index',compact('orders','title','order_status')); 
        }
        
        $orders=Order::latest()->whereNotIn('return_order',[1,2])->get();
    	return view('admin.order.index',compact('orders','title','order_status'));
    }

    public function view($id)
    {
    	$order=DB::table('orders')->join('users','orders.user_id','users.id')->select('users.name','users.phone','orders.*')->where('orders.id',$id)->first();
    	$shipping=DB::table('shipping_addresses')->where('order_id',$id)->first();
    	$details=DB::table('order_details')->join('products','order_details.product_id','products.id')->select('products.product_code','products.image_one','order_details.*')->where('order_details.order_id',$id)->get();
        $title="Order view List";
        $logs=OrderLog::where('order_id',$id)->latest()->get();
        $order_status=OrderStatus::where('status',1)->get();
        return view('admin.order.view_order',compact('order','shipping','details','title','order_status','logs'));


    }
    
    public function orderStatus(Request $request){
        if($request->isMethod('post')){
            $id=$request->id;
            $order=Order::find($id);
            Order::where('id',$order->id)->update(['status'=>$request->status]);
            //Update Courier name
            if(!empty($request->delivery_name) || !empty($request->Expected_date) || !empty($request->status_code)){
                $delivery_man=$request->delivery_man;
                $date=$request->Expected_date;
                $status_code= $request->status_code;
                Order::where('id',$order->id)->update(['status_code'=>$request->status_code,'Expected_date'=>$request->Expected_date,'delivery_man'=>$request->delivery_man]);
            }
            if($request->status==1){
                $status='Processing'; 
                $messagesms=$status. 'Status Changed Successfully';
            }
            elseif($request->status==2){
                $status='Shipped';
                $messagesms='Your Order status has been Updated To '.$status. 'as well as Tracking Code : ' .$status_code.' ,' .'Courier Name: '.$delivery_man. 'Expected Date : ' .$date;
            }
            elseif($request->status==3){
                $status='Delivered';
                $messagesms=$status. 'Status Changed Successfully';
            }
            elseif($request->status==4){
                $status='Paid';
                $messagesms=$status. 'Status Changed Successfully';
                $orderDetails=DB::table('order_details')->where('order_id',$order->id)->get();

                foreach ($orderDetails as $row) {
                    DB::table('products')
                      ->where('id',$row->product_id)
                      ->update(['product_quantity' => DB::raw('product_quantity -'.$row->product_quantity)]);
                    
                    DB::table('attribute_products')
                      ->where('product_id',$row->product_id)
                      ->update(['stock' => DB::raw('stock -'.$row->product_quantity)]);
                }
            }
            else{
                $status='Cancelled';
                $messagesms=$status. 'Status Changed Successfully';
                $order->delete();
                DB::table('order_details')->where('order_id',$order->id)->delete();
            }
            
           
            
            $user=User::select('phone','email','name')->where('id',$order->user_id)->first()->toArray();
            
             if($user['phone']){
                    $getSms=SmsGateway::where('status',1)->get();
                    if(count($getSms)>0){
                        if($getSms[0]->title == 'ssl'){
                            $sender = Sender::getInstance();
                            $sender->setProvider(Ssl::class); 
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
            $sitesetting=DB::table('sitesettings')->where('status',1)->first();
            $email = $user['email'];
                $messageData=[
                'name'=>$user['name'],
                'phone'=>$user['phone'],
                'email'=>$email,
                'status'=>$messagesms,
                'order'=>$order,
                'sitesetting'=>$sitesetting,
               ];
           
           Mail::send('emails.order_status',$messageData,function($message) use ($email){
            $message->to($email)->subject('Order Status!!'); 
               
           });
           
           //Update order logs
           $log=new OrderLog();
           $log->order_id = $order->id;
           $log->status = $status;
           $log->save();
            
           $message=$status. 'Status Changed Successfully';
           Session::flash('success',$message);
           return redirect()->back();
        }
    }

    public function DeleveryManEdit(Request $request,$id=null){
        if($id==""){
            $title="Added";
            $message="Expected Date and Delivery Man Added";
            $order=new Order;
        }else{
            $title="Edited";
            $order = Order::find($id);
             $message="Expected Date and Delivery Man Updated";
        }
        if($request->isMethod('post')){
             $data=$request->all();
             //dd($data);die;
            $order->delivery_man = $data['delivery_man'];
            $order->Expected_date = $data['Expected_date'];
            $order->save();
        $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
        return redirect('admin/get-equicke-ladystore-view-order-accept/payment')->with($notification);
        }
        $shipping=DeliveryStuff::where('status','1')->get();

        //dd($shipping);die;
        return view('admin.order.delivery_man',compact('title','order','shipping'));
    }

    public function PaymentAccept($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=>1]);

        $productDetails = Order::with('products','shipping')->where('id',$id)->first();
        $user_id = $productDetails->user_id;
        $deliveryPhone=User::select('phone','email','name')->where('id',$user_id)->first()->toArray();
        $message ="Dear Customer,You have Order has Been shipped You Can also Track your Order";
        $mobile=$deliveryPhone['phone'];
        SMS::sendSms($message,$mobile);
        $sitesetting=DB::table('sitesettings')->where('status',1)->first();
        $email = $deliveryPhone['email'];
        $messageData=[
            'name'=>$deliveryPhone['name'],
            'phone'=>$deliveryPhone['phone'],
            'email'=>$email,
            'productDetails'=>$productDetails,
            'sitesetting'=>$sitesetting,
        ];
        Mail::send('emails.order_status',$messageData,function($message) use ($email){
            $message->to($email)->subject('Order Placed to Ship.Happy Shopping!!'); });
         

        $notification=array(
                 'messege'=>'Payment Accept Done See The Processing Product',
                 'alert-type'=>'success'
                       );
        
             return Redirect('admin/get-equicke-ladystore-view-order-pending/order')->with($notification);
    }

    public function PaymentCancel($id)
    {
        DB::table('orders')->where('id',$id)->update(['status'=>4]);
        $productDetails = Order::with('products','shipping')->where('id',$id)->first();
        $user_id = $productDetails->user_id;
        $deliveryPhone=User::select('phone','email','name')->where('id',$user_id)->first()->toArray();
        $message ="Dear Customer,You'r Order Has Been Cancelled For Some Reasons Please Contact With Our Customer Care";
        $mobile=$deliveryPhone['phone'];
        SMS::sendSms($message,$mobile);
        $productDetails = Order::with('products','shipping')->where('id',$id)->first();
        $sitesetting=DB::table('sitesettings')->where('status',1)->first();
        $email = $deliveryPhone['email'];
        $messageData=[
            'name'=>$deliveryPhone['name'],
            'phone'=>$deliveryPhone['phone'],
            'email'=>$email,
            'productDetails'=>$productDetails,
            'sitesetting'=>$sitesetting,
        ];
        Mail::send('emails.order_cancel',$messageData,function($message) use ($email){
            $message->to($email)->subject('Order Cancelled.Please Contact!!'); });
        $notification=array(
                 'messege'=>'Order Cancel Successfully!',
                 'alert-type'=>'success'
                       );

        return Redirect('admin/get-equicke-ladystore-view-order-pending/order')->with($notification);
    }

    public function AcceptPaymentOrder()

    {
         $order=Order::with('adminOrder')->where('status',1)->latest()->get();
         //$order= DB::table('orders')->join('admins','orders.delivery_man','admins.id')->select('admins.name','admins.phone','orders.*')->get();
         //dd($order);die;
         return view('admin.order.pending',compact('order'));
    }

    public function CancelPaymentOrder()
    {
        $order=DB::table('orders')->where('status',4)->get();
         return view('admin.order.pending',compact('order'));
    }
    
       public function OrderCancelByadmin($id)
    {

        $product=DB::table('order_details')->where('order_id',$id)->latest()->get();

        foreach ($product as $row) {
            DB::table('products')
              ->where('id',$row->product_id)
              ->update(['product_quantity' => DB::raw('product_quantity +'.$row->product_quantity)]);
        }

        DB::table('orders')->where('id',$id)->update(['return_order'=>2]);
        $notification=array(
                 'messege'=>'Return Order Successfully Done',
                 'alert-type'=>'success'
                       );
        return Redirect('admin/admin/get-equicke-ladystore-view-order-accept-payment-success/payment')->with($notification);
    }

    public function ProgressPaymentOrder()
    {
          $order=Order::with('adminOrder')->where('status',2)->latest()->get();
         return view('admin.order.pending',compact('order'));
    }

    public function SuccessPaymentOrder()
    {
          $order=Order::with('adminOrder')->where('status',3)->latest()->get();
         return view('admin.order.pending',compact('order'));
    }

    public function DeleveryProgress($id)
    {
         DB::table('orders')->where('id',$id)->update(['status'=>2]);
        $notification=array(
                 'messege'=>'Please Go To Progress Delivery',
                 'alert-type'=>'success'
                       );
        return Redirect('admin/get-equicke-ladystore-view-order-accept/payment')->with($notification);
    }

    public function DeleveryDone($id)
    {

        $product=DB::table('order_details')->where('order_id',$id)->latest()->get();

        foreach ($product as $row) {
            DB::table('products')
              ->where('id',$row->product_id)
              ->update(['product_quantity' => DB::raw('product_quantity -'.$row->product_quantity)]);
        }

        DB::table('orders')->where('id',$id)->update(['status'=>3]);
        $notification=array(
                 'messege'=>'Send To Delivery',
                 'alert-type'=>'success'
                       );
        return Redirect('admin/admin/get-equicke-ladystore-view-order-accept-payment-success/payment')->with($notification);
    }
    public function invoice($id){
        $orderInvoice=Order::with('products','shipping')->where('id',$id)->first();
         $user_id = $orderInvoice->user_id;
        $total_order=OrderDetail::where('user_id',$user_id)->count();
        //echo $total_order;die;
        //$orderInvoice=json_decode(json_encode($orderInvoice));
        //echo"<pre>";print_r($orderInvoice);die;
         $user_id = $orderInvoice->user_id;
         $userDetails = User::where('id',$user_id)->first();
         $shipping=DB::table('shipping_addresses')->where('order_id',$id)->first();
          $sitesetting=DB::table('sitesettings')->where('status',1)->first();
        return view('admin.order.invoice',compact('orderInvoice','userDetails','shipping','sitesetting','total_order'));
    }
    
    public function inventory(Request $request){
        $title="Inventory Lists";
        $filter=$request->filter;
        if(!empty($filter)){
            $products=Product::where('status',1)
            ->where('product_name',$filter)
            ->orWhere('selling_price',$filter)
            ->orWhere('product_code',$filter)
            ->get();
            return view('admin.order.inventory',compact('title','products'));
        }
        
        $products=Product::where('status',1)->get();
        return view('admin.order.inventory',compact('title','products'));
    }
    
    public function indexReturn(){
        Session::put('page','return');
        $title="Return Product List";
        $returns=ReturnProduct::get();
        return view('admin.return.index',compact('title','returns'));
    }
    
    public function updateReturn(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $id=$data['id'];
            $return=ReturnProduct::where('id',$id)->first();
            ReturnProduct::where('id',$id)->update(['status'=>$data['status']]);
            OrderDetail::where(['order_id'=>$return->order_id,'product_size'=>$return->product_size,'product_code'=>$return->product_code])->update(['item_status'=>'Return '.$data['status']]);
            $getOrderdetail=OrderDetail::where(['order_id'=>$return->order_id,'product_size'=>$return->product_size,'product_code'=>$return->product_code])->first()->toArray();
           
            
            if($data['status']=='Approved'){
                $messagesms="Your Return Product " .$getOrderdetail['product_name']." &nbsp;" .$getOrderdetail['product_code']." &nbsp;" .$getOrderdetail['product_size']." has been Approved";
            }else{
               $messagesms="Your Return Product " .$getOrderdetail['product_name']. " &nbsp;" .$getOrderdetail['product_code']. " &nbsp;".$getOrderdetail['product_size']." has been Rejected, Due To insufficient Reasons and Data.";
            }
            
            //user Details
            $user=User::select('name','phone','email')->where('id',$return->user_id)->first()->toArray();
            if($user['phone']){
                    $getSms=SmsGateway::where('status',1)->get();
                    if(count($getSms)>0){
                        if($getSms[0]->title == 'ssl'){
                            $sender = Sender::getInstance();
                            $sender->setProvider(Ssl::class); 
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                $email = $user['email'];
                $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                $messageData=[
                'name'=>$user['name'],
                'phone'=>$user['phone'],
                'email'=>$email,
                'status'=>$messagesms,
                'sitesetting'=>$sitesetting,
            ];
        
        Mail::send('emails.order_return_status',$messageData,function($message) use ($email){
            $message->to($email)->subject('Return Order Status!!'); });
        }
        
        Session::flash('success','Status Updated Successfully');
        return redirect()->back();
    }
    
    // Exchange Products 
    
    public function indexExchange(){
        Session::put('page','exchange');
        $title="Product Exchange Page";
        $exchanges=ExchangeProduct::get();
        return view('admin.return.exchange.index',compact('title','exchanges'));
    }
    
    public function updateExchange(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $id=$data['id'];
            $return=ExchangeProduct::where('id',$id)->first();
            //dd($return);
            
            
            $getOrderdetail=OrderDetail::where(['order_id'=>$return->order_id,'product_size'=>$return->product_size,'product_code'=>$return->product_code])->first()->toArray();
            //dd($getOrderdetail);
            $OrderdetailCount=OrderDetail::where(['order_id'=>$return->order_id,'product_size'=>$return->product_size,'product_code'=>$return->product_code])->first();
            $OrderdetailCountCount=OrderDetail::where(['order_id'=>$return->order_id,'product_size'=>$return->product_size,'product_code'=>$return->product_code])->count();
            ExchangeProduct::where('id',$id)->update(['status'=>$data['status']]);
            if($OrderdetailCountCount>0){
               if($data['status']=='Approved'){
                // =====Prouct Attribute for new Set=======//
                
                $product_id=Product::select('id')->where('product_code',$return->product_code)->first();
                $productId=$product_id->id;
                $productSizes =AttributeProduct::select('weight_size','stock')->where('product_id',$productId)->where('weight_size',$return->required_size)->first();
                //dd($productSizes->weight_size);die;
                $getStock=$productSizes->stock - $OrderdetailCount->product_quantity;
                AttributeProduct::select('weight_size','stock')->where('product_id',$productId)->where('weight_size',$return->required_size)->update(['stock'=>$getStock]);
                
                // =====Prouct Attribute for Old Set=========//
                
                $productOldSizes =AttributeProduct::select('weight_size','stock')->where('product_id',$productId)->where('weight_size',$return->product_size)->first();
                $getOldStock=$productOldSizes->stock + $OrderdetailCount->product_quantity;
                AttributeProduct::select('weight_size','stock')->where('product_id',$productId)->where('weight_size',$return->product_size)->update(['stock'=>$getOldStock]);
                
                // ============Product order details update==============//
                
                OrderDetail::where(['order_id'=>$return->order_id,'product_size'=>$return->product_size,'product_code'=>$return->product_code])->update(['item_status'=>'Exchange '.$data['status'],'product_size'=>$return->required_size]);
                $messagesms="Your Exchange Product " .$getOrderdetail['product_name']." &nbsp;" .$getOrderdetail['product_code']." &nbsp;"."New Size"." &nbsp;" .$getOrderdetail['product_size']." has been Approved";
            }else{
                $messagesms="Your Return Product " .$getOrderdetail['product_name']. " &nbsp;" .$getOrderdetail['product_code']. " &nbsp;".$getOrderdetail['product_size']." has been Rejected, Due To insufficient Stock Right Now.";
            }
            
            //user Details
            $user=User::select('name','phone','email')->where('id',$return->user_id)->first()->toArray();
            if($user['phone']){
                    $getSms=SmsGateway::where('status',1)->get();
                    if(count($getSms)>0){
                        if($getSms[0]->title == 'ssl'){
                            $sender = Sender::getInstance();
                            $sender->setProvider(Ssl::class); 
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                            $sender->setMobile($user['phone']);
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
                $email = $user['email'];
                $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                $messageData=[
                'name'=>$user['name'],
                'phone'=>$user['phone'],
                'email'=>$email,
                'status'=>$messagesms,
                'sitesetting'=>$sitesetting,
            ];
        
            Mail::send('emails.order_exchange_status',$messageData,function($message) use ($email){
            $message->to($email)->subject('Exchange Product Status!!'); }); 
           }else{
               Session::flash('success','No Item to Updated Successfully');
               return redirect()->back();
            } 
        }
        
        Session::flash('success','Status Updated Successfully');
        return redirect()->back();
    }


}

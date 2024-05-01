<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOMeta;
use DB;
use Illuminate\Http\Request;
use App\Library\SslCommerz\SslCommerzNotification;
use App\Order;
use Session;
use Mail;
use App\SMS;
use Auth;
use App\CartModal;
use App\Shipping;
use App\Payment;
use App\User;
class SslCommerzPaymentController extends Controller
{

    public function ssl(){
         SEOMeta::setTitle('SSL Payment');
        if(Session::has('order_id')){
            return view('pages.ssl.ssl');
        }else{
            return redirect('product/cart-page');
        }
    }

    public function payViaAjax(Request $request)
    {
        //dd($request->all());
        # Here you have to receive all the order data to initate the payment.
        # Lets your oder trnsaction informations are saving in a table called "orders"
        # In orders table order uniq identity is "transaction_id","status" field contain status of the transaction, "amount" is the order amount to be paid and "currency" is for storing Site Currency which will be checked with paid currency.
        $requestData=(array)json_decode($request->cart_json);
        //dd($requestData);
        $post_data = array();
        $post_data['total_amount'] =  $requestData['amount']; # You cant not pay less than 10
        $post_data['currency'] = $requestData['currency'];
        $post_data['tran_id'] = $requestData['order_id']; // tran_id must be unique

        # CUSTOMER INFORMATION
        $post_data['cus_name'] = $requestData['cus_name'];
        $post_data['cus_email'] = $requestData['cus_email'];
        $post_data['cus_add1'] = $requestData['cus_addr1'];
        $post_data['cus_add2'] = "";
        $post_data['cus_city'] = $requestData['cus_city'];
        $post_data['cus_state'] = $requestData['cus_state'];
        $post_data['cus_postcode'] = $requestData['cus_postcode'];
        $post_data['cus_country'] = $requestData['cus_country'];
        $post_data['cus_phone'] =$requestData['cus_phone'];
        $post_data['cus_fax'] = "";

        # SHIPMENT INFORMATION
        $post_data['ship_name'] = "Store Test";
        $post_data['ship_add1'] = "Dhaka";
        $post_data['ship_add2'] = "Dhaka";
        $post_data['ship_city'] = "Dhaka";
        $post_data['ship_state'] = "Dhaka";
        $post_data['ship_postcode'] = "1000";
        $post_data['ship_phone'] = "";
        $post_data['ship_country'] = "Bangladesh";

        $post_data['shipping_method'] = "NO";
        $post_data['product_name'] = "computer";
        $post_data['product_category'] = "Goods";
        $post_data['product_profile'] = "physical-goods";

        # OPTIONAL PARAMETERS
        $post_data['value_a'] = "ref001";
        $post_data['value_b'] = "ref002";
        $post_data['value_c'] = "ref003";
        $post_data['value_d'] = "ref004";


        #Before  going to initiate the payment order status need to update as Pending.
        // $update_product = DB::table('orders')
        //     ->where('transaction_id', $post_data['tran_id'])
        //     ->updateOrInsert([
        //         'name' => $post_data['cus_name'],
        //         'email' => $post_data['cus_email'],
        //         'phone' => $post_data['cus_phone'],
        //         'amount' => $post_data['total_amount'],
        //         'status' => 'Pending',
        //         'address' => $post_data['cus_add1'],
        //         'transaction_id' => $post_data['tran_id'],
        //         'currency' => $post_data['currency']
        //     ]);

        $sslc = new SslCommerzNotification();
       //echo "<pre>"; print_r($sslc); die;
        # initiate(Transaction Data , false: Redirect to SSLCOMMERZ gateway/ true: Show all the Payement gateway here )
        $payment_options = $sslc->makePayment($post_data, 'checkout', 'json');
        //echo "<pre>"; print_r($payment_options); die;

        if (!is_array($payment_options)) {
            print_r($payment_options);
            $payment_options = array();
            //dd($payment_options);
        }

    }

    public function paymentSuccess(Request $request)
    {
        //dd($request->all());
        //$data=$request->all();
        echo "<pre>"; print_r($data); die;
        $status=$request->input('status');
        $payer_email=$request->input('verify_sign');
        $amount=$request->input('amount');
        $order_id=$request->input('tran_id');
        $value=$request->input('val_id');
        $card_type=$request->input('card_type');
        $currency=$request->input('currency');
        $bank_tran_id=$request->input('bank_tran_id');
        
        if($status == "VALID"){
            $order_id = Session::get('order_id');
            Order::where('id',$order_id)->update(['payment_status'=>'paid','blnc_transection'=>$bank_tran_id,'currency'=>$currency,'payment_type'=>'prepaid','status'=>1]);
            $payment=new Payment();
            $payment->order_id=$order_id;
            $payment->user_id=Auth::user()->id;
            $payment->payment_id=$value;
            $payment->payer_id=$card_type;
            $payment->payer_email=$payer_email;
            $payment->amount=$amount;
            $payment->currency=$currency;
            $payment->bank_tran_id=$bank_tran_id;
            $payment->payment_status=$status;
            $payment->save();
            
            //===Sms Gateawy====//
            $message="Dear Customer order".$order_id."has Been Successfully Placed";
            $mobile=Auth::user()->phone;
            SMS::sendSms($message,$mobile);

            $productDetails = Order::with('products','shipping')->where('id',$order_id)->first();
            $productDetails = json_decode(json_encode($productDetails),true);
            $shippinAddress=Shipping::where('user_id',Auth::user()->id)->first();
            $userDetails = User::where('id',Auth::user()->id)->first();
            $userDetails = json_decode(json_encode($userDetails),true);
            $sitesetting=DB::table('sitesettings')->where('status',1)->first();
            
                $email = Auth::user()->email;
                $messageData = [
                    'email' => $email,
                    'name' => Auth::user()->name,
                    'order_id' => $order_id,
                    'productDetails' => $productDetails,
                    'userDetails' => $userDetails,
                    'shippinAddress'=>$shippinAddress,
                    'sitesetting'=>$sitesetting,
                ];
                
                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Thanks for your Order!');
            });
            
            CartModal::where('user_id',Auth::user()->id)->delete();
            return view('pages.ssl.success');
            
        }else{
             $order_id = Session::get('order_id');
             Order::where('id',$order_id)->update(['payment_status'=>'Payment Failed']);
             return redirect('fail');
        }
    }

    public function fail(Request $request)
    {
        $tran_id = $request->input('bank_tran_id');

        $order_details = DB::table('orders')
            ->where('blnc_transection', $tran_id)
            ->select('blnc_transection', 'payment_status','total')->first();

        if ($order_details->payment_status == 'Payment Failed') {
            $update_product = DB::table('orders')
                ->where('blnc_transection', $tran_id)
                ->update(['status' => 'Payment Failed']);
            Session::flash('error','Transaction is Failed');
        } else if ($order_details->status == 2 || $order_details->status == 3) {
           
            Session::flash('error','Transaction is already Successful');
        } else {
            Session::flash('error','Invalid Transaction');
        }

    }

    public function cancel(Request $request)
    {
        $tran_id = $request->input('bank_tran_id');

        $order_details = DB::table('orders')
            ->where('blnc_transection', $tran_id)
            ->select('blnc_transection', 'payment_status','total')->first();

        if ($order_details->payment_status == 'Payment Failed') {
            $update_product = DB::table('orders')
                ->where('blnc_transection', $tran_id)
                ->update(['status' => 'Payment Failed']);
            Session::flash('error','Transaction is Failed');
        } else if ($order_details->status == 2 || $order_details->status == 3) {
           
            Session::flash('error','Transaction is already Successful');
        } else {
            Session::flash('error','Invalid Transaction');
        }
    }

    public function ipn(Request $request)
    {
        
        if ($request->input('bank_tran_id')) #Check transation id is posted or not.
        {

            $tran_id = $request->input('bank_tran_id');

            #Check order status in order tabel against the transaction id or order id.
            $order_details = DB::table('orders')
                ->where('blnc_transection', $tran_id)
                ->select('blnc_transection', 'payment_status', 'total')->first();

            if ($order_details->status == 'Pending') {
                $sslc = new SslCommerzNotification();
                $validation = $sslc->orderValidate($request->all(), $tran_id, $order_details->total, $order_details->currency);
                if ($validation == TRUE) {
                    
                    $update_product = DB::table('payments')
                        ->where('bank_tran_id', $tran_id)
                        ->update(['status' => 'Completed']);

                    
                    Session::flash('success','Transaction is successfully Completed');
                }
                
            } else if ($order_details->status == 2 || $order_details->status == 3) {
                
                Session::flash('error','Transaction is already successfully Completed');
                
            } else {
                
                Session::flash('error','Invalid Transaction');
            }
        } else {
           Session::flash('error','Invalid Data');
        }
    }

}

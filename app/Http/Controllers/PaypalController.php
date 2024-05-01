<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Artesaos\SEOTools\Facades\SEOMeta;
use Omnipay\Omnipay;
use App\Payment;
use App\CartModal;
use App\Shipping;
use App\Order;
use App\SMS;
use App\User;
use Auth;
use DB;
use Mail;
class PaypalController extends Controller
{
    private $gateway;
    
    public function __construct(){
        $getPaypal=DB::table('payment_gateways')->where('status',1)->where('type','paypal')->first();
        $this->gateway=Omnipay::create('PayPal_Rest');
        $this->gateway->setClientId($getPaypal->store_id);
        $this->gateway->setSecret($getPaypal->signature_id);
        $this->gateway->setTestMode(true);
    }
    
    public function paypal(){
        SEOMeta::setTitle('Paypal Payment');
        if(Session::has('order_id')){
            return view('pages.paypal.paypal');
        }else{
            return redirect('product/cart-page');
        }
    }
    
    public function pay(Request $request){
        try{
            $paypal_amount=round(Session::get('grand_total'),2);
            $response=$this->gateway->purchase(array(
               'amount'=>$paypal_amount,
               'currency'=>env('PAYPAL_CURRENCY'),
               'returnUrl'=>url('success'),
               'cancelUrl'=>url('error'),
               ))->send();
               
                if($response->isRedirect()){
                   $response->redirect();
                }else{
                   return $response->getMessage();
                }
        }catch(\Throwable $th){
            return $th->getMessage();
        }
    }
    public function success(Request $request){
        if($request->input('paymentId') && $request->input('PayerID')){
            $transaction=$this->gateway->completePurchase(array(
              'payer_id'=>$request->input('PayerID'),
              'transactionReference'=>$request->input('paymentId'),
            ));
            
            $response=$transaction->send();
            if($response->isSuccessful()){
                $arr=$response->getData();
                $payment=new Payment();
                $payment->order_id=Session::get('order_id');
                $payment->user_id=Auth::user()->id;
                $payment->payment_id=$arr['id'];
                $payment->payer_id=$arr['payer']['payer_info']['payer_id'];
                $payment->payer_email=$arr['payer']['payer_info']['email'];
                $payment->amount=$arr['transactions'][0]['amount']['total'];
                $payment->currency=env('PAYPAL_CURRENCY');
                $payment->payment_status=$arr['state'];
                $payment->save();
                
                
                //===order update====//
                
                $order_id=Session::get('order_id');
                Order::where('id',$order_id)->update(['status'=>1,'payment_type'=>'prepaid','blnc_transection'=>$arr['payer']['payer_info']['payer_id'],'currency'=>$currency,'payment_type'=>'prepaid']);
                
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
                return view('pages.paypal.success');
            }else{
                return $reasponse->getMessage();
            }
              
        }else{
            return "Payment Decline";
        }
    }
    public function error(){
        return view('pages.paypal.fail');
    }
}

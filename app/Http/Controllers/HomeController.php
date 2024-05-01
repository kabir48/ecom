<?php

namespace App\Http\Controllers;
use Auth;
use Session;
use App\User;
use App\ProductComment;
use App\WishlistTable;
use App\Shipping;
use App\Product;
use App\Country;
use App\AttributeProduct;
use App\Order;
use App\District;
use App\ProductRating;
use App\CartModal;
use App\ExchangeProduct;
use App\Sitesetting;
use App\ReturnProduct;
use App\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use File;
use Image;
use Mail;
use Cache;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        //$session_id=Session::get('user_id');
        $orders = Order::where('user_id',Auth::user()->id)->count();
        $activeOrders =  Order::where('user_id',Auth::user()->id)->where('status',0)->count();
        $cancledOrders = Order::where('user_id',Auth::user()->id)->where('return_order',1)->count();
        $orders = Order::with('products')->where('user_id',Auth::user()->id)->orderBy('id','DESC')->limit(4)->get()->toArray();
        $totalOrder = Order::with('products')->where('user_id',Auth::user()->id)->sum('total');
        $wishlists=WishlistTable::with(['products'])->where('user_id',Auth::id())->get()->toArray();
        $shippings=Shipping::where('user_id',Auth::user()->id)->get();
        $districs=District::where('status',1)->get();
        $countries=Country::where('status',1)->get();
        $setting=Sitesetting::where('status',1)->first();
        //dd($getProducts);
        //======Seo parts==========//
        $actual_link="http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
        $home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$home_link.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle($setting->company_name);
        SEOMeta::setCanonical($actual_link);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle($setting->company_name);
        return view('pages.customer.dashboard',compact('orders', 'activeOrders','cancledOrders','orders','totalOrder','wishlists','shippings','districs','countries'));
    }
    public function billingAddress(Request $request,$id){
        $shippings=Shipping::where('user_id',Auth::user()->id)->find($id);
        if($request->isMethod('post')){
            //dd($request->all());
            $data=$request->all();
            $shippings->name = $data['name'];
            $shippings->phone = $data['phone'];
            $shippings->address = $data['address'];
            $shippings->country = $data['country'];
            $shippings->area = $data['area'];
            $shippings->save();
            $message="Information Updated Successfully";
            Session::flash('success',$message);
            return Redirect()->back();
        }
        $countries=Country::where('status',1)->get();
        return view('pages.customer.append.address',compact('shippings','countries'));
    }


    public function changePassword(){
        return view('auth.changepassword');
    }
  
    
    public function logout(){
        Cache::flush();
        Auth::logout();
        Session::flash('success','Logout Successfully');
        return redirect('/');
    }
    
    
    public function orderShow($id)
    {
        
        $orderDetailCount=Order::with('products')->where('user_id',Auth::user()->id)->where('id',$id)->count();
        //dd($orderDetailCount);
        $orderDetails=Order::with('products')->where('user_id',Auth::user()->id)->where('id',$id)->orderBy('id','DESC')->limit(4)->first()->toArray();
      
        return view('pages.customer.show',compact('orderDetails','orderDetailCount'));

    }
    public function returnList()
    {
         $orders=DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->limit(4)->get()->toArray();
         $setting=DB::table('sitesettings')->first();
         return view('pages.customer.return',compact('orders','setting'));
    }

    public function RequestReturn(Request $request,$id)
    {
        
        $orderDetail=OrderDetail::with(['product'])->find($id);
        if($request->isMethod('post')){
            $data=$request->all();
           // dd($data);die;
            $auth_id=Auth::user()->id;
            if($auth_id){
                //get product from multiple select value
                //$productArr=explode("-",$data('product_inf'));
                //$product_code=$productArr[0];
                //$product_size=$productArr[1];
                OrderDetail::where(['id'=>$id,'product_code'=>$data['product_code'],'product_size'=>$data['product_size']])->update(['item_status'=>"Return Initiated"]);
                $return =new ReturnProduct();
                $return->user_id=$auth_id;
                $return->order_id=$orderDetail->order_id;
                $return->product_code=$data['product_code'];
                $return->product_size=$data['product_size'];
                $return->return_reason=$data['return_reason'];
                $return->status="Pending";
                $return->note=$data['note'];
                $return->save();
                $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                $email = Auth::user()->email;
                $messageData=[
                    'name'=>Auth::user()->name,
                    'email'=>$email,
                    'productDetail'=>$orderDetail,
                    'sitesetting'=>$sitesetting,
                ];
                Mail::send('emails.return_product',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Return Product!!'); });
                $message="Product Return Has Been Placed Successfully!";
                Session::flash('success',$message);
                return redirect()->back(); 
                
            }else{
                $message="Your Request Is not Valid!";
                Session::flash('error',$message);
                return redirect()->back(); 
            }
        }
        
        return view('pages.customer.append.return',compact('orderDetail'));
       
    }
    public function CheckPassword(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            //echo"<pre>";print_r($data);die;
            $user_id=Auth::user()->id;
            $checkPassword=User::select('password')->where('id',$user_id)->first();
            if(Hash::check($data['current_pwd'],$checkPassword->password)){
                return "true";
            }else{
               return "false";
            }
        }
    }
    public function UpdatePassword(Request $request){
          if($request->isMethod('post')){
            $data=$request->all();
            //echo"<pre>";print_r($data);die;
            $user_id=Auth::user()->id;
            $checkPassword=User::select('password')->where('id',$user_id)->first();
            if(Hash::check($data['current_pwd'], $checkPassword->password)){
                //update password
                $new_password=bcrypt($data['new_password']);
                User::where('id',$user_id)->update(['password'=>$new_password]);
                $message="Password Updated successfully!";
                Session::flash('success',$message);
                return redirect()->back();
            }else{
               $message="Current Password is Incorrect!";
                Session::flash('error',$message);
                return redirect()->back();
            }
        }
    }
    
    public function profileUpdate(Request $request){
        
        //dd($request->all());
        
        if($request->isMethod('post')){
            $user=User::find(Auth::user()->id);
            $data=$request->all();
            $user->name=$data['name'];
            $user->email=$data['email'];
            $user->phone=$data['phone'];
            if ($request->hasFile('image')) {
                $location='public/media/user/'.$user->image;
                if(File::exists($location)){
                    File::delete($location);
                }
                $image_tmp = $request->file('image');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension = $image_tmp->getClientOriginalExtension();
                   
                    $imageName =  rand(111, 99999) . '.' . $extension;
                    $path = 'public/media/user/'.$imageName;
                    Image::make($image_tmp)->resize(102,102)->save($path,60);
                    $user->image = $imageName;
                }
            }
            $user->save();
            Session::flash('success','Profle Updated Successfully');
            return redirect('customer/dashboard');
        }
    }

    public function addReview(Request $request){
        $reviewCount=ProductRating::where('product_id',$request->product_id)->where('user_id',$request->user_id)->where('order_id',$request->order_id)->count();
        if($reviewCount>0){
            Session::flash('success','You were submitted the review');
            return redirect()->back();
        }
        if($request->isMethod('post')){
            $review= new ProductRating();
            $data=$request->all();
            //dd($data);
            $review->product_id=$data['product_id'];
            $review->order_id=$data['order_id'];
            $review->user_id=$data['user_id'];
            $review->review=$data['review'];
            $review->rating=$data['rating'];
            
            $review->size_review=$data['size_review'];
            $review->size_rating=$data['size_rating'];
            
            $review->color_review=$data['color_review'];
            $review->color_rating=$data['color_rating'];
        
            
            $getSize=AttributeProduct::where('product_id',$data['product_id'])->first();
            $review->product_size=$getSize->weight_size;
            $review->created_at=date('d-m-Y');
            $review->save();
             $message='Your Review has been published.Thanks for The Review';
            Session::flash('success',$message);
            return redirect()->back();
        }
    }
    public function updateReview(request $request,$id){
        $review=ProductRating::find($id);
        if($request->isMethod('post')){
            $data=$request->all();
            $review->review=$data['review'];
            $review->rating=$data['rating'];
            $review->size_review=$data['size_review'];
            $review->size_rating=$data['size_rating'];
            $review->color_review=$data['color_review'];
            $review->color_rating=$data['color_rating'];
            $review->created_at=date('d-m-Y');
            $review->save();
            $message='Your Review has been Updated';
            Session::flash('success',$message);
            return redirect()->back();
        }
        
        return view('pages.customer.append.rating',compact('review'));
    }
    public function SendComment(Request $request){
        $comment=new ProductComment;
        if($request->isMethod('post')){
            $this->validate($request,[
                 'comment'=>'required|string|max:200',
            ]);

            $data=$request->all();
            $user=Auth::user()->id;
            $comment->comment=$data['comment'];
            $comment->user_id=$user;
            $comment->product_id=$data['product_id'];
            $comment->save();
            $message='Your Comment Has been published.Thanks for Your Comment';
            Session::flash('success',$message);
            return redirect()->back();
        }
        return view('pages.product_details');

     }

     public function viewOrderInvoice($id){
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
        return view('pages.customer.invoice',compact('orderInvoice','userDetails','shipping','sitesetting','total_order'));
    }
    
    public function cancelOrder(Request $request,$id){
        $user_id=Auth::user()->id;
        $order_detail=OrderDetail::where('user_id',$user_id)->find($id);
        if($request->isMethod('post')){
            if($request->confirm=='yes'){
                if($order_detail){
                    DB::beginTransaction();
                   $getOrder=Order::where('id',$order_detail->order_id)->first();
                   $reductTotal=$getOrder->subtotal - $order_detail->total_price_amount;
                   //dd($reductTotal);
                  
                    if($reductTotal == 0 || $reductTotal<0){
                       $getOrder->delete();
                   }else{
                       $mainTotal=$getOrder->total - $order_detail->total_price_amount;
                       Order::where('id',$order_detail->order_id)->update(['subtotal'=>$reductTotal,'total'=>$mainTotal]);
                   }
                  
                   $order_detail->delete();
                   DB::commit();
                   Session::flash('success','Product is canceled Sucessfully');
                   return redirect('customer/dashboard');
                   
                }
            } 
        }
        
        return view('pages.customer.append.cancel',compact('order_detail'));
    }
    
    
    //===========Advance cancel code============
    
    
    //  public function cancelOrder(Request $request,$id){
    //     $user_id=Auth::user()->id;
    //     $order_detail=OrderDetail::where('user_id',$user_id)->find($id);
    //     if($request->isMethod('post')){
    //         if($request->confirm=='yes'){
    //             if($order_detail){
    //                 DB::beginTransaction();
    //               $getOrder=Order::where('id',$order_detail->order_id)->first();
    //               $reductTotal=$getOrder->subtotal - $order_detail->total_price_amount;
    //               //dd($reductTotal);
                  
    //               //product quantity update
    //               $getProduct=Product::where('id',$order_detail->product_id)->first();
    //                 //dd($getProduct->product_quantity);
    //               $addQuantity=$getProduct->product_quantity + $order_detail->product_quantity;
    //               //dd($addQuantity);
                
    //               Product::where('id',$order_detail->product_id)->update(['product_quantity'=>$addQuantity]);
    //                 if($reductTotal == 0 || $reductTotal<0){
    //                   $getOrder->delete();
    //               }else{
    //                   $mainTotal=$getOrder->total - $order_detail->total_price_amount;
    //                   Order::where('id',$order_detail->order_id)->update(['subtotal'=>$reductTotal,'total'=>$mainTotal]);
    //               }
                   
                   
    //               //product Attribute update
    //               $getAttribute=AttributeProduct::where('product_id',$order_detail->product_id)->where('weight_size',$order_detail->product_size)->first();
    //               $addStock=$getAttribute->stock + $order_detail->product_quantity;
    //               AttributeProduct::where('product_id',$order_detail->product_id)->where('weight_size',$order_detail->product_size)->update(['stock'=>$addStock]);
    //               $order_detail->delete();
    //               DB::commit();
    //               Session::flash('success','Product is canceled Sucessfully');
    //               return redirect('customer/dashboard');
                   
    //             }
    //         } 
    //     }
        
    //     return view('pages.customer.append.cancel',compact('order_detail'));
    // }
    
    public function customerAddtoCart(Request $request){
        $product_id=$request->input('product_id');
        $weight_size=$request->input('weight_size');
        $qty_input=$request->input('qty_input');
        if(empty($weight_size)){
            return response()->json(['error'=>'You Cant Avoid Size']);
          }else{
        if(Auth::check()){
           $getProduct=Product::where(['id'=>$product_id])->first()->toArray();
             if($getProduct['status'] ==0){
                return response()->json(['status'=>'Required product is Disabled Please Choose Another one']);
            }
            //product stock avaialable
            $getProductStock=AttributeProduct::where(['product_id'=>$product_id,'weight_size'=>$weight_size])->first()->toArray();
            if($getProductStock['status'] ==0){
                
                return response()->json(['status'=>'Required Quantity Disabled Please Choose Another one']);
            }
            //echo $getProductStock['stock'];die;
            if($getProductStock['stock'] < $qty_input){
                return response()->json(['status'=>'Required Quantity is not avaialable']);
            }
            // Generate session id not exit
            $session_id =Session::get('session_id');
            if(empty($session_id)){
                $session_id=Session::getId();
                Session::put('session_id',$session_id);
            }
            if(Auth::check()){
                $countProducts = CartModal::where(['product_id'=>$product_id,'weight_size'=>$weight_size,'user_id'=>Auth::user()->id])->count();
            }else{
                $countProducts = CartModal::where(['product_id'=>$product_id,'weight_size'=>$weight_size,'session_id'=>Session::get('session_id')])->count();

            }

            if($countProducts>0){
                return response()->json(['status'=>'Product Already Exist in cart!']);
            }
            
            $cart=new CartModal();
            $cart->session_id=$session_id;
            $cart->user_id=Auth::user()->id??'0';
            $cart->product_id=$product_id;
            $cart->weight_size=$weight_size;
            $cart->quantity=$qty_input;
            $cart->save();
            return response()->json(['status'=>'Product Added Successfully']);
            
        }
          }
    }
    
    public function exchangeProduct(Request $request){
        $data=$request->all();
        //echo"<pre>";print_r($data);die;
        $productArr=explode('-',$data['product_info']);
        $product_code=$productArr[0];
        $product_size=$productArr[1];
        //dd($product_size);die;
        $product_id=Product::select('id')->where('product_code',$product_code)->first();
        $productId=$product_id->id;
        $productSizes =AttributeProduct::select('weight_size')->where('product_id',$productId)->where('weight_size','!=',$product_size)->where('stock','>',0)->get()->toArray();
        //dd($productSizes);die;
        $appendSizes='<option value="">Select Require Size</option>';
        foreach($productSizes as $size){
            $appendSizes .='<option value="'.$size['weight_size'].'">'.$size['weight_size'].'</option>';
        }
        return $appendSizes;
    }
    
    public function exchangeProductSubmit($id,Request $request){
        
        if($request->isMethod('post')){
            $data=$request->all();
             $auth_id=Auth::user()->id;
            if($auth_id){
                //get product from multiple select value
                $productArr= explode('-',$data['product_info']);
                $product_code=$productArr[0];
                $product_size=$productArr[1];
                $orderDetail=OrderDetail::with(['product'])->where('order_id',$id)->where('product_code',$product_code)->where('product_size',$product_size)->first();
                OrderDetail::where(['order_id'=>$id,'product_code'=>$product_code,'product_size'=>$product_size])->update(['item_status'=>"Exchange Initiated"]);
                $return =new ExchangeProduct();
                $return->user_id=$auth_id;
                $return->order_id=$orderDetail->order_id;
                $return->product_code=$product_code;
                $return->product_size=$product_size;
                $return->required_size=$data['required_size'];
                $return->exchange_reason=$data['exchange_reason'];
                $return->status="Pending";
                $return->note=$data['note'];
                $return->save();
                $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                $email = Auth::user()->email;
                $messageData=[
                    'name'=>Auth::user()->name,
                    'email'=>$email,
                    'productDetail'=>$orderDetail,
                    'sitesetting'=>$sitesetting,
                ];
                Mail::send('emails.exchange_product',$messageData,function($message) use ($email){
                $message->to($email)->subject('Exchange Product!!'); });
                $message="Product Exchange Has Been Placed Successfully!";
                Session::flash('success',$message);
                return redirect()->back(); 
                
            }else{
                $message="Your Request Is not Valid!";
                Session::flash('error',$message);
                return redirect()->back(); 
            }
        }
    }
}

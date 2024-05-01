<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use Cart;
use Session;
use Response;
use App\Product;
use App\AttributeProduct;
use App\Wishlist;
use Illuminate\Http\Request;

class CartController extends Controller
{



    public function AddCart($id)
    {
    	  $product=DB::table('products')->where('id',$id)->first();
    	  $data=array();
    	  if ($product->discount_price == NULL) {
    	  	            $data['id']=$product->id;
    	                $data['name']=$product->product_name;
    	                $data['qty']=1;
    	                $data['price']= $product->selling_price;
    	 				$data['weight']=1;
    	                $data['options']['image']=$product->image_one;
                        $data['options']['color']='';
                        $data['options']['size']='';
    	               Cart::add($data);
    	               return response()->json(['success' => 'Successfully Added on your Cart']);
    	   }else{
    	               $data['id']=$product->id;
    	                $data['name']=$product->product_name;
    	                $data['qty']=1;
    	                $data['price']= $product->discount_price;
    	 				$data['weight']=1;
    	                $data['options']['image']=$product->image_one;
                        $data['options']['color']='';
                        $data['options']['size']='';

    	                Cart::add($data);
    	              return response()->json(['success' => 'Successfully Added on your Cart']);
    	 }
    }

    public function check()
    {
    	$content=Cart::content();
    	return response()->json($content);
    }

    public function showCart()
    {
        $cart=Cart::content();
       return view('pages.cart',compact('cart'));
    }

    public function removeCart($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function UpdateCart(Request $request)
    {
        $rowId =$request->productid;
        $qty=$request->qty;
        Cart::update($rowId, $qty);
        return redirect()->back();
    }

    public function ViewProduct($id)
    {
         //$product=DB::table('products')->where('products.id',$id)->first();

        //$color=$product->product_color;
        //$product_color = explode(',', $color);

        //$discounted_price=Product::getProductdiscount($id);



        //$size=$product->product_size;
        //$size =AttributeProduct::select('weight_size')->where('product_id',$product->id)->where('status',1)->get()->toArray();
        //$product_size_co = explode(',', $size);
        //dd($product_size);die;

        $prodetail =Product::with('category','brand','attributes')->where('id',$id)->first();
        $color=$prodetail->product_color;
        $product_color = explode(',', $color);
    	// $product_color = explode(',', $color);
    	// $size=$product->product_size;
    	//$product_size = explode(',', $size);
        //'product_color','product_size'
        $total_stock=AttributeProduct::where('product_id',$id)->sum('stock');
        $productDetails =Product::with(['category','brand','section','attributes'=>function($query){
            $query->where('status',1);
        },])->find($id)->toArray();
       //dd($productDetails);die;
        $product_attr=AttributeProduct::where('product_id',$id)->get()->toArray();

        $discounted_price=Product::getProductdiscount($id);

        return view('pages.modal_cart',compact('productDetails','total_stock','product_color','discounted_price','product_attr'));

       // return response()->json($product_color);
        // return response()->json(array(
        //         'product' => $product,
        //         'color' => $product_color,
        //         'size' => $size,
        //         'discount'=>$discounted_price,
        //  ));

    }

    public function InsertCart(Request $request)
    {
         $id=$request->product_id;
          $product=DB::table('products')->where('id',$id)->first();
          $data=array();
          if ($product->discount_price == NULL) {
                        $data['id']=$product->id;
                        $data['name']=$product->product_name;
                        $data['qty']=$request->qty;;
                        $data['price']= $product->selling_price;
                        $data['weight']=1;
                        $data['options']['image']=$product->image_one;
                        $data['options']['color']=$request->color;
                        $data['options']['size']=$request->size;
                      Cart::add($data);
                       $notification=array(
                              'messege'=>'Successfully Done',
                               'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
           }else{
                       $data['id']=$product->id;
                        $data['name']=$product->product_name;
                        $data['qty']=$request->qty;;
                        $data['price']= $product->discount_price;
                        $data['weight']=1;
                        $data['options']['image']=$product->image_one;
                        $data['options']['color']=$request->color;
                        $data['options']['size']=$request->size;
                        Cart::add($data);
                      $notification=array(
                              'messege'=>'Successfully Done',
                               'alert-type'=>'success'
                         );
                       return Redirect()->back()->with($notification);
         }
    }


    public function Checkout()
    {
        if (Auth::check()) {
              $cart=Cart::content();
              return view('pages.checkout',compact('cart'));
        }else{
           $notification=array(
                              'messege'=>'AT first login your account',
                               'alert-type'=>'success'
                         );
          return redirect()->route('login')->with($notification);
        }


    }

    public function Wishlist()
    {
        $userid=Auth::id();
        $product=DB::table('wishlists')->join('products','wishlists.product_id','products.id')
                          ->select('products.*','wishlists.user_id')
                          ->where('wishlists.user_id',$userid)
                          ->get();

        $meta_title = "Wish list,equickee";
        $meta_keywords = "wish list,online shop,products,dress,facewash,shampoo";
        return view('pages.wishlist')->with(compact('product','meta_title','meta_keywords'));
    }
public function delete($id){
     $userid=Auth::id();
     DB::table('wishlists')->where('user_id',$userid)->where('product_id',$id)->delete();
     $message="Wishlist Successfully Deleted!";
     Session::flash('error',$message);
     return redirect('user/wishlist');
}

    public function Coupon(Request $request)
    {
        $coupon=$request->coupon;
        $check=DB::table('coupons')->where('coupon',$coupon)->first();
        if ($check) {
              session::put('coupon',[
                  'name' => $check->coupon,
                  'discount' => $check->discount,
                  'balance' => Cart::Subtotal() - $check->discount
              ]);
              $notification=array(
                              'messege'=>'Successfully Coupon Applied',
                               'alert-type'=>'success'
                         );
            return redirect()->back()->with($notification);
        }else{
            $notification=array(
                              'messege'=>'Invalid Coupon',
                               'alert-type'=>'error'
                         );
            return redirect()->back()->with($notification);
        }

    }

    public function CouponRemove()
    {
         session::forget('coupon');
          return redirect()->back();
    }

    public function PymentPage()
    {
      $cart=Cart::content();
      return view('pages.payment',compact('cart'));
    }




}

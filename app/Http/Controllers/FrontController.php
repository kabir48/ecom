<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use App\SMS;
use App\Product;
use App\BptiCar;
use App\BptiForm;
use App\Model\Admin\Category;
use App\FindBpti;
use App\BptiSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class FrontController extends Controller
{
    public function StoreNewslater(Request $request)
    {
    	$validatedData = $request->validate([
        'email' => 'required|unique:newslaters|max:55',
        ]);

        $data=array();
        $data['email']=$request->email;
        DB::table('newslaters')->insert($data);
         $notification=array(
                'messege'=>'Thanks for subscribing ',
                'alert-type'=>'success'
                       );
        return Redirect()->back()->with($notification);
    }

    public function OrderTracking(Request $request)
    {
        $code=$request->code;
        $track=DB::table('orders')->where('status_code',$code)->first();
        if ($track){
            if($track->status==0){
               Session::flash('error',"Sorry!,Your Order Is Not Approved Yet!");
               return Redirect()->back(); 
            }else{
                $id=$track->id;
                $shipping=DB::table('shipping_addresses')->where('order_id',$id)->first();
                $details=DB::table('order_details')->join('products','order_details.product_id','products.id')->select('products.product_code','products.image_one','products.product_name_bangla','order_details.*')->where('order_details.order_id',$id)->get();
                return view('pages.track',compact('track','shipping','details'));
            }
        }else{
            $message="Tracking Code is Invalid Please Check!";
            Session::flash('error',$message);
            return Redirect()->back();
        }
    }

   
    
    // public function ProductSearchAjaxauto(Request $request)
    // {
    //     $query=$request->get('term','');
    //     $products=Product::with('category')->where('product_name','LIKE','%'.$query.'%')
    //     ->orWhere('product_name_bangla','LIKE','%'.$query.'%')
    //     ->where('status','1')->get();

    //     $data=[];
    //     foreach($products as $items){
    //         $data[]=[
    //             'value'=>$items->product_name,
    //             'ma'=>$items->product_name_bangla,
    //             'id'=>$items->id,
    //         ];
    //     }
    //     if(count($data)){
    //         return $data;
    //     }else{
    //         return ['value'=>'No Result Found','id'=>''];
    //     }
    // }
    public function result(Request $request){
        $search_product=$request->search;
        $products=Product::with('brand')->join('categories','categories.id','=','products.category_id')
            ->select('products.*','categories.*')
            ->where(function($query)use($search_product){
                $query->where('products.product_name','LIKE',$search_product.'%')
                ->orWhere('products.product_color','LIKE',$search_product.'%')
                ->orWhere('products.product_code','LIKE',$search_product.'%')
                ->orWhere('categories.category_name','LIKE',$search_product.'%');
                })->where('products.status',1)->first();
 
            if($products){
                return redirect('product/details/'.$products->id.'/'.$products->product_name);
            }else{
                return redirect('/')->with('error','Product is not available');
            }
    }

   
    // public function ProductSearch(Request $request){
    //      $query=$request->get('terms','');
    //     $products=Product::select('product_name')->where('product_name','LIKE','%'.$query.'%')->where('status','1')->get();
    //     //echo "<pre>";print_r($products);die;

    //     return response()->json($products);
    // }


// public function ProductSearchAjax(Request $request){
//     $serachingdata=$request->input('search_product');
//     $products=Product::where('product_name','LIKE','%'.$serachingdata.'%')
//      ->orWhere('product_name_bangla', 'LIKE','%'.$serachingdata.'%')
//      ->orWhere('product_name_bangla', 'LIKE','%'.$serachingdata.'%')
//      ->orWhere('product_code', 'LIKE','%'.$serachingdata.'%')
//     ->where('status',1)->where('select_type','Quickee')->first();
//     if($products){
//        if(isset($_POST['searchbtn']))
//        {
//            if($products->select_type=='Quickee'){
//                 return redirect('product/details/'.$products->id.'/'.$products->product_name);
//            }
//            else{
//                 return redirect('product/details/ladystore/'.$products->id.'/'.$products->product_name);
//            }
//        }
//        else{
//            return redirect('product/details/'.$products->id.'/'.$products->product_name);
//        }
//     }else{
//         return redirect('/')->with('error','Product is not available');
//     }


// }
//      public function searchProducts(Request $request){
//          $suplliers=BptiSupplier::where('status',1)->get();
//          $this->validate($request, [
//             'query' => 'required|string',
//         ]);
//         $query = $request->input('query');
//         $products = BptiCar::where('car_name', 'LIKE', "%$query%")
//         ->orWhere('model_no', 'LIKE', "%$query%")
//         ->orWhere('brand_name', 'LIKE', "%$query%")
//         ->orWhere('brand_name_bangla', 'LIKE', "%$query%")
//         ->orWhere('selling_price', 'LIKE', "%$query%")
//         ->orWhere('car_name_bangla', 'LIKE', "%$query%")
//         ->where('status',1)->latest()->paginate(6);
//          $page_name="listing";
//         return view('pages.bpti.search',compact('products', 'query','suplliers','page_name'));
//     }
// public function getBpti(){
//     $bpti=BptiCar::where('status',1)->get()->toArray();
//     //dd($bpti);die;
//     $models=FindBpti::where('status',1)->get();
//     //echo "<pre>";print_r($models);die;
//     $page_name="listing";
//     $meta_title = "::BPTI-CARS::";
//     return view('pages.bpti.bpti',compact('bpti','page_name','models','meta_title'));
// }

      public function Bangla()
     {
     	Session::get('lang');
     	session()->forget('lang');
     	Session::put('lang','bangla');
     	return redirect()->back();
     }

     public function English()
     {
     	Session::get('lang');
     	session()->forget('lang');
     	Session::put('lang','english');
     	return redirect()->back();
     }
    //  public function Bptiform(Request $request){
    //      if($request->isMethod('post')){
    //          $this->validate($request,[
    //              'name'=>'required',
    //              'email'=>'required',
    //              'phone'=>'required',
    //              ]);
    //         $data=$request->all();

    //      $info=new BptiForm;
    //      $info->name=$data['name'];
    //      $info->email=$data['email'];
    //      $info->phone=$data['phone'];
    //      $info->brand_name=$data['brand_name'];
    //      $info->car_name=$data['car_name'];
    //      $info->model_no=$data['model_no'];
    //      $info->save();
    //      $sitesetting=DB::table('sitesettings')->where('status',1)->first();
    //         $message="Dear Customer Email has Been Successfully Placed with equickee.com";
    //         $mobile=$data['phone'];
    //         SMS::sendSms($message,$mobile);
    //          $email=$data['email'];
    //          $messageData = [
    //                 'email' => $email,
    //                 'name' => $data['name'],
    //                 'phone' => $data['phone'],
    //                 'car_name' => $data['car_name'],
    //                 'model_no'=>$data['model_no'],
    //                 'brand_name'=>$data['brand_name'],
    //                 'sitesetting'=>$sitesetting,
    //             ];
    //             Mail::send('emails.bpti_email',$messageData,function($message) use($email){
    //                 $message->to($email)->subject('Thanks for your Query!');
    //             });
    //      $message="Your has been Submitted Successfully!";
    //      Session::flash('success',$message);
    //      return redirect('user/thank_page');
    //      }
    //  }
     public function ThankPage(){
         return view('pages.bpti.thank_page');
     }
}

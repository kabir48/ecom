<?php

namespace App\Http\Controllers;

use App\About;
use Session;
use App\Tearm;
use App\Contact;
use App\Product;
use App\ProductAdd;
use App\SalesTimer;
use Illuminate\Http\Request;
use App\OrderDetail;
use App\Post;
use App\VoiceCustomer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Faq;
use App\Order;
use App\Banner;
use App\PreOrder;
use App\PageBuilder;
use App\AttributeProduct;
use Auth;
use URL;
use App\ProductFilterValue;
use App\Coupon;
use App\Model\Admin\Brand;
use App\Model\Admin\Category;
use App\Sitesetting;
use App\QuickeeBanner;
use App\Subscriber;
use App\Section;
use Illuminate\Pagination\Paginator;
use App\VisitorIp;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use App\OccasionalEvent;
use Mail;
use App\Rules\EmailProvider;

class WebsiteController extends Controller
{
    public function index(){
         //Visitor Get Ip
        $clientIP = \Request::ip();
        $toDay=Carbon::now()->format('Y-m-d');
        $getIp=geoip()->getLocation($clientIP=null);
        $countIp=VisitorIp::where('ip',$getIp->ip)->where('date',$toDay)->count();
        //dd($getIp->country);
        if($countIp>0){

        }else{
            $visitorip=new VisitorIp();
            $visitorip->country= $getIp->country;
            $visitorip->ip= $getIp->ip;
            $visitorip->city= $getIp->city;
            $visitorip->currency= $getIp->currency;
            $visitorip->date= Carbon::now()->format('Y-m-d');
            $visitorip->save();
        }
      

        $sale=SalesTimer::where('status',1)->first();
        $addHome=ProductAdd::where('status',1)->where('location','home')->first();
        $setting=Sitesetting::where('status',1)->first();
        $actual_link = url()->full();
        //dd($home_link); 
        $home_image=$actual_link.'/'.'public/media/logo/seo/'.$setting->seo;
          
        SEOMeta::setTitle($setting->company_name);
        SEOMeta::setDescription($setting->description);
        SEOMeta::setCanonical($actual_link);
        SEOMeta::addKeyword($setting->keyword);

        OpenGraph::setDescription($setting->description);
        OpenGraph::setTitle($setting->company_name);
        OpenGraph::setUrl($actual_link);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);

        TwitterCard::setTitle($setting->company_name);
        TwitterCard::setSite($actual_link);

        JsonLd::setTitle($setting->company_name);
        JsonLd::setDescription($setting->description);
        JsonLd::addImage($home_image);
        
        //====Banner Parts starst====//
        $getBanners=Banner::getBanners();
        
        //=====Category Parts====//
        $cateDetail=Category::cateDetail();
        //====Mens Items====//
           //====formal shirt====//
           
        $getFormalShirts=Product::where('product_mode','Formal Shirt')->where('status',1)->where('is_publish','Yes')->get()->toArray(); 
        //dd($getFormalShirt);
        
        $newArrivals=Product::whereIn('product_mode',['Formal Shirt','Casual Shirt'])->where('status',1)->where('is_feature','Yes')->get()->toArray(); 
        $allCasuals=Product::where('product_mode','Casual Shirt')->where('is_publish','Yes')->where('status',1)->get()->toArray(); 
        
        //===Punjabi====//
        
        $allPanjabies=Product::whereIn('category_id',[1,2,3])->where('is_publish','Yes')->where('status',1)->get()->toArray(); 
        $newArrivalPanjabies=Product::whereIn('category_id',[1,2,3])->where('is_publish','Yes')->where('is_feature','Yes')->where('status',1)->get()->toArray(); 
        //dd($allPanjabies);
        //====Women Parts Starts From Here===//
        $getWomenDresses=Product::where('section_id',2)->where('is_publish','Yes')->where('status',1)->get()->toArray();
         
        

        return view('pages.index',compact(
           'getIp','getBanners','cateDetail','getFormalShirts','newArrivals','allCasuals','allPanjabies','getWomenDresses','newArrivalPanjabies'
        ));
    }

    public function contact(){
        return view('pages.contact');
    }
    
    public function allPages($url_two){
        //dd('ok');
        $currentURL = url()->full();
        $justU=URL::to('').'/';
        $currentUR = str_replace($justU, '', $currentURL); 
        $setting=Sitesetting::where('status',1)->first();
        //dd($currentUR);
        //======Seo parts==========//
        
        //$home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle($url_two);
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle($url_two);
        $url_two=$url_two;
        $page=PageBuilder::where('url',$url_two)->first();
        $pageCount=PageBuilder::where('url',$url_two)->count();
        if($pageCount>0){
             return view('pages.allpages',compact('url_two','page'));
        }else{
            
            abort(404);
            
            
        }
    }

    public function contactStore(Request $request){
          $preorder=new PreOrder();
          $message="Your Order Successfully Added!";
            if($request->isMethod('post')){
                $data=$request->all();
                $product_id= implode(',', $data['product_id']);
                $size= implode(',', $data['size']);
                
                $preorder->name=$data['name'];
                $preorder->email=$data['email'];
                $preorder->phone=$data['phone'];
                $preorder->address=$data['address'];
                $preorder->quantity=$data['quantity'];
                $preorder->range=$data['range'];
                $preorder->size=$size;
                $preorder->product_id=$product_id;
                $preorder->message=$data['message'];
                $preorder->save();
                if(!empty($data['email'])){
                    $email=$data['email'];
                    $messageData=
                    [
                      'name'  =>$data['name'],
                    ];
                    Mail::send('emails.preorder',$messageData,function($message) use ($email){
                         $message->to($email)->subject('Confirm Pre Order');
                    });
                }
                Session::flash('success',$message);
                return redirect()->back();
            }
      }


    public function service(){
        return view('pages.service');
    }
   
 

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
    public function mobile(){
        return view('pages.mobile');
    }
    public function track(){
        return view('pages.filetrack');
    }

    public function addNewsletter(Request $request){
         $request->validate([
               'email' => ['required', 'email', new EmailProvider],
           ]);
        if($request->isMethod('post')){
           
            $data=$request->all();
            
            $newsLetter=Subscriber::where('email',$data['email'])->count();
            if($newsLetter>0){
                $message = "Email already Exists!";
                Session::flash('error', $message);
                return redirect()->back();
            }else{
                $newLater=new Subscriber;
                $newLater->email=$data['email'];
                $newLater->status=1;
                $newLater->save();
                
                if($data['email']){
                    $initialDate =Carbon::now();
                    $daysToAdd = 365;
                    $newDate = $initialDate->addDays($daysToAdd);
                     $coupon=new Coupon;
                    $coupon->coupon_option="Automatic";
                    $rand=str_random(8);
                    $coupon->coupon_code=$rand;
                    $coupon->users=$data['email'];
                    $coupon->coupon_type="Single Times";
                    $coupon->amount_type="Percentage";
                    $coupon->amount="5.00";
                    $coupon->expiry_date=$newDate->toDateString();
                    $coupon->status=1;
                    $coupon->save();
                    $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                    $email =$data['email'];
                    $messageData=[
                        'email'=>$email,
                        'coupon_code'=>$rand,
                        'amount'=>5,
                        'amount_type'=>"Percentage",
                        'expiry_date'=>$newDate->toDateString(),
                        'sitesetting'=>$sitesetting,
                    ];
                    Mail::send('emails.coupon_email',$messageData,function($message) use ($email){
                    $message->to($email)->subject('Coupon Code generate.You Can Use It for Getting Discount!!'); });
                }
                
                $message = "Your Email Has Been Published as well as Coupon also Generated";
                Session::flash('success', $message);
                return redirect()->back();
            }
        }
    }
     
    public function searchAjax(Request $request){
        $serachingdata=$request->input('searchmenu');
            $products=Product::where('product_name','LIKE','%'.$serachingdata.'%')
             ->orWhere('product_name_bangla', 'LIKE','%'.$serachingdata.'%')
             ->orWhere('product_code', 'LIKE','%'.$serachingdata.'%')
            ->where('status',1)->take(5)->get();
            return view('pages.search-product',compact('products'));
     }
     
     
    public function singleEvent($name){
        $currentURL = url()->full();
        $justU=URL::to('').'/';
        //$currentUR = str_replace($justU, '', $currentURL); 
        $singleEvent=OccasionalEvent::where('name',$name)->pluck('id');
        $seotTitle=OccasionalEvent::where('name',$name)->first();
        $getCat=Category::where('status',1)->where('parent_id',0)->pluck('id');
        $getProducts=Product::where('status',1)->whereIn('occasional',$singleEvent)->select('product_mode')->groupBy('product_mode')->get()->toArray();
        
        $setting=Sitesetting::where('status',1)->first();
        //dd($getProducts);
        //======Seo parts==========//
        
        //$home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle($seotTitle->name);
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle($seotTitle->name);
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
        
        return view('pages.event',compact('getProducts','seotTitle','getIp'));
    } 
    
    public function allEvent(){
        $currentURL = url()->full();
        $justU=URL::to('').'/';
        //$currentUR = str_replace($justU, '', $currentURL); 
        $allEvents=OccasionalEvent::where('name','!=','All')->where('status',1)->get()->toArray();
        //$seotTitle=OccasionalEvent::where('name',$name)->first();
        $getCat=Category::where('status',1)->where('parent_id',0)->pluck('id');
        //$getProducts=Product::with(['occasion'])->where('status',1)->whereIn('occasional',$singleEvent)->select('occasional','product_mode')->groupBy('occasional','product_mode')->get()->toArray();
        $setting=Sitesetting::where('status',1)->first();
        //dd($getProducts);
        //======Seo parts==========//
        
        //$home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle("All-Events");
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("All-Events");
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
        
        return view('pages.allevents',compact('allEvents','getIp')); 
    }
    // Need to Work when filter is ready
    public function sectionWise($name){
        $currentURL = url()->full();
        $getSection=Section::where('name',$name)->first();
        $getProduct=Product::where('section_id',$getSection)->get();
        $home_link="http://$_SERVER[HTTP_HOST]";
        $setting=Sitesetting::where('status',1)->first();
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle($name);
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle($name);
        return view('pages.section');
    }
    
    // =========all store Items=====//
    
    public function storeProductItmes(){
        //dd('ok');die;
         Paginator::useBootstrap();
        $currentURL = url()->full();
         $setting=Sitesetting::where('status',1)->first();
        //$home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle("Store Product");
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("Store Product");
        $storeProducts=Product::where('status',1)->select('product_mode','id')->groupBy('product_mode','id')->paginate(40);
        //dd($getSection);
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
        
        
        $events=DB::table('occasional_events')->where('status',1)->take(2)->get();
        //$uniqueId->values()->all();
        //dd($prosuctId);
        
        $topCategories=Category::whereNotIn('category_name',['Pants & Joggers','men_kits','Bottoms'])->where('parent_id',0)->select('category_name','id')->groupBy('category_name','id')->take(4)->get();
        $bottomCategories=Category::whereIn('category_name',['Pants & Joggers','Bottoms'])->where('parent_id',0)->take(4)->get();
        // dd($bottomCategories);
       
        //==product filters===//
        $filterID=ProductFilterValue::with('filter')->where('status',1)->get();
        $filters=$filterID->unique('filter_id');
        //dd($filters);
        
        return view('pages.store',compact('storeProducts','getIp','events','topCategories','bottomCategories','filters'));
    }
    
    
    public function kitProduct(){
        //dd('ok');die;
        $currentURL = url()->full();
        $setting=Sitesetting::where('status',1)->first();
        //$home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle("Kits Product");
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("Store Product");
        $getSection=Section::where('status',1)->get()->toArray();
        //dd($getSection);
        
        return view('pages.kits',compact('getSection'));
    }
    
    

    
    
    public function brandProduct(){
        $currentURL = url()->full();
        $setting=Sitesetting::where('status',1)->first();
        //$home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle("Brand Product");
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("Brand Product");
        $getSection=Section::where('status',1)->get()->toArray();
        $getBarnd=Brand::where('status',1)->get()->toArray();
        
        return view('pages.brand',compact('getSection','getBarnd'));
    }
    
    public function verifyPinCode(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $pinCode=DB::table('pin_codes')->where(['zip_code'=>$data['zip_code'],'status'=>1])->count();
            if($pinCode == 0){
                echo "This Zip Code Is Not Available";
            }else{
              echo "This Zip Code Is Available";  
            }
        }
    }
    
    public function newProducts(){
        $currentURL = url()->full();
        $setting=Sitesetting::where('status',1)->first();
        //$home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
         
        SEOMeta::setTitle("Brand Product");
        SEOMeta::setCanonical($currentURL);
        
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("New Product");
        $getSection=Section::where('status',1)->get()->toArray();
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
       
        return view('pages.latest_product',compact('getSection','getIp'));
    }
    
    public function sectionListing($url){
        $sectionCount= Section::where(['url'=>$url])->count();
        if($sectionCount>0){
            $sectionDetails=Section::sectionDetails($url);
            $sectionProducts=Product::with('brand','category','section')->whereIn('section_id',$sectionDetails['sectionIds']);
            $sectionProducts=$sectionProducts->Paginate(30);
            $page_name="listing";
            $sectionMeta= Section::where(['url'=>$url])->first();
            $actual_link=url()->full();
            $home_link="http://$_SERVER[HTTP_HOST]";
            SEOMeta::setTitle($sectionMeta['name']);
            SEOMeta::setDescription($sectionMeta['name']);
            SEOMeta::setCanonical($actual_link);
            SEOMeta::addKeyword($sectionMeta['name']);
            OpenGraph::setDescription($sectionMeta['name']);
            OpenGraph::setTitle($sectionMeta['name']);
            OpenGraph::setUrl($actual_link);
            TwitterCard::setTitle($sectionMeta['name']);
            TwitterCard::setSite($actual_link);
            JsonLd::setTitle($sectionMeta['name']);
            JsonLd::setDescription($sectionMeta['name']);
            $meta_title= $sectionMeta['name'];
            return view('pages.section_listing',compact('sectionDetails','sectionProducts','url','page_name'));
        
            }else{
                 abort(404);
        }
    }
    
    // public function filterProductAjax(){
    //     //$products=Product::select('product_name')->where('status',1)->get();
    //     $products=Product::with('brand')->join('categories','categories.id','=','products.category_id')
    //         ->select('products.*','categories.*')
    //         ->where('products.status',1)->get();
    //     $data=[];
    //     foreach($products as $product){
    //         $data[]=$product['product_name'];
    //     }
    //     return $data;
    // }
    
    
     //====latest Auto-complete search=====//
    public function productSearchlatest(Request $request)
    {
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
         if($request->isMethod('post')){
            $data=$request->all();
            $search_product=$data['search'];
            $products=Product::with('brand')->join('categories','categories.id','=','products.category_id')
            ->join('colors','colors.id','=','products.family_color')
            ->where(function($query)use($search_product){
                $query->where('products.product_name','like','%'.$search_product.'%')
                ->orWhere('products.product_code','like','%'.$search_product.'%')
                ->orWhere('products.fabric','like','%'.$search_product.'%')
                ->orWhere('products.product_name_bangla','like','%'.$search_product.'%')
                ->orWhere('categories.category_name','like'.'%',$search_product.'%')
                ->orWhere('colors.name','like','%'.$search_product.'%');
            })->where('products.status',1)->get();
           // dd($products);
           //echo "<pre>";print_r($products);die;
            $output='';
            if(count($products)>0){
               $output='<ul class="list-group" style="display:block;position:relative;z-index:1;left:0"> ';
               foreach($products as $data){
                    $output.='<li class="list-group-item"><img style="width:40px !important" src="'.asset($data->image_one).'">'  .' '.$data->product_name.'  ('.$getIp->currency.' '.$data->selling_price.')'.'</li>';
               }
               $output.='</ul>';
            }else{
                $output .='<li class="">No Data Found</li>';
            }
            
            return $output;
                
         }
        
    }
    
    public function resultProduct(Request $request){
        $search_product=$request->search;
        
        //$productString = "Innerbloom Puffer (BDT 1000)";

        // Use regular expression to extract product name
        preg_match('/^(.*?)\s*\(/', $search_product, $matches);
        
        if (isset($matches[1])) {
            $productName = trim($matches[1]);
            //dd($productName);
        }else{
            return redirect('/')->with('error','Product is not available');
        }
        
        
        if($search_product != ""){
            $products=Product::where('product_name',$productName)
            ->where('status',1)->first();
 
            if($products){
                $name=preg_replace('/\s+/', '',$products->product_name);
                return redirect('product/details/'.$products->id.'/'.$name);
            }else{
                return redirect('/')->with('error','Product is not available');
            }
        }else{
           return redirect()->back(); 
        }
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
       $getIp=geoip()->getLocation($clientIP=null);
        return view('pages.modal_cart',compact('productDetails','total_stock','product_color','discounted_price','product_attr','getIp'));

       // return response()->json($product_color);
        // return response()->json(array(
        //         'product' => $product,
        //         'color' => $product_color,
        //         'size' => $size,
        //         'discount'=>$discounted_price,
        //  ));

    }


}

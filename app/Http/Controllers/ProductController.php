<?php

namespace App\Http\Controllers;
use URL;
use DB;
use Cart;
use App\SMS;
use App\User;
use App\Order;
use App\Coupon;
use App\WishlistTable;
use App\Product;
use App\Country;
use App\District;
use App\Shipping;
use App\CartModal;
use App\OrderDetail;
use App\LadystoreCart;
use App\ProductRating;
use App\Sitesetting;
use App\CurrencyConverter;
use App\MostPopular;
use App\ShippingAddress;
use App\AttributeProduct;
use App\Model\Admin\Brand;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\ProductFilter;
use App\ShippingCharge;
use Illuminate\Pagination\Paginator;
use App\ProductImage;
use App\Section;
use Carbon\Carbon;
use App\SalesTimer;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Session;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
use App\Helpers\SSLCommerz;
use App\Helpers\ResponseHelper;

class ProductController extends Controller
{
    public function ProductView($id,$product_name)
    {
        //listing page er ata error actie user part pabo====

        //https://www.youtube.com/watch?v=9koO93WLkug  for user count
    	//$product=DB::table('products')
    	//->join('categories','products.category_id','categories.id')

    	//->join('brands','products.brand_id','brands.id')
    	//->select('products.*','categories.category_name','brands.brand_name')->where('products.id',$id)->first()->toArray();
        //echo "<pre>";print_r($product);die;
    	// $color=$product->product_color;
    	// $product_color = explode(',', $color);
        $prodetail =Product::with('category','brand','attributes')->where('id',$id)->first();
        $color=$prodetail->product_color;
        $product_color = explode(',', $color);
    	// $product_color = explode(',', $color);
    	// $size=$product->product_size;
    	//$product_size = explode(',', $size);
        //'product_color','product_size'
        $total_stock=AttributeProduct::where('product_id',$id)->sum('stock');
        $productDetails =Product::with(['category','occasion','brand','section','attributes'=>function($query){
            $query->where('status',1);
        },])->find($id)->toArray();

        $sale=SalesTimer::where('status',1)->first();
        $shippingCharges=ShippingCharge::where('status',1)->first();
        $productImages=ProductImage::where('product_id',$productDetails['id'])->orderBy('image_sort')->get();
        //echo "<pre>";print_r
        //dd($shippingCharges);die;
       
          
        $clientIP = \Request::ip();
        $toDay=Carbon::now()->format('Y-m-d');
        $getIp=geoip()->getLocation($clientIP=null);
        
        // Most Poular
        if(empty(Session::get('session_id'))){
            
            $session_id=Session::getId();
        }else{
            $session_id=Session::get('session_id');
        }
        Session::put('session_id',$session_id);
        
        //Insert data
        $countRecentlyView=DB::table('most_populars')->where(['product_id'=>$id,'session_id'=>$session_id])->count();
        
        if($countRecentlyView==0){
            DB::table('most_populars')->insert(['product_id'=>$id,'session_id'=>$session_id]);
        }
         
          $realatedProducts=Product::with('brand','category','section')->where('category_id',$productDetails['category_id'])->where('section_id',$productDetails['section_id'])->where('status',1)->where('id','!=',$id)->limit(4)->inRandomOrder()->get()->toArray();
         
        //  ===Get Recently view item=id===//
        $recentlyId= DB::table('most_populars')->select('product_id')->where('product_id','!=',$id)->where('session_id',$session_id)->inRandomOrder()->get()->take(7)->pluck('product_id');
         
        //  ===Get Recently view item====//
        $recentlyProducts=Product::with('brand','category','section')->where('category_id',$productDetails['category_id'])->where('section_id',$productDetails['section_id'])->whereIn('id',$recentlyId)->where('status',1)->where('id','!=',$id)->limit(4)->get()->toArray();
        
        // ====Get Group Code====//
        $groupProducts=array();
        if(!empty($productDetails['group_code'])){
            $groupProducts=Product::select('id','image_two','product_name','product_color')->where(['group_code'=>$productDetails['group_code'],'status'=>1])->get()->toArray();
            //dd($groupProducts);
            
        }
        
        $actual_link=url()->full();
        $home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$actual_link.'/'.'public/media/product/image_two/'.$productDetails['image_two'];
        
        SEOMeta::setTitle($productDetails['product_name']);
        SEOMeta::setDescription($productDetails['meta_description']);
        SEOMeta::setCanonical($actual_link);
        SEOMeta::addKeyword($productDetails['meta_keyword']);

        OpenGraph::setDescription($productDetails['meta_description']);
        OpenGraph::setTitle($productDetails['product_name']);
        OpenGraph::setUrl($actual_link);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);

        TwitterCard::setTitle($productDetails['product_name']);
        TwitterCard::setSite($actual_link);

        JsonLd::setTitle($productDetails['product_name']);
        JsonLd::setDescription($productDetails['meta_description']);
        JsonLd::addImage($home_image);
        $reviewCount=ProductRating::get();
        $reviewSize=ProductRating::where('status',1)->where('product_id',$productDetails['id'])->take(5)->latest()->get();
        //dd($reviewSize);
        $attributeImages=ProductImage::with('product')->where('product_id',$productDetails['id'])->get()->toArray();
        //dd($attributeImages);
      return  view('pages.product_details',compact('groupProducts','recentlyProducts','shippingCharges','sale','productDetails','total_stock','realatedProducts','product_color','productImages','getIp','reviewCount','reviewSize','attributeImages'));
    }

    public function listing($url,Request $request){
        Paginator::useBootstrap();
        if($request->ajax()){
            $data =$request->all();
            //echo"<pre>"; print_r($data); die;
            $url=$data['url'];
            $categoryCount= Category::where(['url'=>$url,'status'=>1])->count();

            if($categoryCount>0){
            $categoryDetails=Category::cateDetails($url);
            $categoryPro=Product::with(['category','brand'=>function($query){
                $query->select('id','brand_name','bangla_name','url')->where('status',1);
            }])->whereIn('category_id',$categoryDetails['catIds'])->where('status',1);


            //if fabric is selected
             
            $productFilters=ProductFilter::productFilters();
            
            foreach($productFilters as $filter){
                if(isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])){
                    $categoryPro->whereIn($filter['filter_column'],$data[$filter['filter_column']]);
                }
            }
            
            // ====product size====//
            
            if(isset($data['size']) && !empty($data['size'])){
                $productIds=AttributeProduct::select('product_id')->whereIn('weight_size',$data['size'])->pluck('product_id')->toArray();
                $categoryPro->whereIn('products.id',$productIds);
            }
            
            //=====Family Color=====//
            
            if(isset($data['family_color']) && !empty($data['family_color'])){
                $categoryPro->whereIn('products.family_color',$data['family_color']);
            }
            
            //=======Checking Price ======//
            $productIds=array();
            if(isset($data['price']) && !empty($data['price'])){
                
                foreach($data['price'] as $key=>$price){
                    $priceArr=explode('-',$price);
                    if(isset($priceArr[0]) && isset($priceArr[1])){
                        $productIds[]=Product::select('id')->whereBetween('selling_price',[$priceArr[0],$priceArr[1]])->pluck('id')->toArray(); 
                    }
                   
                }
                //$productIds= call_user_func_array('array_merge',$productIds);
                $productIds= array_unique(array_flatten($productIds));
                // $implodePrices=implode('-',$data['price']);
                // $explodePrices=explode('-',$implodePrices);
                // $min=reset($explodePrices);
                // $max=end($explodePrices);
                // $productId=Product::select('id')->whereBetween('selling_price',[$min,$max])->pluck('id')->toArray();
                $categoryPro->whereIn('products.id',$productIds);
            }
           
            if(isset($data['brand_id']) && !empty($data['brand_id'])){
                $categoryPro->whereIn('products.brand_id',$data['brand_id']);
            }

            if(isset($data['category_id']) && !empty($data['category_id'])){
                $categoryPro->whereIn('products.category_id',$data['category_id']);
            }
            
            
            // sort page check

            if(isset($data['sort']) && !empty($data['sort'])){
                if($data['sort']=="product_latest"){
                    $categoryPro->orderBy('id','DESC');
                }else if($data['sort']=="product_name_a_z"){
                    $categoryPro->orderBy('product_name','Asc');
                }else if($data['sort']=="product_name_z_a"){
                    $categoryPro->orderBy('product_name','DESC');
                }else if($data['sort']=="prices_lowest"){
                    $categoryPro->orderBy('selling_price','Asc');
                }else if($data['sort']=="price_highest"){
                    $categoryPro->orderBy('selling_price','DESC');
                }
            }else{
                $categoryPro->orderBy('id','DESC');
            }
               $clientIP = \Request::ip();
                $toDay=Carbon::now()->format('Y-m-d');
                $getIp=geoip()->getLocation($clientIP=null);
            $categoryPro=$categoryPro->Paginate(30);
            return view('pages.ajax_product_listing',compact('categoryDetails','categoryPro','url','getIp'));
           // return view('pages.ajax_product_listing_two',compact('categoryDetails','categoryPro','url','getIp'));

        }else{
            abort(404);
        }
        }else{ 
            
            $categoryCount= Category::where(['url'=>$url,'status'=>1])->count();
            if($categoryCount>0){
                $categoryDetails=Category::cateDetails($url);
                $categoryPro = Product::with(['category', 'brand' => function ($query) {
                $query->select('id', 'brand_name', 'bangla_name', 'url')->where('status', 1);
                    }])->whereIn('category_id', $categoryDetails['catIds'])->where('status', 1);
              //product listing page
                // $brandFilters=Product::brandFilters();
                // $brand=$brandFilters['barnd_id'];
              //category listing
              
              $id=$categoryDetails['catIds'];
                
                // sort page check
                $categoryPro=$categoryPro->Paginate(30);
                $page_name="listing";
                $categoryCountMeta= Category::where(['url'=>$url,'status'=>1])->first();
                
                $actual_link=url()->full();
                $home_link="http://$_SERVER[HTTP_HOST]";
                $home_image=$actual_link.'/'.'public/media/category/banner/'.$categoryCountMeta['image'];
                
                SEOMeta::setTitle($categoryCountMeta['category_name']);
                SEOMeta::setDescription($categoryCountMeta['meta_keyword']);
                SEOMeta::setCanonical($actual_link);
                SEOMeta::addKeyword($categoryCountMeta['category_name']);
        
                OpenGraph::setDescription($categoryCountMeta['meta_keyword']);
                OpenGraph::setTitle($categoryCountMeta['category_name']);
                OpenGraph::setUrl($actual_link);
                OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        
                TwitterCard::setTitle($categoryCountMeta['category_name']);
                TwitterCard::setSite($actual_link);
        
                JsonLd::setTitle($categoryCountMeta['category_name']);
                JsonLd::setDescription($categoryCountMeta['meta_keyword']);
                JsonLd::addImage($home_image);
                $clientIP = \Request::ip();
                $toDay=Carbon::now()->format('Y-m-d');
                $getIp=geoip()->getLocation($clientIP=null);
                return view('pages.listing',compact('categoryDetails','categoryPro','url','page_name','getIp','id'));
            }else{
                abort(404);
            } 
        }
    }


    public function brandlisting($url,Request $request){
        Paginator::useBootstrap();
            $brandCount= Brand::where(['url'=>$url])->count();
            if($brandCount>0){
                $brandingDetails=Brand::brandDetails($url);
                $brandProducts=Product::with('brand','category')->whereIn('brand_id',$brandingDetails['catIds']);
                
               // =====sort page check==========//
               
                $brandProducts=$brandProducts->Paginate(30);
                $page_name="listing";
                $categoryCountMeta= Brand::where(['url'=>$url])->first();
            
                $actual_link=url()->full();
                $home_link="http://$_SERVER[HTTP_HOST]";
                
                SEOMeta::setTitle($categoryCountMeta['brand_name']);
                SEOMeta::setDescription($categoryCountMeta['brand_name']);
                SEOMeta::setCanonical($actual_link);
                SEOMeta::addKeyword($categoryCountMeta['brand_name']);
        
                OpenGraph::setDescription($categoryCountMeta['brand_name']);
                OpenGraph::setTitle($categoryCountMeta['brand_name']);
                OpenGraph::setUrl($actual_link);
                TwitterCard::setTitle($categoryCountMeta['brand_name']);
                TwitterCard::setSite($actual_link);
        
                JsonLd::setTitle($categoryCountMeta['brand_name']);
                JsonLd::setDescription($categoryCountMeta['brand_name']);
                $clientIP = \Request::ip();
                $toDay=Carbon::now()->format('Y-m-d');
                $getIp=geoip()->getLocation($clientIP=null);
                $meta_title= $categoryCountMeta['brand_name'];
                return view('pages.brand_listing',compact('brandingDetails','brandProducts','url','page_name','getIp','categoryCountMeta'));
    
            }else{
                abort(404);
            }

    }
    
    
    
    public function sectionListing($url,Request $request){
        Paginator::useBootstrap();
        if($request->ajax()){
            $data =$request->all();
            //echo"<pre>"; print_r($data); die;
            $url=$data['url'];
            $sectionCount= Section::where(['url'=>$url])->count();
                if($sectionCount>0){
                    $sectionDetails=Section::sectionDetails($url);
                    $sectionProducts=Product::with('brand','category','section')->whereIn('section_id',$sectionDetails['sectionIds']);
                    $productIds=array();
                    if(isset($data['price']) && !empty($data['price'])){
                        
                        foreach($data['price'] as $key=>$price){
                            $priceArr=explode('-',$price);
                            if(isset($priceArr[0]) && isset($priceArr[1])){
                                $productIds[]=Product::select('id')->whereBetween('selling_price',[$priceArr[0],$priceArr[1]])->pluck('id')->toArray(); 
                            }
                        }
                        
                        $productIds= array_unique(array_flatten($productIds));
                        $sectionProducts->whereIn('products.id',$productIds);
                    }
                    
                    
                    $productFilters=ProductFilter::productFilters();
            
                    foreach($productFilters as $filter){
                        if(isset($filter['filter_column']) && isset($data[$filter['filter_column']]) && !empty($filter['filter_column']) && !empty($data[$filter['filter_column']])){
                            $categoryPro->whereIn($filter['filter_column'],$data[$filter['filter_column']]);
                        }
                    }
                    
                    // ====product size====//
                    if(isset($data['size']) && !empty($data['size'])){
                        $productIds=AttributeProduct::select('product_id')->whereIn('weight_size',$data['size'])->pluck('product_id')->toArray();
                        $sectionProducts->whereIn('products.id',$productIds);
                    }
                    //=====Family Color=====//
                    if(isset($data['family_color']) && !empty($data['family_color'])){
                        $sectionProducts->whereIn('products.family_color',$data['family_color']);
                    }
                    
                     if(isset($data['brand_id']) && !empty($data['brand_id'])){
                        $sectionProducts->whereIn('products.brand_id',$data['brand_id']);
                    }
        
        
                    if(isset($data['sort']) && !empty($data['sort'])){
                        if($data['sort']=="product_latest"){
                            $sectionProducts->orderBy('id','DESC');
                        }else if($data['sort']=="product_name_a_z"){
                            $sectionProducts->orderBy('product_name','Asc');
                        }else if($data['sort']=="product_name_z_a"){
                            $sectionProducts->orderBy('product_name','DESC');
                        }else if($data['sort']=="prices_lowest"){
                            $sectionProducts->orderBy('selling_price','Asc');
                        }else if($data['sort']=="price_highest"){
                            $sectionProducts->orderBy('selling_price','DESC');
                        }
                        
                    }else{
                     $sectionProducts->orderBy('id','DESC');
                    }

                    $sectionProducts=$sectionProducts->Paginate(30);
                    $clientIP = \Request::ip();
                    $toDay=Carbon::now()->format('Y-m-d');
                    $getIp=geoip()->getLocation($clientIP=null);
                    return view('pages.ajax_section_listing',compact('sectionDetails','sectionProducts','url','getIp'));

                }else{
                    abort(404);
                }
            }else{
                $sectionCount= Section::where(['url'=>$url])->count();
                if($sectionCount>0){
                    
                    $sectionDetails=Section::sectionDetails($url);
                    $sectionProducts=Product::with('brand','category','section')->whereIn('section_id',$sectionDetails['sectionIds']);
                    
                   // =====sort page check==========//
                   
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
                    $clientIP = \Request::ip();
                    $toDay=Carbon::now()->format('Y-m-d');
                    $getIp=geoip()->getLocation($clientIP=null);
                    return view('pages.section_listing',compact('sectionDetails','sectionProducts','url','page_name','getIp'));
        
                }else{
                    abort(404);
                }

        }

    }
    
    public function changeProductImage(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $productCount=Product::where(['id'=>$data['product_id'],'product_color'=>$data['color']])->first()->toArray();
            
            if($productCount['status']==0){
                return response()->json(['status'=>'This Item Is Diabled']);
            }
            
            if(empty($productCount['image_two'])){
               return response()->json(['status'=>'No Image Avialable']); 
            }
            
            $getProduct=Product::where(['id'=>$data['product_id'],'product_color'=>$data['color']])->first()->toArray();
            $getProductImage=ProductImage::where('product_id',$getProduct['id'])->get();
            // foreach($getProductImage as $image){
            //     $getImage='<li class="active">'.'<img src="'.asset('public/media/product/multiple/large'.'/'.$image['product_image']).'"/>'.'</li>';
            // }
            
             return response()->json([
               'uploaded_image' => '<img src="'.asset('public/media/product/image_two/large/'.$getProduct['image_two']).'"/>',
               'product_image'=>$getProductImage,
            ]);  
        }
    }
    
    public function alternativeImage(Request $request){
        $data=$request->all();
        $getAttribute=AttributeProduct::where(['product_id'=>$data['product_id'],'color'=>$data['color']])->first()->toArray();
        return response()->json([
              'uploadedImage' => '<img src="'.asset('public/media/product/multiple/medium/'.$getAttribute['product_images']).'"/>',
              'color_name'=>$getAttribute['color'],
              'product_id'=>$getAttribute['product_id'],
        ]); 
    }
    
    public function AddCartProduct(Request $request)
    {
        $this->validate($request,[
              'weight_size'=>'required',
              'quantity'=>'required|numeric',
              'color'=>'required',
        ]);
        if($request->isMethod('post')){
            $data=$request->all();
            //dd($data);die;
            // if($data['quantity']==0 || $data['quantity']=""){
            //     $data['quantity']=1;
            // }

            //echo"<pre>"; print_r($data); die;
            $getProduct=Product::where(['id'=>$data['product_id']])->first()->toArray();
             if($getProduct['status'] ==0){
                $message="Required product is Disabled Please Choose Another one";
                Session::flash('error', $message);
                return Redirect()->back();
            }
            //product stock avaialable
            $getProductStock=AttributeProduct::where(['product_id'=>$data['product_id'],'weight_size'=>$data['weight_size']])->first()->toArray();
            if($getProductStock['status'] ==0){
                $message="Required Quantity is Disabled Please Choose Another one";
                Session::flash('error', $message);
                return Redirect()->back();
            }
            //echo $getProductStock['stock'];die;
            if($getProductStock['stock']<$data['quantity']){
                $message="Required Quantity is not avaialable";
                Session::flash('error', $message);
                return Redirect()->back();
            }
            // Generate session id not exit
            $session_id =Session::get('session_id');
            if(empty($session_id)){
                $session_id=Session::getId();
                Session::put('session_id',$session_id);
            }
            if(Auth::check()){
//user is logged in
             $countProducts = CartModal::where(['product_id'=>$data['product_id'],'weight_size'=>$data['weight_size'],'user_id'=>Auth::user()->id])->count();
            }else{
                 $countProducts = CartModal::where(['product_id'=>$data['product_id'],'weight_size'=>$data['weight_size'],'session_id'=>Session::get('session_id')])->count();

            }

            if($countProducts>0){
                 $message="Product Already Exit in cart!";
            Session::flash('error',$message);
             return Redirect()->back();
            }

            if(empty($request['color'])){
             $request['color']="";
              }

              if(Auth::check()){
                  $user_id=Auth::user()->id;
              }else{
                  $user_id=0;
              }
              $cart=new CartModal;
              $cart->session_id =$session_id;
              $cart->user_id =$user_id;
              $cart->product_id =$data['product_id'];
              $cart->weight_size =$data['weight_size'];
              $cart->quantity =$data['quantity'];
              $cart->color =$data['color'];
              $cart['created_at'] =new \DateTime();
               $cartadd=$cart->save();
              if($cartadd){
               $message="Product Has been Added in cart!";
               Session::flash('success',$message);
             return Redirect()->back();
              }else{
               $message="Product Has not been Added in cart!";
               Session::flash('error',$message);
             return Redirect()->back();
              }

        }
    }
    
    
    public function quickAddProduct(Request $request){
        
        $product_id=$request->input('product_id_cart');
        //dd($product_id);
        $weight_size=$request->input('weight_cart');
        //dd($weight_size);
        $qty_input=$request->input('qty_cart');
          
          
          if(empty($weight_size) ){
                return response()->json([
                   'status'=>'You Cant Avoid Size ',
                   'message'=>false
                ]);
          }else{
        
           $getProduct=Product::where(['id'=>$product_id])->first()->toArray();
           //dd($getProduct);
             if($getProduct['status'] ==0){
                return response()->json([
                    'status'=>'Required product is Disabled Please Choose Another one',
                    'message'=>false
                    ]);
            }
            //product stock avaialable
            $getProductStock=AttributeProduct::where(['product_id'=>$product_id,'weight_size'=>$weight_size])->first()->toArray();
            //dd($getProductStock);
            if($getProductStock['status'] ==0){
                
                return response()->json([
                    'status'=>'Required Quantity Disabled Please Choose Another one',
                    'message'=>false
                    
                    ]);
            }
            //echo $getProductStock['stock'];die;
            if($getProductStock['stock'] < $qty_input){
                return response()->json([
                    'status'=>'Required Quantity is not avaialable',
                    'message'=>false
                    
                    ]);
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
                return response()->json([
                    'status'=>'Product Already Exist in cart!',
                    'message'=>false
                    
                    ]);
            }
            
            $cart=new CartModal();
            $cart->session_id=$session_id;
            $cart->user_id=Auth::user()->id??'0';
            $cart->product_id=$product_id;
            $cart->weight_size=$weight_size;
            $cart->quantity=$qty_input;
            $cart->save();
            $userCartItems=CartModal::userCartItems();
             $totalCartItems=totalCartIteams();
            return response()->json([
                'status'=>'Product Added Successfully',
                'totalCartItems'=>$totalCartItems,
                'headerview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                ]);
            
          }
    }
    
    public function ajaxAddProductDetail(Request $request){
        $product_id=$request->input('product_id');
        //dd($product_id);
        $weight_size=$request->input('sizeid');
        //dd($weight_size);
        $color=$request->input('color');
        $qty_input=$request->input('qtyId');
          
        if(empty($weight_size) || empty($color)){
               return response()->json(['status'=>'You Cant Avoid Size Or Color']);
        }else{
        
           $getProduct=Product::where(['id'=>$product_id])->first()->toArray();
           //dd($getProduct);
             if($getProduct['status'] ==0){
                return response()->json(['status'=>'Required product is Disabled Please Choose Another one']);
            }
            //product stock avaialable
            $getProductStock=AttributeProduct::where(['product_id'=>$product_id,'weight_size'=>$weight_size])->first()->toArray();
            //dd($getProductStock);
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

            if(empty($color)){
               $color="";
            }
            
            $cart=new CartModal();
            $cart->session_id=$session_id;
            $cart->user_id=Auth::user()->id??'0';
            $cart->product_id=$product_id;
            $cart->weight_size=$weight_size;
            $cart->color=$color;
            $cart->quantity=$qty_input;
            $cart->save();
            return response()->json(['status'=>'Product Added Successfully']);
            
          }
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
    //  public function proView($url){
    //     //listing blade file merge korte hobe video 73
    //     $categoryCount= Subcategory::where(['url'=>$url,'status'=>1])->count();
    //     if($categoryCount>0){
    //         $categoryDetails=Subcategory::cateDetails($url);
    //         $categoryPro=Product::with('brand','category')->whereIn('subcategory_id',$categoryDetails['catIds'])->where('status',1)->get()->toArray();
    //         $categoryP=Product::with('brand','category')->paginate(20);
    //         return view('pages.listing',compact('categoryDetails','categoryPro','categoryP'));

    //     }
    // }

    //   public function productsView($id)
    // {
    //      $products=DB::table('products')->where('subcategory_id',$id)->get();
    //      $brands= DB::table('products')->where('subcategory_id',$id)->select('brand_id','category_id')->where('status',1)->get();
    //      return view('pages.listing',compact('products','brands'));
    // }

    public function getProductPrice(Request $request){
        if($request->ajax()){
            $data =$request->all();
           //echo"<pre>"; print_r($data); die;
            $getDiscountedAttrPrice=Product::getDiscountedAttrPrice($data['product_id'],$data['weight_size']);
          return $getDiscountedAttrPrice;
        }

    }
    public function getProductSize(Request $request){
        if($request->ajax()){
            $data =$request->all();
           //echo"<pre>"; print_r($data); die;
           $getDiscountedAttrPriceSize=Product::getDiscountedAttrPriceSize($data['product_id'],$data['weight_size']);
           return $getDiscountedAttrPriceSize;
        }

    }

    public function CartView(){
        $currentURL = url()->full();
        $setting=Sitesetting::where('status',1)->first();
        $home_link="http://$_SERVER[HTTP_HOST]";
        $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
        SEOMeta::setTitle("Cart-page");
        SEOMeta::setCanonical($currentURL);
        OpenGraph::setDescription($setting->description);
        OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
        JsonLd::setTitle("Cart-page");
        $userCartItems=CartModal::userCartItems();
        
        return view('pages.cart',compact('userCartItems'));
    }
    
    
    public function updateCartItemQtyTwo(Request $request){
        if($request->ajax()){
            $data= $request->all();
            //echo"<pre>"; print_r($data['qty']); die;
            //$cartDetails=CartModal::find($data['cartid']);
            //$availableStock=AttributeProduct::select('stock')->where(['product_id'])
            $cartDetails=CartModal::find($data['cartid']);
             //echo"<pre>"; print_r($cartDetails); die;
            $availableStock=AttributeProduct::select('stock')->where(['product_id'=>$cartDetails['product_id'],'weight_size'=>$cartDetails['weight_size']])->first()->toArray();
           // echo "Demanded Stock:".$data['qty'];
            //echo "<br>";
            //echo "Available Stock:". $availableStock['stock'];
            //stock is available or not
            if($data['qty'] > $availableStock['stock']){
                 $userCartItems=CartModal::userCartItems();
                return response()->json([
                'status'=>false,
                'message'=>'Product stock is not Avialable',
                'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems')),
                            ]);
            }
            CartModal::where('id',$data['cartid'])->update(['quantity'=>$data['qty']]);
            //dd($test);
            $userCartItems=CartModal::userCartItems();
            $totalCartItems=totalCartIteams();
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added Successfully',
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems')),
                'headerview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                ]);
            }
       }
       
        public function updateCartItemQty(Request $request){
        if($request->ajax()){
            $data= $request->all();
            //echo"<pre>"; print_r($data['qty']); die;
            //$cartDetails=CartModal::find($data['cartid']);
            //$availableStock=AttributeProduct::select('stock')->where(['product_id'])
            $cartDetails=CartModal::find($data['cartidtwo']);
             //echo"<pre>"; print_r($cartDetails); die;
            $availableStock=AttributeProduct::select('stock')->where(['product_id'=>$cartDetails['product_id'],'weight_size'=>$cartDetails['weight_size']])->first()->toArray();
           // echo "Demanded Stock:".$data['qty'];
            //echo "<br>";
            //echo "Available Stock:". $availableStock['stock'];
            //stock is available or not
            if($data['new_qty_two'] > $availableStock['stock']){
                 $userCartItems=CartModal::userCartItems();
                return response()->json([
                'status'=>false,
                'message'=>'Product stock is not Avialable',
                'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems')),
                            ]);
            }
            CartModal::where('id',$data['cartidtwo'])->update(['quantity'=>$data['new_qty_two']]);
            //dd($test);
            $userCartItems=CartModal::userCartItems();
            $totalCartItems=totalCartIteams();
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Updated Successfully!',
                'totalCartItems'=>$totalCartItems,
                'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems')),
                'headerview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                ]);
            }
       }
    
     public function loadCountProduct(){
        if(Auth::check()){
            $user_id=Auth::user()->id;
            $totalCartIteam=CartModal::where('user_id',$user_id)->sum('quantity');
            $userCartItems=CartModal::userCartItems();
            return response()->json([
                'count'=>$totalCartIteam,
                'headerview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems')),
                'deleteview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                ]);
        }else{
            $session_id=Session::get('session_id');
            $totalCartIteam=CartModal::where('session_id',$session_id)->sum('quantity');
            $userCartItems=CartModal::userCartItems();
            return response()->json([
                'count'=>$totalCartIteam,
                'headerview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems')),
                'deleteview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
            ]);
        }
    }
    
    
    public function wishCountProduct(){
         if(Auth::check()){
            $getWish=WishlistTable::where('user_id',Auth::user()->id)->count();
            return response()->json([
                'wishcount'=>$getWish,
            ]);
        }
    }



    //cart delete
    public function cartItemDelete(Request $request){
        if($request->ajax()){
           $data=$request->all();
           //echo"<pre>"; print_r($data); die;
           CartModal::where('id',$data['cartid'])->delete();
             $userCartItems=CartModal::userCartItems();
             $totalCartItems=totalCartIteams();
            return response()->json([
                'message'=>"Item Deleted Successfully",
                'totalCartItems'=>$totalCartItems,
                'deleteview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems')),
                'headerview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems'))
            ]);
        }
    }


    public function ApplyCoupon(Request $request){
        if($request->ajax()){
            $data= $request->all();
            //echo"<pre>"; print_r($data); die;
            $userCartItems=CartModal::userCartItems();
            $couponCount=Coupon::where('coupon_code',$data['code'])->count();
            //echo"<pre>"; print_r($couponCount); die;
            if($couponCount==0){
              $userCartItems=CartModal::userCartItems();
              $totalCartItems=totalCartIteams();
               Session::forget('couponAmount');
               Session::forget('couponCode');
                return response()->json([
                    'status'=>false,
                    'message'=>'This coupon is not Valid!',
                     'totalCartItems'=>$totalCartItems,
                    'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems'))]);
                 }else{
                //other condition
                //get coupon code
                $couponDetails= Coupon::where('coupon_code',$data['code'])->first();
                if($couponDetails->status==0){
                    $message='This coupon is not Active!';
                }
                //check if coupon is single times
                if($couponDetails->coupon_type=='Single Times'){
                  //check in orders table
                  $couponCount=Order::where(['coupon_code'=>$data['code'],'user_id'=>Auth::user()->id])->count();
                  if($couponCount>=1){
                    $message='This Coupon is Alraedy Used By You!';
                  }
                }
                //This coupon is for Multiple Times
                 if($couponDetails->coupon_type=='Multiple Times'){
                  //check in orders table
                  $couponCount=Order::where(['coupon_code'=>$data['code'],'user_id'=>Auth::user()->id])->count();
                  if($couponCount>=3){
                    $message='Your Coupon Code Limition is Over!';
                  }
                }
                //coupon Expired
                $expiry_date=$couponDetails->expiry_date;
                $current_date=date('Y-m-d');
                if($expiry_date<$current_date){
                     $message='This coupon is Expired!';
                }
                $userCartItems=CartModal::userCartItems();
                //check if coupon belongs to logged in user
                if(!empty($couponDetails->users)){
                   $usersArr=explode(',',$couponDetails->users);
                    foreach($usersArr as $key=>$user){
                    $getUserID = User::select('id')->where('email',$user)->first()->toArray();
                    $userID[]=$getUserID['id'];
                 }
                }

                //get cart total ammount
                $total_amount=0;

                foreach($userCartItems as $key =>$item){
                    if(!empty($couponDetails->users)){
                        if(!in_array($item['user_id'],$userID)){
                            $message = 'This coupon code is not for You!';
                        }
                    }
                    $attrPrice = Product::getDiscountedAttrPriceSize($item['product_id'],$item['weight_size']);
                    $total_amount = $total_amount + ($attrPrice['final_price'] * $item['quantity']);
                }

                if(isset($message)){
                    $userCartItems=CartModal::userCartItems();
                    $totalCartItems=totalCartIteams();
                    return response()->json([
                    'status'=>false,
                    'message'=>$message,
                     'totalCartItems'=>$totalCartItems,
                    'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems'))]);
                }else{

                    //check fixed or percentage price
                    if($couponDetails->amount_type=="Fixed"){
                        $couponAmount= $couponDetails->amount;

                    }else{
                        $couponAmount=$total_amount * ($couponDetails->amount/100);
                    }
                    $grand_total = $total_amount - $couponAmount;
                     //Add Coupon Code and amount
                     Session::put('couponAmount',$couponAmount);
                     Session::put('couponCode',$data['code']);
                     $message="Coupon code Successfully Applied!";
                     $userCartItems=CartModal::userCartItems();
                    $totalCartItems=totalCartIteams();
                    return response()->json([
                    'status'=>true,
                    'message'=>$message,
                    'totalCartItems'=>$totalCartItems,
                    'couponAmount'=>$couponAmount,
                    'grand_total'=>$grand_total,
                     'loadview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                    'headerview'=>(String)View::make('layouts.minicart')->with(compact('userCartItems')),
                    'view'=>(String)View::make('pages.cart_iteams')->with(compact('userCartItems'))]);

                }

            }
        }

    }
    public function Checkout(Request $request){
        $clientIP = \Request::ip();
        $getIp=geoip()->getLocation($clientIP=null);
        $userCartItems=CartModal::userCartItems();

        $total_price = 0;
        $total_selling = 0;
        foreach ($userCartItems as $item) {
    // Check if 'product' key exists before trying to access 'product_weight'
        if (isset($item['product']['product_weight'])) {
            $product_selling = $item['product']['product_weight'];
            $total_selling += $product_selling;
    
            // Check if 'product_id' and 'weight_size' keys exist before using them
            if (isset($item['product_id'], $item['weight_size'])) {
                $attrPrice = Product::getDiscountedAttrPriceSize($item['product_id'], $item['weight_size']);
                $total_price += $attrPrice['final_price'] * $item['quantity'];
            }
        }
    }

     
       $deliveryAddresses = Shipping::deliveryAddresses();

        if (count($deliveryAddresses) > 0) {
            foreach ($deliveryAddresses as $key => $row) {
                $shippingDetail = ShippingCharge::where('country', $row['country'])->first();
                if ($shippingDetail) {
                    $shippingCharges = ShippingCharge::getShippingCharges($total_selling, $row['country']);
                    $deliveryAddresses[$key]['shipping_charges'] = $shippingCharges;
        
                    // ==== Pin code Available === //
                    $deliveryAddresses[$key]['pincodeCount'] = DB::table('pin_codes')
                        ->where('status', 1)
                        ->where('zip_code', $row['zip_code'])
                        ->count();
                } else {
                    // Handle the case where $shippingDetail is null (not found)
                    // For example, you can set default values or skip this iteration.
                    $shippingDetail = ['shipping_charge' => 0]; 
                }
            }
        } else {
            $deliveryAddresses = [];
        }

        
        //dd($deliveryAddresses);die;
        if($request->isMethod('post')){
            $data=$request->all();
             
            //echo "<pre>"; print_r($data); die;
            //prevent out of stock issues
           
             $userCart = CartModal::where('user_id',Auth::user()->id)->get();
            foreach($userCart as $cart){
                 $getAttributeCount = Product::getAttributeCount($cart->product_id,$cart->weight_size);
                if($getAttributeCount==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error',$cart->product->product_name.'is not available. Try again!');
                    return redirect('product/cart-page');
                }

                $product_stock = Product::getProductStock($cart->product_id,$cart->weight_size);
                if($product_stock==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error',$cart->product->product_name.'Sold Out and removed from Cart. Try again!');
                    return redirect('product/cart-page');
                }

                if($cart->quantity>$product_stock){
                    Session::flash('error','Reduce'.$cart->product->product_name.'and try again.');
                    return redirect('product/cart-page');
                }

                $product_status=Product::getProductStatus($cart->product_id);
                if($product_status==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error', 'Disabled'.$cart->product->product_name.'and removed from Cart. Try again!');
                    return redirect('product/cart-page');
                }
                
                $getCategoryId = Product::select('category_id')->where('id',$cart->product_id)->first();
                $category_status = Product::getCategoryStatus($getCategoryId->category_id);
                if($category_status==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error', $cart->product->product_name.'category is disabled.Please try again!');
                    return redirect('product/cart-page');
                }
            }

            //print_r($data);die;
               if(empty($data['shipping_id'])){
                 $message="Please Select Shipping Address!";
                 Session::flash('error',$message);
                  return redirect('customer/user/checkout-pages');
             }

            if(empty($data['payment_gateway'])){
                 $message="Please Select Payment Address!";
                 Session::flash('error',$message);
                 return redirect('customer/user/checkout-pages');
             }

             if(count($userCartItems)==0){
                 $message="Please Select At least one Product!";
                 Session::flash('error',$message);
                  return redirect('product/cart-page');
             }
             
             if(empty($data['check'])){
                 $message="Please Select Agree Button!";
                 Session::flash('error',$message);
                 return redirect('customer/user/checkout-pages'); 
             }
             
            $order_data=Order::orderBy('id','desc')->first();

            if($order_data==NULL){
                
               $firstOrder='0';
               $order_no=$firstOrder+1;
               
            }else{
                
                $order_data=Order::orderBy('id','desc')->first()->order_no;
                $order_no=$order_data+1;
            }
             //Get Shipping Address
             $shippinAddress=Shipping::where('id',$data['shipping_id'])->first()->toArray();
             //dd($shippinAddress);die;
             //$order details
             //get shipping chrages
            $shipping_charges=ShippingCharge::getShippingCharges($total_selling,$shippinAddress['country']);
            $clientIP = \Request::ip();
            $getIp=geoip()->getLocation($clientIP=null);
             //calculate grand total
             
          
            if($getIp->country !='Bangladesh'){
                //====Currency Converter====//
                $currencies=CurrencyConverter::where('status',1)->where('currency_code','=',$getIp->currency)->first();
                $getSum=($total_price + $shipping_charges - Session::get('couponAmount')) * $currencies->exchange_rate; 
                $grand_total=$getSum;
                $charge=$shipping_charges * $currencies->exchange_rate; 
                $coupon_amount=Session::get('couponAmount')* $currencies->exchange_rate;
                
                //==== Check Minimum And Maximum Order=====//
                
                $orderPrice=Sitesetting::where('status',1)->first()->toArray();
                $convertAmount= $total_price * $currencies->exchange_rate;
                $minimum= $orderPrice['minimum_order'] * $currencies->exchange_rate;
                
                if($grand_total < $minimum){
                        Session::flash('error','Minimum Cart Amount Must Be' .$minimum);
                        return redirect('product/cart-page'); 
                    }
                    
                    $maxValue= $orderPrice['maximum_order']* $currencies->exchange_rate;
                    if($grand_total > $maxValue){
                        Session::flash('error','Maximum Cart Amount Must Be '.$maxValue);
                        return redirect('product/cart-page'); 
                    }
            }else{
                    
                    $charge=$shipping_charges;
                    $grand_total=$total_price + $shipping_charges - Session::get('couponAmount'); 
                    $coupon_amount=Session::get('couponAmount');
                    $orderPrice=Sitesetting::where('status',1)->first()->toArray();
                    
                    if($total_price < $orderPrice['minimum_order']){
                        Session::flash('error','Minimum Cart Amount Must Be'.$orderPrice['minimum_order']);
                        return redirect('product/cart-page'); 
                    }
                    
                    if($total_price > $orderPrice['maximum_order']){
                        Session::flash('error',' Cart Amount Is Cross The Limit '.$orderPrice['maximum_order']);
                        return redirect('product/cart-page'); 
                    }
                    
            }
                //Session::put('shipping_charges',$shipping_charges);
                Session::put('grand_total',$grand_total);
                
                if($data['payment_gateway']=="COD"){
                    $tran_id ='Hand Cash';
                    $status=0;
                }else{
                    $tran_id =  mt_rand(100000,999999);
                    $status=0;
                }
                
                DB::beginTransaction();
                 //order placement
                 $order = new Order;
    			 $order->blnc_transection=$tran_id;
                 $order->user_id = Auth::user()->id;
                 $order->shipping_cost=$charge;
                 $order->status=$status;
                 $order->coupon_code=Session::get('couponCode');
                 $order->coupon_amount=$coupon_amount;
                 $order->order_no=$order_no;
                 $order->payment_gateway=$data['payment_gateway'];
                 $order->total=Session::get('grand_total');
                 $order->subtotal=Session::get('subtotatal');
                 $order->date=date('d-m-Y');
                 $order->month=date('F');
                 $order->year=date('Y');
                 $order->status_code=mt_rand(100000,999999);
                 $order->save();
                 $order_id=DB::getPdo()->lastInsertId();
                 //shipping Address
    
                $shipping = new ShippingAddress;
    	    	$shipping->order_id=$order_id;
                $shipping->email = Auth::user()->email;
    	    	$shipping->name=$shippinAddress['name'];
    	    	$shipping->phone=$shippinAddress['phone'];
    	    	$shipping->address=$shippinAddress['address'];
    	    	$shipping->area=$shippinAddress['area'];
    	    	$shipping->country=$shippinAddress['country'];
    	    	$shipping->zip_code=$shippinAddress['zip_code'];
    	    	$shipping->user_id=Auth::user()->id;
                $shipping->save();
                $Profile=ShippingAddress::where('user_id',Auth::user()->id)->first();
                $payable=Session::get('grand_total');
                $user_email=$shippinAddress['phone']??"";

                //Oredr Details
                $cartProducts=CartModal::where('user_id',Auth::user()->id)->get()->toArray();
                foreach($cartProducts as $key=>$product){
                    $cartItem=new OrderDetail;
                    $cartItem->order_id=$order_id;
                    $cartItem->user_id=Auth::user()->id;
                    $getProductDetails=Product::select(['product_code','product_name','product_name_bangla','product_color','selling_price'])
                    ->where('id',$product['product_id'])->first()->toArray();
                    $cartItem->product_code=$getProductDetails['product_code'];
                    $cartItem->product_name=$getProductDetails['product_name'];
                    $getDiscountedAttrPriceSize=Product::getDiscountedAttrPriceSize($product['product_id'],$product['weight_size']);
                    if($getIp->country !='Bangladesh'){
                        $currencies=CurrencyConverter::where('status',1)->where('currency_code','=',$getIp->currency)->first();
                        $totalprice=$getDiscountedAttrPriceSize['final_price'] * $currencies->exchange_rate;
                        $singleprice=$getProductDetails['selling_price'] * $currencies->exchange_rate;
                        $total_price_amount=$getDiscountedAttrPriceSize['final_price'] * $product['quantity'] * $currencies->exchange_rate;
                    }else{
                        $totalprice=$getDiscountedAttrPriceSize['final_price']; 
                        $singleprice=$getProductDetails['selling_price'];
                        $total_price_amount=$getDiscountedAttrPriceSize['final_price']*$product['quantity'];
                    }
                    $cartItem->totalprice=$totalprice;
                    $cartItem->singleprice=$singleprice;
                    $cartItem->product_size=$product['weight_size'];
                    $cartItem->product_color=$product['color'];
                    $cartItem->total_price_amount=$total_price_amount;
                    $cartItem->product_quantity=$product['quantity'];
                    $cartItem->date=date('d-m-y');
                    $cartItem->Year=date('Y');
                    $cartItem->month=date('F');
                    $cartItem->product_id=$product['product_id'];
                    $cartItem->save();
                    //if($data['payment_gateway']=="COD"){
                    //product stock Manage
                    //$getProductStock=AttributeProduct::where(['product_id'=>$product['product_id'],'weight_size'=>$product['weight_size']])->first();
                    //$newStock= $getProductStock['stock'] - $product['quantity'];
                    //dd($newStock);die;
                    // if($newStock<0) {
                    // $newStock = 0;
                    //                  }
                    //AttributeProduct::where(['product_id'=>$product['product_id'],'weight_size'=>$product['weight_size']])->update(['stock'=>$newStock]);
                  //}
                }
                //Empty the user Cart

                Session::put('order_id',$order_id);
                DB::commit();
                if($data['payment_gateway']=="COD"){
                    
                    //send order COD SMS
                    $message="Dear Customer order".$order_id."has Been Successfully Placed";
                    $mobile=Auth::user()->phone;
                    SMS::sendSms($message,$mobile);
    
                    $productDetails = Order::with('products','shipping')->where('id',$order_id)->first();
                    $productDetails = json_decode(json_encode($productDetails),true);
                    $shippinAddress=Shipping::where('id',$data['shipping_id'])->first();
                    /*echo "<pre>"; print_r($productDetails);*/ /*die;*/
    
                    $userDetails = User::where('id',Auth::user()->id)->first();
                    $userDetails = json_decode(json_encode($userDetails),true);
                    $sitesetting=DB::table('sitesettings')->where('status',1)->first();
                    /*echo "<pre>"; print_r($userDetails); die;*/
                    /* Code for Order Email Start */
                    $email = Auth::user()->email;
                    $messageData = [
                        'email' => $email,
                        'name' => $shipping->name,
                        'order_id' => $order_id,
                        'productDetails' => $productDetails,
                        'userDetails' => $userDetails,
                        'shippinAddress'=>$shippinAddress,
                        'sitesetting'=>$sitesetting,
                    ];
                    
                    Mail::send('emails.order',$messageData,function($message) use($email){
                        $message->to($email)->subject('Thanks for your Order!');
                        
                        
                });
                
                    $emailAdmin = "leadmanbd@gmail.com";
                    $messageData = [
                        'phone' =>$shipping->phone,
                        'name' =>$shipping->name,
                        'address' => $shipping->address,
                        'order_id' => $order_id,
                    ];
                    
                    Mail::send('emails.orderNotifyToAdmin',$messageData,function($message) use($emailAdmin){
                        $message->to($emailAdmin)->subject('Order Alert!');
                    });
                
                
                
                    
                    return redirect('user/thanks-pages');
                    
                }else if($data['payment_gateway']=="ssl"){
                    $order_id = Session::get('order_id');
                    //$paymentMethod=SSLCommerz::InitiatePayment($Profile,$payable,$tran_id,$user_email,$order_id);
                    
                     $paymentResponse = SSLCommerz::InitiatePayment($Profile,$payable,$tran_id,$user_email,$order_id);
                    // return ResponseHelper::Out('success',array(['paymentResponse'=>$paymentResponse,'payable'=>$payable,'total'=>Session::get('grand_total')]),200);
        
                    // Check if payment initiation was successful
                    if (isset($paymentResponse['error'])) {
                        // Handle error case
                        // Log the error or return an error response
                        // Example: return response()->json(['error' => $paymentResponse['error']], 500);
                        // You may also redirect back with an error message
                        return redirect()->back()->with('error', 'Failed to initiate payment: ' . $paymentResponse['error']);
                    } else {
                        // Payment initiation successful
                        // Redirect the user to the SSLCommerz payment page
                        return redirect($paymentResponse['GatewayPageURL']);
                    }
    
                }else if($data['payment_gateway']=="paypal"){
                    
                    Session::put('order_id',$order_id);
                    return redirect('/paypal');
                }
                
                
            }
            
            $currentURL = url()->full();
            $setting=Sitesetting::where('status',1)->first();
            $home_link="http://$_SERVER[HTTP_HOST]";
            $home_image=$currentURL.'/'.'public/media/logo/seo/'.$setting->seo;
             
            SEOMeta::setTitle("Checkout");
            SEOMeta::setCanonical($currentURL);
            
            OpenGraph::setDescription($setting->description);
            OpenGraph::addImage(['url'=>$home_image,['og:image:height' => 300, 'og:image:width' => 300]]);
            JsonLd::setTitle("Checkout");
             $currencies=CurrencyConverter::where('status',1)->where('currency_code','!=','BDT')->get();
            //echo"<pre>"; print_r($deliveryAddresses); die;
            
            $gateways=DB::table('payment_gateways')->where('status',1)->get();
            return view('pages.checkout')->with(compact('userCartItems','deliveryAddresses','total_price','gateways','currencies','getIp'));
        }
  
    
        function redirect_to_merchant($url) {
    
            ?>
            <html xmlns="http://www.w3.org/1999/xhtml">
              <head><script type="text/javascript">
                function closethisasap() { document.forms["redirectpost"].submit(); } 
              </script></head>
              <body onLoad="closethisasap();">
              
                <form name="redirectpost" method="post" action="<?php echo 'https://sandbox.aamarpay.com/'.$url; ?>"></form>
                <!-- for live url https://secure.aamarpay.com -->
              </body>
            </html>
            <?php   
            exit;
        } 
        
    function PaymentSuccess(Request $request){
        return SSLCommerz::InitiateSuccess($request->query('tran_id'),$request->input('order_id'));
    }

    function PaymentCancel(Request $request){
        return SSLCommerz::InitiateCancel($request->query('tran_id'),$request->input('order_id'));
    }

    function PaymentFail(Request $request){
        return SSLCommerz::InitiateFail($request->query('tran_id'),$request->input('order_id'));
    }

    function PaymentIPN(Request $request){
        return SSLCommerz::InitiateIPN($request->input('tran_id'),$request->input('status'),$request->input('val_id'),$request->input('order_id'));
    }
    
    public function success(Request $request){
        $data=$request->all();
             
        echo "<pre>"; print_r($data); die;
            //prevent out of stock issues
           
             $userCart = CartModal::where('user_id',Auth::user()->id)->get();
            foreach($userCart as $cart){
                 $getAttributeCount = Product::getAttributeCount($cart->product_id,$cart->weight_size);
                if($getAttributeCount==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error',$cart->product->product_name.'is not available. Try again!');
                    return redirect('product/cart-page');
                }

                $product_stock = Product::getProductStock($cart->product_id,$cart->weight_size);
                if($product_stock==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error',$cart->product->product_name.'Sold Out and removed from Cart. Try again!');
                    return redirect('product/cart-page');
                }

                if($cart->quantity>$product_stock){
                    Session::flash('error','Reduce'.$cart->product->product_name.'and try again.');
                    return redirect('product/cart-page');
                }

                $product_status=Product::getProductStatus($cart->product_id);
                if($product_status==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error', 'Disabled'.$cart->product->product_name.'and removed from Cart. Try again!');
                    return redirect('product/cart-page');
                }
                
                $getCategoryId = Product::select('category_id')->where('id',$cart->product_id)->first();
                $category_status = Product::getCategoryStatus($getCategoryId->category_id);
                if($category_status==0){
                    Product::deleteCartProduct($cart->product_id,Auth::user()->id);
                    Session::flash('error', $cart->product->product_name.'category is disabled.Please try again!');
                    return redirect('product/cart-page');
                }
            }

        
            
             //orderno
               $order_data=Order::orderBy('id','desc')->first();

              if($order_data==NULL){
               $firstOrder='0';
               $order_no=$firstOrder+1;
             }else{
                 $order_data=Order::orderBy('id','desc')->first()->order_no;
                 $order_no=$order_data+1;
             }
             //Get Shipping Address
             $shippinAddress=Shipping::where('id',$data['opt_c'])->first()->toArray();
             //dd($shippinAddress);die;
             //$order details
             //get shipping chrages
             $shipping_charges=ShippingCharge::getShippingCharges($data['opt_d'],$shippinAddress['country']);
            $clientIP = \Request::ip();
            $getIp=geoip()->getLocation($clientIP=null);
             //calculate grand total
             
            $total_price=$data['opt_b'];
            if($getIp->country=='Bangladesh'){
                $currencies=CurrencyConverter::where('status',1)->where('currency_code','=','BDT')->first();
                $getSum=($total_price + $shipping_charges - Session::get('couponAmount')) * $currencies->exchange_rate; 
                $grand_total=$getSum;
                $charge=$shipping_charges * $currencies->exchange_rate; 
                $coupon_amount=Session::get('couponAmount')* $currencies->exchange_rate;
                $orderPrice=Sitesetting::where('status',1)->first()->toArray();
                $convertAmount= $total_price * $currencies->exchange_rate;
                $minimum= $orderPrice['minimum_order'] * $currencies->exchange_rate;
                if($grand_total < $minimum){
                        Session::flash('error','Minimum Cart Amount Must Be' .$minimum);
                        return redirect('product/cart-page'); 
                     }
                     
                     $maxValue= $orderPrice['maximum_order']* $currencies->exchange_rate;
                     
                     if($grand_total > $maxValue){
                         
                        Session::flash('error','Maximum Cart Amount Must Be '.$maxValue);
                        return redirect('product/cart-page'); 
                    }
                }else{
                    $grand_total=$total_price + $shipping_charges - Session::get('couponAmount'); 
                    $coupon_amount=Session::get('couponAmount');
                    $charge=$shipping_charges;
                    $orderPrice=Sitesetting::where('status',1)->first()->toArray();
                    if($total_price < $orderPrice['minimum_order']){
                        Session::flash('error','Minimum Cart Amount Must Be'.$orderPrice['minimum_order']);
                        return redirect('product/cart-page'); 
                    }
                    if($total_price > $orderPrice['maximum_order']){
                        Session::flash('error',' Cart Amount Is Cross The Limit '.$orderPrice['maximum_order']);
                        return redirect('product/cart-page'); 
                    }
                }
                Session::put('grand_total',$grand_total);
                
                DB::beginTransaction();
                 $order = new Order;
        		 $order->blnc_transection=mt_rand(100000,999999);
                 $order->user_id = Auth::user()->id;
                 $order->shipping_cost=$charge;
                 $order->status=1;
                 $order->coupon_code=Session::get('couponCode');
                 $order->coupon_amount=$coupon_amount;
                 $order->order_no=$order_no;
                 $order->payment_gateway=$data['opt_a'];
                 $order->payment_type='prepaid';
                 $order->total=Session::get('grand_total');
                 $order->subtotal=Session::get('subtotatal');
                 $order->date=date('d-m-Y');
                 $order->month=date('F');
                 $order->year=date('Y');
                 $order->status_code=mt_rand(100000,999999);
                 $order->save();
                 $order_id=DB::getPdo()->lastInsertId();
                 //shipping Address
        
                $shipping = new ShippingAddress;
            	$shipping->order_id=$order_id;
                $shipping->email = Auth::user()->email;
            	$shipping->name=$data['cus_name'];
            	$shipping->phone=$data['cus_phone'];
            	$shipping->address=$shippinAddress['address'];
            	$shipping->area=$shippinAddress['area'];
            	$shipping->country=$shippinAddress['country'];
            	$shipping->zip_code=$shippinAddress['zip_code'];
                $shipping->save();

        //Oredr Details
        $cartProducts=CartModal::where('user_id',Auth::user()->id)->get()->toArray();
        foreach($cartProducts as $key=>$product){
            $cartItem=new OrderDetail;
            $cartItem->order_id=$order_id;
            $cartItem->user_id=Auth::user()->id;
            $getProductDetails=Product::select(['product_code','product_name','product_name_bangla','product_color','selling_price'])
            ->where('id',$product['product_id'])->first()->toArray();
            $cartItem->product_code=$getProductDetails['product_code'];
            $cartItem->product_name=$getProductDetails['product_name'];
            $getDiscountedAttrPriceSize=Product::getDiscountedAttrPriceSize($product['product_id'],$product['weight_size']);
            if($getIp->country=='Bangladesh'){
                $currencies=CurrencyConverter::where('status',1)->where('currency_code','=','BDT')->first();
                $totalprice=$getDiscountedAttrPriceSize['final_price'] * $currencies->exchange_rate;
                $singleprice=$getProductDetails['selling_price'] * $currencies->exchange_rate;
                $total_price_amount=$getDiscountedAttrPriceSize['final_price'] * $product['quantity'] * $currencies->exchange_rate;
            }else{
                $totalprice=$getDiscountedAttrPriceSize['final_price']; 
                $singleprice=$getProductDetails['selling_price'];
                $total_price_amount=$getDiscountedAttrPriceSize['final_price']*$product['quantity'];
            }
            $cartItem->totalprice=$totalprice;
            $cartItem->singleprice=$singleprice;
            $cartItem->product_size=$product['weight_size'];
            $cartItem->product_color=$product['color'];
            $cartItem->total_price_amount=$total_price_amount;
            $cartItem->product_quantity=$product['quantity'];
            $cartItem->date=date('d-m-y');
            $cartItem->Year=date('Y');
            $cartItem->month=date('F');
            $cartItem->product_id=$product['product_id'];
            $cartItem->save();
            //if($data['payment_gateway']=="COD"){
            //product stock Manage
            //$getProductStock=AttributeProduct::where(['product_id'=>$product['product_id'],'weight_size'=>$product['weight_size']])->first();
            //$newStock= $getProductStock['stock'] - $product['quantity'];
            //dd($newStock);die;
            // if($newStock<0) {
            // $newStock = 0;
            //                  }
            //AttributeProduct::where(['product_id'=>$product['product_id'],'weight_size'=>$product['weight_size']])->update(['stock'=>$newStock]);
          //}
        }
        //Empty the user Cart

           Session::put('order_id',$order_id);
       
             DB::commit();
            //send order COD SMS
            $message="Dear Customer order".$order_id."has Been Successfully Placed";
            $mobile=Auth::user()->phone;
            SMS::sendSms($message,$mobile);

            $productDetails = Order::with('products','shipping')->where('id',$order_id)->first();
            $productDetails = json_decode(json_encode($productDetails),true);
            $shippinAddress=Shipping::where('id',$data['opt_c'])->first();
            /*echo "<pre>"; print_r($productDetails);*/ /*die;*/

            $userDetails = User::where('id',Auth::user()->id)->first();
            $userDetails = json_decode(json_encode($userDetails),true);
            $sitesetting=DB::table('sitesettings')->where('status',1)->first();
            /*echo "<pre>"; print_r($userDetails); die;*/
            /* Code for Order Email Start */
            $email = Auth::user()->email;
            $messageData = [
            'email' => $email,
            'name' => $shipping->name,
            'order_id' => $order_id,
            'productDetails' => $productDetails,
            'userDetails' => $userDetails,
            'shippinAddress'=>$shippinAddress,
            'sitesetting'=>$sitesetting,
            ];
            
            Mail::send('emails.order',$messageData,function($message) use($email){
                $message->to($email)->subject('Thanks for your Order!');
            });
            return redirect('user/thanks-pages');
      
    }
    
    public function fail(Request $request){
        return $request;
    }
    
    public function thankPages(){
        if(Session::has('order_id')){
             Session::forget('couponAmount');
             Session::forget('couponCode');
             CartModal::where('user_id',Auth::user()->id)->delete();
             SEOMeta::setTitle("thanks_page");
             return view('pages.thanks_page');
        }else{
            Session::forget('charge');
            SEOMeta::setTitle("Cart Page");
            return redirect('/');
        }
    }



    public function addEditShipping(Request $request,$id=null){
        if($id==""){
            $title = "Add Shipping Address";
            $shipping=new Shipping;
            $message="Shipping Address Applied Successfully!";
        }else{
            $shipping=Shipping::find($id);
            $title = "Update Shipping Address";
            $message="Shipping Address Updated Successfully!";

        }
        if($request->isMethod('post')){
        $data=$request->all();
        if(isset(Auth::user()->id)){
            $shipping->user_id=Auth::user()->id;
            $shipping->name=Auth::user()->name;
            $shipping->phone=Auth::user()->email;
            $shipping->area=$data['area'];
            $shipping->address=$data['address'];
            $shipping->country=$data['country'];
            $shipping->zip_code=$data['zip_code'];
            $shipping->save();
        }else{
            $ipaddres=$request->ip();
            $user=new User();
            $user->name=$data['name'];
            $user->phone=$data['phone'];
            $user->email=$data['email'];
            $user->password=bcrypt(12345678);
            $user->ip=$ipaddres;
            $user->status=1;
            $user->save();
            $user_id=DB::getPdo()->lastInsertId();
            $shipping->user_id=$user_id;
            $shipping->name=$data['name'];
            $shipping->phone=$data['phone'];
            $shipping->area=$data['area'];
            $shipping->address=$data['address'];
            $shipping->country=$data['country'];
            $shipping->zip_code=$data['zip_code'];
            $shipping->save();
        }
        
        Session::flash('success',$message);
        return redirect('customer/user/checkout-pages');

        }
       
        $districts=Country::where('status',1)->get()->toArray();
        SEOMeta::setTitle("Billing Address");
        return view('pages.checkout_user',compact('title','districts','shipping'));
    }
    public function deleteShipping($id){
        Shipping::where('id',$id)->delete();
        $message="Shipping Address Deleted Successfully!";
        Session::flash('success',$message);
        return redirect('customer/user/checkout-pages');
    }
    
    public function currencyView(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $sum=$data['total_price'];
            $getAmount=CurrencyConverter::where('currency_code',$data['currency_code'])->first();
            $currencyName=round($getAmount->exchange_rate * $sum,2);
            return response()->json([
                'currencyName'=>$currencyName,
            ]);
        }
    }
    
    
    
    public function rating(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $rating=$data['rating'];
            $reviewSize=ProductRating::where('rating',$rating)->take(2)->where('status',1)->get();
            $reviewCount=ProductRating::where('rating',$rating)->take(2)->where('status',1)->get();
            
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'reviewSize'=>$reviewSize,
                'reviewCount'=>$reviewCount,
                'ratingView'=>(String)View::make('pages.include.rating')->with(compact('reviewSize','reviewCount')),
            ]);
        }
    }
    
    public function newProductFilter(Request $request){
        Paginator::useBootstrap();
        if($request->isMethod('post')){
            $clientIP = \Request::ip();
            $getIp=geoip()->getLocation($clientIP=null);
            $data=$request->all();
            $value=$data['value'];
            if($value=='Yes'){
                $storeProducts=Product::where('is_feature',$value)->select('product_mode','id')->groupBy('product_mode','id')->where('status',1)->get()->toArray();
            }elseif($value=='4'){
                $getUniqueOrderId=Order::where('status',$value)->pluck('id');
                $orderDetails=OrderDetail::whereIn('order_id',$getUniqueOrderId)->pluck('product_id');
                $storeProducts=Product::whereIn('id',$orderDetails)->where('status',1)->where('product_quantity','>',0)->get()->toArray();
            }else{
                $storeProducts=Product::where('occasional',$value)->where('status',1)->where('product_quantity','>',0)->get()->toArray();
            }
            
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'storeProducts'=>$storeProducts,
                'newProductView'=>(String)View::make('pages.include.storeproduct')->with(compact('storeProducts','getIp')),
            ]);
        }
    }
    
    public function topProductFilter(Request $request){
        Paginator::useBootstrap();
        if($request->isMethod('post')){
            $clientIP = \Request::ip();
            $getIp=geoip()->getLocation($clientIP=null);
            $data=$request->all();
            $top_bottom=$data['top_bottom'];
            $storeProducts=Product::where('category_id',$top_bottom)->where('status',1)->where('product_quantity','>',0)->get()->toArray();
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'storeProducts'=>$storeProducts,
                'topProductView'=>(String)View::make('pages.include.storeproduct')->with(compact('storeProducts','getIp')),
            ]);
        }
    }
    
    public function ProductFilterName(Request $request){
        Paginator::useBootstrap();
        if($request->isMethod('post')){
            $clientIP = \Request::ip();
            $getIp=geoip()->getLocation($clientIP=null);
            $data=$request->all();
            $filter_name=$data['filter_name'];
            $storeProducts=Product::where('fabric',$filter_name)
            ->orWhere('fit',$filter_name)
            ->orWhere('sleeve',$filter_name)
            ->where('status',1)->where('product_quantity','>',0)->get()->toArray();
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'storeProducts'=>$storeProducts,
                'filterProductView'=>(String)View::make('pages.include.storeproduct')->with(compact('storeProducts','getIp')),
            ]);
        }
    } 
    
    public function bodyType(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $body=$data['body'];
            $reviewSize=ProductRating::where('body',$body)->take(4)->where('status',1)->get();
            $reviewCount=ProductRating::where('body',$body)->take(4)->where('status',1)->get();
            
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'reviewSize'=>$reviewSize,
                'reviewCount'=>$reviewCount,
                'bodyView'=>(String)View::make('pages.include.rating')->with(compact('reviewSize','reviewCount')),
            ]);
        }
    } 
    
    public function sizeRating(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $sizeRating=$data['size'];
            $reviewSize=ProductRating::where('product_size',$sizeRating)->take(4)->where('status',1)->get();
            $reviewCount=ProductRating::where('product_size',$sizeRating)->take(4)->where('status',1)->get();
            
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'reviewSize'=>$reviewSize,
                'reviewCount'=>$reviewCount,
                'sizeView'=>(String)View::make('pages.include.rating')->with(compact('reviewSize','reviewCount')),
            ]);
        }
    } 
    
    public function heightRating(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $height=$data['height'];
            $reviewSize=ProductRating::where('height',$height)->take(4)->where('status',1)->get();
            $reviewCount=ProductRating::where('height',$height)->take(4)->where('status',1)->get();
            
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'reviewSize'=>$reviewSize,
                'reviewCount'=>$reviewCount,
                'heightView'=>(String)View::make('pages.include.rating')->with(compact('reviewSize','reviewCount')),
            ]);
        }
    }
    
    public function fitRating(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $fit=$data['fit'];
            $reviewSize=ProductRating::where('fit',$fit)->take(4)->where('status',1)->get();
            $reviewCount=ProductRating::where('fit',$fit)->take(4)->where('status',1)->get();
            
            return response()->json([
                'status'=>true,
                'message'=>'Qunatity Added',
                'reviewSize'=>$reviewSize,
                'reviewCount'=>$reviewCount,
                'fitView'=>(String)View::make('pages.include.rating')->with(compact('reviewSize','reviewCount')),
            ]);
        }
    }
    
    public function colorImage(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            $color=$data['color'];
            $product_id=$data['product_id'];
            $attributeImagesCount=AttributeProduct::with('product')->where('color',$color)->where('product_id',$product_id)->where('status',1)->get()->first();
            if(!isset($attributeImagesCount->product_images)){
              return response()->json([
                  'status'=>'false',
                  'message'=>'No Image For This Color',
                ]);  
            }
            $attributeImages=AttributeProduct::with('product')->where('color',$color)->where('product_id',$product_id)->where('status',1)->get()->toArray();
            return response()->json([
                'status'=>true,
                'attributeImages'=>$attributeImages,
                'colorImage'=>(String)View::make('pages.include.image')->with(compact('attributeImages')),
            ]);
        }
    }
    
    public function sizeWeight(Request $request){
       if($request->isMethod('post')) {
            $data=$request->all();
            $size=$data['size'];
            //dd($size);
            $product_id=$data['product_id'];
            //dd($product_id);
            $sizes=AttributeProduct::with('product')->where('weight_size',$size)->where('product_id',$product_id)->where('status',1)->first();
            //dd($sizes);
            return response()->json([
                'size_weight'=>$sizes->weight_size,
            ]);
       }
    }
    
    public function ReviewProductSize(Request $request){
        $reviewCount=ProductRating::where('product_id',$request->product_id)->where('user_id',$request->user_id)->count();
        if($reviewCount>0){
            Session::flash('success','You had submitted Already');
            return redirect()->back();
        }
        if(Auth::check()){
            if($request->isMethod('post')){
                $review= new ProductRating();
                $data=$request->all();
                $review->product_id=$data['product_id'];
                $review->user_id=Auth::user()->id;
                $review->review=$data['review'];
                $review->rating=$data['rating'];
                
                $review->size_review=$data['size_review'];
                $review->size_rating=$data['size_rating'];
                
                $review->color_review=$data['color_review'];
                $review->color_rating=$data['color_rating'];
                
                $review->body=$data['body'];
                $review->height=$data['height'];
                $review->fit=$data['fit'];
                
                $getSize=AttributeProduct::where('product_id',$data['product_id'])->first();
                $review->product_size=$getSize->weight_size;
                $review->created_at=date('d-m-Y');
                $review->save();
                 $message='Your Review has been published.Thanks for The Review';
                Session::flash('success',$message);
                return redirect()->back();
            }
        }
        
    }
    
    public function customerAddtoCart(Request $request){
        $product_id=$request->input('product_id');
        $weight_size=$request->input('weight_size');
        $color=$request->input('color');
        $qty_input=$request->input('qty_input');
        if(empty($weight_size) || empty($color)){
            return response()->json(['error'=>'You Can not Avoid Size Or Color']);
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
    
                if(empty($color)){
                   $color="";
                }
                
                $cart=new CartModal();
                $cart->session_id=$session_id;
                $cart->user_id=Auth::user()->id??'0';
                $cart->product_id=$product_id;
                $cart->weight_size=$weight_size;
                $cart->color=$color;
                $cart->quantity=$qty_input;
                $cart->save();
                return response()->json(['status'=>'Product Added Successfully']);
                
            }else{
                return response()->json(['status'=>'Login To Continue']);
            }
       }
    }
}

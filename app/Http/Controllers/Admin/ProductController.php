<?php

namespace App\Http\Controllers\Admin;

use DB;
use Image;
use App\OccasionalEvent;
use App\Product;
use App\Section;
use App\Color;
use App\AttributeProduct;
use App\ProductFaq;
use App\AboutProduct;
use Illuminate\Http\Request;
use App\Model\Admin\Category;
use App\Http\Controllers\Controller;
use App\ProductImage;
use App\SalesTimer;
use App\ProductFilter;
use App\PreOrder;
use Auth;
use File;
use Session;
use Carbon\Carbon;
use App\Model\Admin\Brand;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(Request $request)
    {
        $category_id=$request->category_id;
        $brand_id=$request->category_id;
        $product_name=$request->product_name;
        $categories = Section::with('categories')->where('status',1)->get();
        $categories = json_decode(json_encode($categories),true);
        $brands=Brand::where('status',1)->get();
        $title="Product Lists";
        Session::put('page','product');
        
        if($category_id){
            $product=Product::with(['category'=>function($query){
                    $query->select('id','category_name');
                },'section'=>function($query){
                    $query->select('id','name');
                },'brand','attributes'])
                ->where('category_id',$category_id)
                ->get();
                
            return view('admin.product.index',compact('product','categories','title','brands'));
        }
        
    	$product=Product::with(['category'=>function($query){
            $query->select('id','category_name');
        },'section'=>function($query){
            $query->select('id','name');
        },'brand','attributes'])->orderBy('id', 'DESC')->get();

        return view('admin.product.index',compact('product','categories','title','brands'));  

    }

    public function store(Request $request,$id=null)
    {
        if($id==''){
          $title="product Create Page";  
          $message="Product Created Successfully";
           $aboutPart=array();
          $product=new Product();
        }else{
            
          $title="product Create Page";
          $message="Product Updated Successfully";
          $product=Product::find($id);
          $aboutPart=explode(',',$product['about_product_id']);
          
        }
        
        if($request->isMethod('post')){
            $data=$request->all();
            //dd($data);die;
            
            // =======validation====//
        $this->validate($request,[
            'product_name'=>'required',
            'product_code'=>'required',
            'selling_price'=>'required',
            'product_details'=>'required',
            'category_id'=>'required',
            'family_color'=>'required',
            'product_weight'=>'required',
            'product_mode'=>'required',
            'about_product_id'=>'required',
        ]);
           
            
            if(empty($request['is_feature'])){
                $is_feature="no";
               
                }else{
                    
                $is_feature="yes";
            }
            if($id==''){
                 $countCode=Product::where('product_code',$data['product_code'])->count();
                
            if($countCode>0){
                Session::flash('error','This Product Code Already Exists');
                return redirect()->back();
            } 
            }
          
          
            if(isset($data['about_product_id'])){
                $about_product_id= implode(',', $data['about_product_id']);
            }else{
                $about_product_id="";
            }
            
            
            $product->product_name= $data['product_name'];
    	    $product->product_code=$data['product_code'];
    	    $product->selling_price=$data['selling_price'];
    	    $product->category_id=$data['category_id'];
    	    $product->product_details=$data['product_details'];
    	    $product->wash_care=$data['wash_care'];
    	    $product->product_name_bangla=$data['product_name_bangla'];
    	    $product->family_color=$data['family_color'];
    	    $product->product_color=$data['product_color']??"";
    	    $product->group_code=$data['group_code'];
    	    $product->is_feature=$is_feature;
    	    $product->arrival_date=$data['arrival_date'];
    	    $product->is_publish='Yes';
    	    $product->discount_price=$data['discount_price'];
    	    if($data['discount_price']){
    	        $product->discount_date=$data['discount_date'];
    	    }
    	    $product->product_weight=$data['product_weight'];
    	    $product->meta_keyword=$data['meta_keyword'];
    	    $product->meta_description=$data['meta_description'];
    	    $product->youtube_link=$data['youtube_link'];
    	    $product->occasional=$data['occasional'];
    	    $product->about_product_id=$about_product_id;
    	    $product->product_mode=$data['product_mode'];
    	    $category_id=Category::find($data['category_id']);
    	    $product->section_id=$category_id['section_id'];
    	    
    	     $productFilters=ProductFilter::productFilters();
    	     foreach($productFilters as $filter){
    	          $filterAvailable=ProductFilter::filterAvailable($filter['id'],$data['category_id']);
    	        //echo $data[$filter['filter_column']]
        	      if($filterAvailable=='Yes'){
        	        if(isset($filter['filter_column']) && $data[$filter['filter_column']]){
        	            $product->{$filter['filter_column']} = $data[$filter['filter_column']];
        	        }  
        	      }
    	      }
    	    
    	    if($request->hasFile('video_link')){
    	        if(!empty($product->video_link)){
    	            $location='public/video/product/'.$product['video_link'];
    	            if(File::exists($location)){
    	                File::delete($location);
    	            }
    	        }
    	        
                $video_tmp = $request->file('video_link');
                if($video_tmp->isValid()){
                    $extension = $video_tmp->getClientOriginalExtension();
                    $videoName = rand().'.'.$extension;
                    $video_path ='public/video/product/';
                    $video_tmp->move($video_path,$videoName);
                    // save video
                    $product['video_link']=$videoName;
                }
            }
            
            if($data['category_id']==4) {
                if ($request->hasFile('image_one')) {
                    if(!empty($product->image_one)){
        	            $location=$product['image_one'];
        	            if(File::exists($location)){
        	                File::delete($location);
        	            }
        	        }
                    $image_tmp = $request->file('image_one');
                    if ($image_tmp->isValid()) {
                        // Upload Images after Resize
                        $extension =  $image_tmp->getClientOriginalExtension();
                        $imageName =  rand(111, 99999) . '.' . $extension;
                        $path = 'public/media/product/image_one/formal/'.$imageName;
                        Image::make($image_tmp)->resize(600,600)->save($path,80);
                        $product->image_one ='public/media/product/image_one/formal/'.$imageName;
                    }
                }
                
                if ($request->hasFile('image_two')) {
                     if(!empty($product->image_one)){
        	            $location=$product['image_two'];
        	            if(File::exists($location)){
        	                File::delete($location);
        	            }
        	        }
                    $image_tmp = $request->file('image_two');
                    if ($image_tmp->isValid()) {
                        // Upload Images after Resize
                        $extension =  $image_tmp->getClientOriginalExtension();
                        $imageName =  rand(111, 99999) . '.' . $extension;
                        $path_two = 'public/media/product/image_two/formal/'.$imageName;
                        Image::make($image_tmp)->resize(600,600)->save($path_two,80);
                       $product->image_two ='public/media/product/image_two/formal/'.$imageName;
                    }
                }
            }else{
                if ($request->hasFile('image_one')) {
                    if(!empty($product->image_one)){
        	            $location=$product['image_one'];
        	            if(File::exists($location)){
        	                File::delete($location);
        	            }
        	        }
                    $image_tmp = $request->file('image_one');
                    if ($image_tmp->isValid()) {
                        // Upload Images after Resize
                        $extension =  $image_tmp->getClientOriginalExtension();
                        $imageName =  rand(111, 99999) . '.' . $extension;
                        $path = 'public/media/product/image_one/'.$imageName;
                        Image::make($image_tmp)->resize(1100,1280)->save($path,80);
                        $product->image_one ='public/media/product/image_one/'.$imageName;
                    }
                }
                
                if ($request->hasFile('image_two')) {
                     if(!empty($product->image_one)){
        	            $location=$product['image_two'];
        	            if(File::exists($location)){
        	                File::delete($location);
        	            }
        	        }
                    $image_tmp = $request->file('image_two');
                    if ($image_tmp->isValid()) {
                        // Upload Images after Resize
                        $extension =  $image_tmp->getClientOriginalExtension();
                        $imageName =  rand(111, 99999) . '.' . $extension;
                        $path_two = 'public/media/product/image_two/'.$imageName;
                        Image::make($image_tmp)->resize(1100,1280)->save($path_two,80);
                        $product->image_two ='public/media/product/image_two/'.$imageName;
                    }
                }
            }
            
            if ($request->hasFile('image_three')) {
                if(!empty($product->image_three)){
    	            $location=$product['image_three'];
    	            if(File::exists($location)){
    	                File::delete($location);
    	            }
    	        }
    	        
                $image_tmp = $request->file('image_three');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension =  $image_tmp->getClientOriginalExtension();
                    $imageName =  rand(111, 99999) . '.' . $extension;
                    $path_three = 'public/media/product/image_three/'.$imageName;
                    Image::make($image_tmp)->resize(1100,1280)->save($path_three,80);
                   $product->image_three ='public/media/product/image_three/'.$imageName;
                }
            }
           
            $product->save();
            
            if($id==''){
                $product_id=DB::getPdo()->lastInsertId();
            }else{
               $product_id=$id; 
            }
            
            //=====upload multiple image=====//
            if($request->hasFile('product_images')){
                $images =$request->file('product_images');
                foreach($images as $key=>$image){
                    $image_tmp =Image::make($image);
                    $extension =  $image->getClientOriginalExtension();
                    $imageName =  rand(111, 99999) . '.' . $extension;
                    $path_large = 'public/media/product/multiple/large/'.$imageName;
                    Image::make($image)->resize(1000,1280)->save($path_large,60);
                    $image=new ProductImage();
                    $image->product_image=$imageName;
                    $image->product_id=$product_id;
                    $image->save();
                }
            }
            
            //====sort Products======//
            if($id !=""){
                if(isset($data['image'])){
                    foreach($data['image'] as $key=>$image){
                      ProductImage::where(['product_id'=>$id,'product_image'=>$image])->update(['image_sort'=>$data['image_sort'][$key]]);
                    }
                }
            }
            
            // =====product Attribute--=====
             //$countAttribute=count($data['sku']);
            //dd($countGroup);
            //  for($i=1;$i<$countAttribute;$i++){
                 
            //  }
            
            
         
            
            foreach($data['weight_size'] as $key=>$value){
                if(!empty($value)){
                  
                    $attarCountSize=AttributeProduct::where(['product_id'=>$product_id,'weight_size'=>$value])->count();
                    if($attarCountSize>0){
                      Session::flash('error','This size Already Exists');
                      return redirect()->back();  
                    }
                    
                    $attribute=new AttributeProduct();
                    $attribute->product_id=$product_id;
                    $attribute->sku=rand(1111,9999);
                    $attribute->weight_size=$value;
                    $attribute->stock=$data['stock'][$key];
                    $attribute->price=$data['selling_price'];
                    $attribute->length=$data['length'][$key];
                    $attribute->chest=$data['chest'][$key];
                    $attribute->waist=$data['waist'][$key];
                    $attribute->status=1;
                    $attribute->save();
                    
                   
                }
            }
            
            
            // if($request->hasFile('product_images')){
            //     $images =$request->file('product_images');
            //     foreach($images as $key=>$image){
            //         if(!empty($image)){
            //             $countSku=AttributeProduct::where(['sku'=>$data['sku'][$key]])->count();
            //             if($countSku>0){
            //               Session::flash('error','This SKU Already Exists');
            //               return redirect()->back();  
            //             }
            //             $attarCountSize=AttributeProduct::where(['product_id'=>$product_id,'weight_size'=>$data['weight_size'][$key]])->count();
            //             if($attarCountSize>0){
            //               Session::flash('error','This size Already Exists');
            //               return redirect()->back();  
            //             }
            //                 $image_tmp =Image::make($image);
            //                 $extension =  $image->getClientOriginalExtension();
            //                 $imageName =  rand(111, 99999) . '.' . $extension;
            //                 $path_small = 'public/media/product/multiple/small/'.$imageName;
            //                 $path_medium = 'public/media/product/multiple/medium/'.$imageName;
            //                 $path_large = 'public/media/product/multiple/large/'.$imageName;
            //                 Image::make($image)->resize(70,94)->save($path_small,70);
            //                 Image::make($image)->resize(355,472)->save($path_medium,70);
            //                 Image::make($image)->resize(668,760)->save($path_large,70);
            //                 $image=new AttributeProduct();
            //                 $image->product_id=$product_id;
            //                 $image->product_images=$imageName;
            //                 $image->sku=$data['sku'][$key];
            //                 $image->weight_size=$data['weight_size'][$key];
            //                 $image->stock=$data['stock'][$key];
            //                 $image->color=$data['color'][$key];
            //                 $image->price=$data['price'][$key];
            //                 $image->length=$data['length'][$key];
            //                 $image->chest=$data['chest'][$key];
            //                 $image->waist=$data['waist'][$key];
            //                 $image->status=1;
            //                 $image->save();
            //                 Product::where('id',$product_id)->update(['product_quantity'=>$data['product_quantity']]);
            //         }
            //     }
            // }
                 
          
            
            
            if($id !=""){
                if(isset($data['attrId'])){
                    foreach($data['attrId'] as $akey=>$attr){
                        if(!empty($attr)){
                            AttributeProduct::where(['id'=>$data['attrId'][$akey]])->update(['stock'=>$data['stocks'][$akey],'price'=>$data['price'][$akey],'length'=>$data['length'][$akey],'chest'=>$data['chest'][$akey],'waist'=>$data['waist'][$akey]]);
                        }
                    }   
                }
            }
            
            if($id==''){
                Product::where('id',$product_id)->update(['product_quantity'=>$data['product_quantity']]);
            }
           
            if($id !=""){
                $sumProduct=AttributeProduct::where('product_id',$product_id)->sum('stock'); 
                Product::where('id',$product_id)->update(['product_quantity'=>$sumProduct]);
            }
            
         
         
            
            Session::flash('success',$message);
            return redirect('admin/product-lists');
        }

        $categories = Section::with('categories')->where('status',1)->get();
        $categories = json_decode(json_encode($categories),true);
        //echo"<pre>";print_r($categories);die;
        $brands=Brand::where('status','1')->get()->toArray();
        $colors=Color::where('status',1)->get()->toArray();
    
        $modes=Category::where('parent_id',0)->where('status',1)->select('category_name')->groupBy('category_name')->get()->toArray();
        $events=OccasionalEvent::where('status',1)->where('name','!=','All')->get()->toArray();
        $abouts=AboutProduct::where('status',1)->get()->toArray();
    	return view('admin.product.create',compact('categories','colors','brands','title','events','product','modes','abouts','aboutPart'));
    }



  //subcategory collect by ajax request
    // public function GetSubcat($category_id)
    // {
    // 	$cat = DB::table("subcategories")->where("category_id",$category_id)->get();
    //     return json_encode($cat);
    // }
    
    
    // ======attribute image=====//
    
    public function attributeImageProduct(Request $request,$id){
        if($request->isMethod('post')){
           $image=AttributeProduct::find($id); 
           if ($request->hasFile('product_images')) {
                if(!empty($image['product_images'])){
    	            $location='public/media/product/multiple/small/'.$image['product_images'];
    	            $location_two='public/media/product/multiple/medium/'.$image['product_images'];
    	            $location_three='public/media/product/multiple/large/'.$image['product_images'];
    	            if(File::exists($location) || File::exists($location_two) || File::exists($location_three)){
    	                File::delete($location);
    	                File::delete($location_two);
    	                File::delete($location_three);
    	            }
    	        }
                $image_tmp = $request->file('product_images');
                if ($image_tmp->isValid()) {
                    // Upload Images after Resize
                    $extension =  $image_tmp->getClientOriginalExtension();
                    $imageName =  rand(111, 99999) . '.' . $extension;
                    $path_small = 'public/media/product/multiple/small/'.$imageName;
                    $path_medium = 'public/media/product/multiple/medium/'.$imageName;
                    $path_large = 'public/media/product/multiple/large/'.$imageName;
                    Image::make($image_tmp)->resize(70,94)->save($path_small,70);
                    Image::make($image_tmp)->resize(355,472)->save($path_medium,70);
                    Image::make($image_tmp)->resize(668,760)->save($path_large,70);;
                    $image->product_images =$imageName;
                }
            }
            $image->product_id=$image['product_id'];
            $image->save();
            Session::flash('success','Image Updated');
            return redirect('admin/product-create-store/'.$image['product_id']);
        }
        
    }
    
    
    //======= product status upadate========//
    
    public function updateStatusProduct(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            Product::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    } 
    
    //======= product status faq upadate========//
    
    public function updateStatusFaqProduct(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            ProductFaq::where('id',$data['faq_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'faq_id'=>$data['faq_id']]);
        }
    }

    // =======Product Delete functionality======//
    
    public function deleteProduct($id)
    {
       $product=Product::find($id); 
      
        foreach($product->images as $image){
           $locationimage='public/media/product/multiple/small/'.$image->product_image;
           $locationimage_two='public/media/product/multiple/large/'.$image->product_image;
           
            if(File::exists($locationimage) || File::exists($locationimage_two)){
               File::delete($locationimage);
               File::delete($locationimage_two);
            }
            
            $image->delete();
        }
        
        //======product Delete itself======//
        
        $location='public/media/product/image_one/'.$product->image_one;
        $location_two='public/media/product/image_two/'.$product->image_two;
        $location_three='public/video/product/'.$product->video_link;
       
        if(File::exists($location) || File::exists($location_two) || File::exists($location_three)){
            File::delete($location);
            File::delete($location_two);
            File::delete($location_three);
        }
        
        //====product Attribute=====//
        
        foreach($product('attributes') as $data){
            $data->delete('id');
        }
        
        $product->delete();
       
       Session::flash('success','Video Deleted Successfully');
       return redirect('admin/product-lists');
    } 
    
    
    //=====Multiple Image Delete=====//
    
    public function deleteImageProduct($id)
    {
       $productImage=ProductImage::find($id); 
       $location='public/media/product/multiple/small/'.$productImage->product_image;
       $location_two='public/media/product/multiple/large/'.$productImage->product_image;
       if(File::exists($location) ||File::exists($location_two)){
           File::delete($location);
           File::delete($location_two);
       }
       $productImage->delete();
       
       Session::flash('success','Product Image Deleted Successfully');
       return redirect('admin/product-lists');
    }

    public function ViewProduct($id)
    {
        $product=Product::with(['category','section','brand'])->where('status',1)->where('id',$id)->first();
        return view('admin.product.show',compact('product'));
    }
    // ===== product video========//
    
    public function deleteVideoProduct($id){
       $product=Product::find($id); 
       $location='public/video/product/'.$product->video_link;
       if(File::exists($location)){
           File::delete($location);
       }
       Product::where('id',$id)->update(['video_link'=>'']);
       Session::flash('success','Video Deleted Successfully');
       return redirect('admin/product-lists');
    }

    // ====product attribute parts===========//
    
    public function updateAttribute(Request $request){
        if($request->ajax()){
            
            $data = $request->all();
            
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            AttributeProduct::where('id',$data['attribute_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'attribute_id'=>$data['attribute_id']]);
        }
    } 
    //==========about product status========
    public function updatStatusAboutProduct(Request $request){
        if($request->ajax()){
            
            $data = $request->all();
            
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            AboutProduct::where('id',$data['about_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'about_id'=>$data['about_id']]);
        }
    }
    
    public function faqProduct(Request $request,$id){
        $title="Product Faq For Detail Page";
        $message="Item Added successfully";
        $product=Product::find($id);
        if($request->isMethod('post')){
            $data=$request->all();
            foreach($data['question'] as $key=>$qst){
                if(!empty($qst)){
                    $countFaq=ProductFaq::where(['question'=>$qst])->where('answer',$data['answer'][$key])->count();
                    if($countFaq>0){
                        Session::flash('error','This Already Exists');
                        return redirect()->back();  
                    }
                    $faq=new ProductFaq();
                    $faq->question=$qst;
                    $faq->product_id=$product->id;
                    $faq->answer=$data['answer'][$key];
                    $faq->save();
                }
            }
            Session::flash('success',$message);
            return redirect()->back();
        }
        return view('admin.product.faq.create',compact('title','product'));
    }
    
    public function faqUpdateProduct(Request $request){
       if($request->isMethod('post')) {
           $data=$request->all();
           foreach($data['faqId'] as $akey=>$attr){
            if(!empty($attr)){
                ProductFaq::where(['id'=>$data['faqId'][$akey]])->update(['question'=>$data['question'][$akey],'answer'=>$data['answer'][$akey]]);
                
            }
        }
        
        Session::flash('success','Updated Successfully');
        return redirect()->back();
       }
    }
    
    //product About Partta
    public function aboutProduct(Request $request){
        $title="Product About For Detail Page";
        $message="Item Added successfully";
        if($request->isMethod('post')){
            $data=$request->all();
            //dd($data);
             if($request->hasFile('image')){
                $images =$request->file('image');
                //dd($images);
                foreach($images as $key=>$image){
                    if(!empty($image)){
                        $image_tmp =Image::make($image);
                        $extension =  $image->getClientOriginalExtension();
                        //dd($extension);
                        $imageName =  rand(111, 99999) . '.' . $extension;
                        $path = 'public/media/product/other/'.$imageName;
                        Image::make($image_tmp)->resize(68,42)->save($path,90);
                        $image=new AboutProduct();
                        $image->image='public/media/product/other/'.$imageName;
                        $image->title=$data['title'][$key];
                        $image->save();
                    }
                }
                  
                Session::flash('success',$message);
                return redirect()->back();
            }
           
        }
        
        Session::put('page','productabout');
        $abouts=AboutProduct::get()->toArray();
        return view('admin.product.about.create',compact('title','abouts'));
    }
    
    
       public function aboutUpdateProduct(Request $request){
        $title="Product About For Detail Page";
        $message="Item Added successfully";
        if($request->isMethod('post')){
            $data=$request->all();
            
           //dd($data['id']);
           foreach($data['aboutid'] as $ikey=>$attrs){
               if(!empty($attrs)){
                  AboutProduct::where(['id'=>$data['aboutid'][$ikey]])->update(['title'=>$data['title'][$ikey]]);
               }
           }
            Session::flash('success',$message);
            return redirect()->back();
            }
             
             
    }

    public function timeIndex(){
        $sale=SalesTimer::where('status',1)->get();
        return view('admin.saletime.index',compact('sale'));
    }
    public function addEditTime(Request $request,$id=null){
        if($id==''){
            $title="Add New Date And Time";
            $saletime= new SalesTimer;
            $message="Added Successfully";
        }else{
            $title="Updated Date And Time";
             $saletime=SalesTimer::find($id);
              $message="Updated Successfully";
        }
        if($request->isMethod('post')){
            $data=$request->all();
            $saletime->sale_date=$data['sale_date'];
            $saletime->status=1;
            $saletime->save();
            $notification=array(
                 'messege'=>$message,
                 'alert-type'=>'success'
                       );
        return Redirect()->route('admin.sale-time-index')->with($notification);

        }

        return view('admin.saletime.create',compact('title','saletime'));

    }
    
    public function indexColor(){
        Session::put('page','color');
        $title="Family Color List";
        $colors=Color::get();
        return view('admin.color.index',compact('title','colors'));
    }
    
    public function storeColor(Request $request){
         if($request->isMethod('post')){
            $data=$request->all();
            $countName=count($data['name']);
            //dd($countGroup);
             for($i=0;$i<$countName;$i++){
               $color=new Color();
               $color->name=$data['name'][$i];
               $color->code=$data['code'][$i];
               $color->save();
            }
            Session::flash('success','Family Color Added Successfully');
            return redirect('admin/color-lists');
        }
        $title="Family Color Create Page";
        return view('admin.color.create',compact('title'));
    }
    
    public function updateColor(Request $request,$id){
        $color=Color::find($id);
        if($request->isMethod('post')){
            $data=$request->all();
            Color::where('id',$id)->update(['name'=>$data['name'],'code'=>$data['code']]);
            Session::flash('success','Family Color Updated Successfully');
            return redirect('admin/color-lists');
        }
        $title=" Family Color Update Page";
         return view('admin.color.edit',compact('title','color'));
    }
    
    
      public function statusColor(Request $request){
            if($request->ajax()){
                $data = $request->all();
                if($data['status']=="Active"){
                    $status = 0;
                }else{
                    $status= 1;
                }
                Color::where('id',$data['section_id'])->update(['status'=>$status]);
                return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
            }
    }
    
    public function indexEvent(){
       Session::put('page','event');
        $title="Event List";
        $events=OccasionalEvent::get();
        return view('admin.event.index',compact('title','events')); 
    }
    
    public function storeEvent(Request $request){
         if($request->isMethod('post')){
            $data=$request->all();
            $countName=count($data['name']);
            //dd($countGroup);
             for($i=0;$i<$countName;$i++){
               $event=new OccasionalEvent();
               $event->name=$data['name'][$i];
               $event->save();
            }
            Session::flash('success','Event Added Successfully');
            return redirect('admin/occassion-event-lists');
        }
        $title="Event Create Page";
        return view('admin.event.create',compact('title'));
    }
    
     public function updateEvent(Request $request,$id){
        $event=OccasionalEvent::find($id);
        if($request->isMethod('post')){
            $data=$request->all();
            OccasionalEvent::where('id',$id)->update(['name'=>$data['name'],'sort_id'=>$data['sort_id']]);
            Session::flash('success','Event Updated Successfully');
            return redirect('admin/occassion-event-lists');
        }
        $title=" Eventr Update Page";
         return view('admin.event.edit',compact('title','event'));
    }
    
    
      public function statusEvent(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
            }
            OccasionalEvent::where('id',$data['section_id'])->update(['status'=>$status]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }
    
    //=======Pre Order======//
    
    public function getPreorder(){
        $title="Pre Order Lists";
        Session::put('page','pre_order');
        $preOrders=PreOrder::get();
        return view('admin.preorder.index',compact('preOrders','title'));
    }
    
    public function statusPreorder(Request $request){
        if($request->ajax()){
            $data = $request->all();
            if($data['status']=="Active"){
                $status = 0;
            }else{
                $status= 1;
                
            }
            PreOrder::where('id',$data['section_id'])->update(['status'=>$status,'user_id'=>Auth::guard('admin')->user()->id]);
            return response()->json(['status'=>$status,'section_id'=>$data['section_id']]);
        }
    }
    
    public function getDiscountProducts(){
       $products = Product::whereNotNull('discount_price')->get();
       foreach($products as $product){
           $currentDate=Carbon::now()->toDateString();
           if($product->discount_date==$currentDate){
               Product::where('id',$product->id)->update(['discount_date'=>NULL,'discount_price'=>NULL]);
           }
       }
       //dd($products);

    }
    
    public function getNewArrivalProducts(){
       $products = Product::where('is_feature',"Yes")->get();
       dd($products);
       foreach($products as $product){
           $currentDate=Carbon::now()->toDateString();
           if($product->discount_date==$currentDate){
               Product::where('id',$product->id)->update(['discount_date'=>NULL,'discount_price'=>NULL]);
           }
       }
       //dd($products);

    }
}

 @extends('layouts.app')
 @section('content')
 <?php
  use App\ProductFilter;
    
 use App\Product;
  $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$productDetails['id'])->where('status',1)->get();
   $productFilters=ProductFilter::productFilters();
 ?>
 <style>
     .product_footer h2{
         color:black !important;
         font-size:15px;
     }
 </style>
 
    <?php
        $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
        $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
        if($currencieCount>0){
            $amount= $currencies->exchange_rate;
            $selling_price=$data['selling_price'] * $amount;
            $discounte=$discounted_price * $amount;
        }else{
            $selling_price=$data['selling_price'];
            $discounte=$discounted_price ;
        }
    ?>

    <link href="{{asset('public/frontend/assets/css/single.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/frontend/assets/css/venobox.min.css')}}" rel="stylesheet" type="text/css" />
 <?php
//  $id=$productDetails['id'];
//  $OrderDetail=App\OrderDetail::with('users')->where('product_id',$id)->where('review','yes')->latest()->take(5)->get();

//  $reviewCount=App\OrderDetail::with('users')->where('product_id',$id)->where('review','yes')->count();

 //$sum=App\OrderDetail::with('users')->where('product_id',$id)->where('review','yes')->sum('id');
 //dd($sum);die;
?>
    <main>
        <!--========== product area ===========-->
        <div class="single_product_area" style="margin-top: 118px !important;">
            <div class="container">
                <div class="row mainproduct_view">
                    <!-- Product Image -->
                     <div class="col-lg-6 leftsection d-lg-block d-none">
                        <div class="product_image_wrapper">
                            <div class="list_of_product_img">
                                <ul id="productImageList">
                                    
                                    @foreach($productImages as $image)
                                    <li class="active"><img src="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" alt="Product Image"></li>
                                    @endforeach
                                </ul>
                                <button id="productImageListScrollDown">
                                    <i class="fal fa-angle-down"></i>
                                </button>
                            </div>
                            <div class="full_product_image">
                                <!-- Image Tag -->
                                <div class="tags">
                                    <span class="bg-light text-dark">New Style</span>
                                    <span class="bg-dark text-light">coreflex</span>
                                </div>
                                <!-- full Size Image -->
                               @if(count($productImages)>0)<span id="uploaded_image"><img src="{{asset('public/media/product/multiple/large/'.$productImages[0]['product_image'])}}" alt="Full Size Product Image" id="full_size_of_product_image"></span>
                               @else <img src="{{asset('public/media/product/image_two/large/'.$productDetails['image_two'])}}" alt="Full Size Product Image" id="full_size_of_product_image"> @endif
                            </div>
                        </div>
                    </div>
                    
                    <!-- Product Image Slider For medium and small Device -->
                    <div class="col-12 d-lg-none">
                        <div class="product_image_slider owl-carousel owl-theme">
                             @foreach($productImages as $image)
                            <div class="item">
                                <img src="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" alt="Product Image">
                            </div>
                            @endforeach
                         
                        </div>
                    </div>
                    
                     <?php
                        $getMostPopular=App\ProductRating::with('product')->where('product_id',$productDetails['id'])->get();
                        $getOrderDetailStarCount=$getMostPopular->count();
                        $sumRating=$getMostPopular->sum('rating');
                        if($getOrderDetailStarCount>0){
                            $avg=round($sumRating/$getOrderDetailStarCount,2);
                            $roundAvg=round($sumRating/$getOrderDetailStarCount);
                        }else{
                            $roundAvg=0;
                        }
                          //dd($applyMost);
                        ?>
                    <!-- Product description -->
                    <div class="col-lg-6 Product_Desc_wrapper">
                        <div class="product_desc_inner ps-lg-5">
                            <div class="product_bio sectionbreack pt-0">
                                <!-- Review star -->
                            <?php
                                $star=1;
                                while ($star <= $roundAvg) {?>
                                <i style="color:#b17714ab;" class="fa fa-star"></i>
                                <?php $star++;
                            }?>
                                <!-- Product Name -->
                                <h2 class="product_name">{{$productDetails['product_name']}}</h2></br>
                                <p class="product_color" style="color: #ab01ff;text-transform: uppercase;margin: 8px 2px;">{{$productDetails['product_code']}}/ {{$productDetails['category']['category_name']}}/ {{$productDetails['section']['name']}}</p>
                                <h4 class="getAttrSize" style="float:right">{{$productDetails['selling_price']}}</h4>
                            </div>

                            <!-- Product Size guide -->
                            <div class="size_guide sectionbreack">
                                <div class="topcon">
                                    <h2 class="fit">fit</h2>
                                    <p class="fit_comment">Signature-Fit</p>
                                    <img src="img/fit-info.png" title="Fit Info" alt="fit info" class="fit_info">
                                    <button type="button" data-bs-toggle="modal" data-bs-target="#sizeguidemodal" class="size_guide_btn">Size Guide</button>
                                </div>
                                <div class="fit_info_wrapper row">
                                    <div class="col-8 p-0">
                                        <h2>Signature-Fit</h2>
                                        <p>{!! $productDetails['product_guide'] !!}</p>
                                    </div>
                                    <div class="col-4 p-0">
                                        <img src="img/sizeinfoprogressive.avif" alt="">
                                    </div>
                                </div>
                            </div>
                            <div class="quick_product_data"></div>
                            <form action="#" method="post">
                                <!-- Product Colors -->
                                <div class="product_colors sectionbreack">
                                    <div class="staple-colors">
                                        <h2>STAPLE COLORS <span class="staple_color_name"></span></h2>
                                        <ul class="staple-radio-buttons">
                                        @if(count($groupProducts)>0)
                                            @foreach($groupProducts as $key=>$color)
                                            <li class="bg-light detailColor @if($key == 0) active @endif" data-product-id="{{$color['id']}}" data-staple-color="{{$color['product_color']}}" style="background:{{$color['product_color']}} !important"><a href="{{url('product/details/'.$color['id'].'/'.$color['product_name'])}}"></a></li>
                                            @endforeach
                                        @endif    
                                        </ul>
                                        <button class="quantity-btn minus-class">-</button>
                                        <input type="number" class="quantity-input qty-class" value="1" />
                                        <button class="quantity-btn plus-class">+</button>
                                    </div>
                                </div>

                                <!-- Product Size -->
                                <div class="product_size sectionbreack">
                                    <h2>Size <span>Small</span></h2>
                                    <ul class="size">
                                        @foreach($productSizes as  $key=>$size)
                                        @if($size->sum('stock') > 0)
                                        <li id="size" data-size-id="{{$size->weight_size}}" class="@if($key==0) active @endif">{{$size->weight_size}}</li>
                                        @else
                                        <li data-size-id="{{$size->weight_size}}" class="active" disabled>{{$size->weight_size}}</li>
                                        @endif
                                        @endforeach
                                    </ul>
                                </div>

                                <!-- Add to cart button -->
                                <div class="addtocart_area addtocart_area_btn pt-3">
                                    <input type="hidden" value="{{$productDetails['id']}}" class="product_id">
                                    <button class="add_to_cart addCartItemNew" >Add to Cart</button>                                    
                                </div>
                            </form>
                            </div>
                            <div class="addtocart_area afterAddtocartArear pt-0">
                                <?php
                                    $aboutTrigger=DB::table('announcements')->where('trigger','detail')->where('status',1)->first();
                                ?>
                                <p class="con">{!!$aboutTrigger->note!!}</p>
                                <div class="shipping_wrap">
                                    <img src="{{asset('public/frontend/assets/img/shipping-car.png')}}" alt="ship">
                                    <span>Ship to</span>
                                    <button type="button" class="shippingformtrigger"><img src="{{asset('public/frontend/assets/img/ship-arrow.png')}}" alt="arrow"></button>                                    
                                </div>
                                <div class="shipping_form_wrap">
                                    <form action="#" method="post" class="row">
                                        <input type="text" id="zipCode" class="col-8 zipcode" placeholder="zip code" required>
                                        <button type="button" id="checkPinCode" class="col-4">Verify</button>
                                    </form>
                                    <span id="zipCodeStatus" style="margin-top:10px"></span>
                                </div>
                                <div class="get_it_son pt-3">
                                    <img src="{{asset('public/frontend/assets/img/clock.png')}}" alt="clock">
                                    <span>Get it soon as</span>
                                    <strong>{{\Carbon\Carbon::now()->addDays(6)->format('Y-M-d')}}</strong>
                                </div>
                                <p class="con">{!!$productDetails['product_details']!!}</p>
                            </div>

                            <div class="size_care_acrodion pt-3">
                                <div class="accordion" id="accordionExample">
                                    <?php
                                        $faqs=App\ProductFaq::where('status',1)->where('product_id',$productDetails['id'])->get()->toArray();
                                    ?>
                                    @if(count($faqs)>0)
                                    @foreach($faqs as $data)
                                    <div class="accordion-item">
                                      <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                           {{$data['question']}}
                                        </button>
                                      </h2>
                                      <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                        <div class="accordion-body">
                                          <ul>
                                            <li>
                                                {{$data['answer']}}
                                            </li>
                                          </ul>                                            
                                        </div>
                                      </div>
                                    </div>
                                    @endforeach
                                    @endif
                                  </div>
                            </div>

                            <!-- Product Features Description -->
                            <div class="row m-0 product_features">
                                <?php
                                    $aboutId=explode(',',$productDetails['about_product_id']);
                                    
                                    $abouts=App\AboutProduct::where('status',1)->whereIn('id',$aboutId)->get()->toArray();
                                    $sectionId=App\Section::find($productDetails['section_id']);
                                    $get=App\Product::where('product_mode','!=',$productDetails['product_mode'])->where('category_id','!=',$productDetails['category_id'])->where('section_id',$productDetails['section_id'])->where('status',1)->get();
                                    //dd($get);die;
                                ?>
                                @if(count($abouts)>0)
                                @foreach($abouts as $about)
                                <div class="col-sm-4 item col-6">
                                    <img src="{{asset($about['image'])}}" alt="features">
                                    <p>{{$about['title']}}</p>
                                </div>
                                @endforeach
                                @endif
                            </div>

                            <!-- COMPLETE THE LOOK -->
                            <div class="row">
                                <div class="col-12">
                                    <h2>COMPLETE THE LOOK</h2>
                                </div>
                                <!-- Products -->
                                @foreach($get as $data)
                                <?php
                                    $discounted_price=Product::getProductdiscount($data['id']);
                                    $groupProducts=array();
                                    if(!empty($data['group_code'])){
                                        $groupProducts=App\Product::select('id','product_color')->where(['group_code'=>$data['group_code'],'status'=>1])->get()->toArray();
                                        //dd($groupProducts);die;
                                    }
                                     $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$data['id'])->where('status',1)->where('stock','>',0)->get();
                                ?>
                                <div class="col-6 complete_look_product products quick_product_data">
                                    <div class="product_header">
                                        <button class="product-wish wish"><i class="fas fa-heart"></i></button>
                                        <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                                            <img src="{{ asset($data['image_one'])}}" alt="Product Name" class="product_image">
                                        </a>
                                        @if(count($productSizes)>0)
                                        <div class="quick_add">
                                            <input class="form-control input-number qty-class" type="hidden" value="1">
                                            <input type="hidden" value="{{$data['id']}}" class="product_id">
                                            <button class="quick_add addCartItemNew">+ Quick Add</button>
                                        </div>
                                        @endif
                                    </div>
                                     <div class="product_footer">
                                        <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                                            <p class="product_color" style="color: #ab01ff;text-transform: uppercase;margin: 8px 2px;">{{$data['product_code']}}/ {{$data['category']['category_name']}}/ {{$data['section']['name']}}</p>
                                            <h2 class="product_title">{{$data['product_name']}}</h2>
                                        </a>
                                        <h4 class="product_price"> @if($discounted_price>0)<span>{{$discounted_price}}</span>&nbsp;&nbsp;<del style="color:red">{{$data['selling_price']}}</del> @else <span>{{$data['selling_price']}}</span> @endif</h4>
                                        <ul class="colors staple-radio-buttons">
                                          
                                            @foreach($groupProducts as $key=>$color)
                                            <li class="bg-light detailColor @if($key == 0) active @endif" data-staple-color="{{$color['product_color']}}" style="background:{{$color['product_color']}} !important"><a href="javascript:void(0);"></a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                    <!-- Product Size -->
                                     <!-- Product Size -->
                                    <div class="product_size sectionbreack">
                                        <ul class="size">
                                            @foreach($productSizes as  $key=>$size)
                                            @if($size->sum('stock') > 0)
                                            <li id="size" data-size-id="{{$size->weight_size}}" class="@if($key==0)active @endif">{{$size->weight_size}}</li>
                                            @else
                                            <li data-size-id="{{$size->weight_size}}" class="active" disabled>{{$size->weight_size}}</li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                @endforeach   
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Video Area -->
        <div class="video_area">
            <div class="container">
                <div class="row">
                     @if($productDetails['video_link'])
                    <div class="col-md-6">
                        <div class="singleproduct_video_wrap">
                            <button class="video_paly_btn video_action_button active">
                                <img src="{{asset('public/frontend/assets/img/pause.png')}}" alt="Play">
                                <p>Watch Now</p>
                            </button>
                            <button class="video_pause_btn video_action_button">
                                <img src="{{asset('public/frontend/assets/img/pause.png')}}" alt="Pause">
                            </button>
                            <video class="w-100 productIntroVideo" loop autoplay>
                                <source src="{{asset('public/video/product/'.$productDetails['video_link'])}}" type="video/mp4">
                            </video>
                         
                        </div>
                    </div>
                    @elseif($productDetails['youtube_link'])
                    <div class="col-md-6">
                        <div class="singleproduct_video_wrap">
                            <iframe width="720" height="345" src="{{$productDetails['youtube_link']}}">
                                
                            </iframe>
                        </div>
                    </div>
                    @endif
                    <div class="col-md-6 gap-3 gap-lg-4 ps-lg-5 ps-md-3 d-flex justify-content-center flex-column">
                        <h4 class="subtitle">Wash Care</h4>
                        <h2 class="secTitle">{{$productDetails['product_name']}}</h2>
                        <ul class="con">
                            <li>{!! $productDetails['wash_care'] !!}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recommended For You area -->
        <div class="recommended_area">
            <div class="container">
                <h2 class="secTitle text-center pb-4">Related Products</h2>
                <div class="recommended_slider_wrapper">
                    <div class="recommended_slider owl-carousel owl-theme">
                        @foreach($realatedProducts as $data)
                            <?php
                                $discounted_price=Product::getProductdiscount($data['id']);
                                $groupProducts=array();
                                if(!empty($data['group_code'])){
                                    $groupProducts=App\Product::select('id','product_color')->where(['group_code'=>$data['group_code'],'status'=>1])->get()->toArray();
                                        //dd($groupProducts);die;
                                }
                                $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$data['id'])->where('status',1)->where('stock','>',0)->get();
                            ?>
                        <div class="item complete_look_product products quick_product_data">
                            <div class="product_header">
                                 <button class="product-wish wish"><i class="fas fa-heart"></i></button>
                                <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                                    <img src="{{asset($data['image_one'])}}" alt="Product Name" class="product_image">
                                </a>
                               
                                @if(count($productSizes)>0)
                                <div class="quick_add">
                                    <input class="form-control input-number qty-class" type="hidden" value="1">
                                    <input type="hidden" value="{{$data['id']}}" class="product_id">
                                    <button class="quick_add addCartItemNew">+ Quick Add</button>
                                </div>
                                @endif
                            </div>
                             <div class="product_footer">
                                <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                                    <p class="product_color" style="color: #ab01ff;text-transform: uppercase;margin: 8px 2px;">{{$data['product_code']}}/ {{$data['category']['category_name']}}/ {{$data['section']['name']}}</p>
                                    <h2 class="product_title">{{$data['product_name']}}</h2>
                                </a>
                                <h4 class="product_price"> @if($discounted_price>0)<span>{{$discounted_price}}</span>&nbsp;&nbsp;<del style="color:red">{{$data['selling_price']}}</del> @else <span>{{$data['selling_price']}}</span> @endif</h4>
                                <ul class="colors staple-radio-buttons">
                                  
                                    @foreach($groupProducts as $key=>$color)
                                    <li class="bg-light detailColor @if($key == 0) active @endif" data-staple-color="{{$color['product_color']}}" style="background:{{$color['product_color']}} !important"><a href="javascript:void(0);"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Product Size -->
                             <!-- Product Size -->
                            <div class="product_size sectionbreack">
                                <ul class="size">
                                    @foreach($productSizes as  $key=>$size)
                                    @if($size->sum('stock') > 0)
                                    <li id="size" data-size-id="{{$size->weight_size}}" class="@if($key==0)active @endif">{{$size->weight_size}}</li>
                                    @else
                                    <li data-size-id="{{$size->weight_size}}" class="active" disabled>{{$size->weight_size}}</li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Recently Viewed area -->
        <div class="recommended_area recentviewdarea">
            <div class="container">
                <h2 class="secTitle text-center pb-4">Recently Viewed</h2>
                <div class="recommended_slider_wrapper">
                    <div class="recommended_slider owl-carousel owl-theme">
                        @foreach($recentlyProducts as $data)
                        <div class="item complete_look_product products">
                            <div class="product_header">
                                <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                                    <img src="{{asset($data['image_one'])}}" alt="Product Name" class="product_image">
                                </a>
                                  <?php
                                        $groupProducts=array();
                                        if(!empty($productDetails['group_code'])){
                                            $groupProducts=App\Product::select('id','product_color')->where(['group_code'=>$data['group_code'],'status'=>1])->get()->toArray();
                                        }
                                        $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$data['id'])->where('status',1)->get();
                                    ?>
                                @if(count($productSizes)>0)
                                <div class="quick_add">
                                    <input class="form-control input-number qty-class" type="hidden" value="1">
                                    <input type="hidden" value="{{$data['id']}}" class="product_id">
                                    <button class="quick_add addCartItemNew">+ Quick Add</button>
                                
                                </div>
                                @endif
                            </div>
                            <div class="product_footer">
                                <a href="{{url('product/details/'.$data['id'].'/'.$data['product_name'])}}">
                                    <p class="product_color" style="color: #ab01ff;text-transform: uppercase;margin: 8px 2px;">{{$data['product_code']}}/ {{$data['category']['category_name']}}/ {{$data['section']['name']}}</p>
                                    <h2 class="product_title">{{$data['product_name']}}</h2>
                                </a>
                                <h4 class="product_price"> @if($discounted_price>0)<span>{{$discounted_price}}</span>&nbsp;&nbsp;<del style="color:red">{{$data['selling_price']}}</del> @else <span>{{$data['selling_price']}}</span> @endif</h4>
                                <ul class="colors staple-radio-buttons">
                                  
                                    @foreach($groupProducts as $key=>$color)
                                    <li class="bg-light detailColor @if($key == 0) active @endif" data-staple-color="{{$color['product_color']}}" style="background:{{$color['product_color']}} !important"><a href="javascript:void(0);"></a></li>
                                    @endforeach
                                </ul>
                            </div>
                            <!-- Product Size -->
                             <!-- Product Size -->
                            <div class="product_size sectionbreack">
                                <ul class="size">
                                    @foreach($productSizes as  $key=>$size)
                                    @if($size->sum('stock') > 0)
                                    <li id="size" data-size-id="{{$size->weight_size}}" class="@if($key==0)active @endif">{{$size->weight_size}}</li>
                                    @else
                                    <li data-size-id="{{$size->weight_size}}" class="active" disabled>{{$size->weight_size}}</li>
                                    @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <!-- Category Box Area -->
        <div class="categorys_card_area">
            <div class="container">
                <div class="row">
                    <?php
                        $sectionId=App\Section::whereIn('name',['Mens','Womens'])->pluck('id');
                        //dd($sectionId);
                        $getCat=App\Model\Admin\Category::with(['section'])->whereIn('section_id',$sectionId)->where('parent_id','0')->take('3')->latest()->get()->toArray();
                    ?>
                    @foreach($getCat as $cat)
                    <div class="col-md-4 col-sm-6 ccard man_card">
                        <img src="{{asset('public/media/category/large/'.$cat['image'])}}" alt="">
                        <div class="title_box">
                            <h2 class="secTitle">{{$cat['category_name']}}</h2>
                            <a href="{{url('section-wise/'.$cat['section']['name'])}}" class="cbtn">View All</a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Review Area -->
        <div class="review_area">
            <div class="container">
                <div class="review_header sectionbreack ">
                    <h2>Reviews</h2>
                     <?php
                        $getMostPopular=App\ProductRating::get();
                        $getOrderDetailStarCount=$getMostPopular->count();
                        $sumRating=$getMostPopular->sum('rating');
                        if($getOrderDetailStarCount>0){
                            $avg=round($sumRating/$getOrderDetailStarCount,2);
                            $roundAvg=round($sumRating/$getOrderDetailStarCount);
                        }else{
                            $roundAvg=0;
                        }
                          //dd($applyMost);
                        ?>
                          
                    <ul class="review_star">
                           <?php
                                $star=1;
                                while ($star <= $roundAvg) {?>
                                <li><i style="color:#b17714ab;" class="fa fa-star"></i></li>
                                <?php $star++;
                            }?>
                        <li class="con">({{$roundAvg}}) Reviews</li>
                    </ul>
                    <p class="placeholdertext">Fit Fits true to size</p>
                </div>
                
                <!-- Review Search Area -->
                    <div class="review_search sectionbreack mb_20">
                        <div class="tags_wrap">
                            <ul class="tag">
                                <li data-tag-id="fit" class="active">Product Information</li>
                                <li data-tag-id="comment">Product Comments And Answer</li>
                                <li data-tag-id="review">Review And Comments</li>
                                <li data-tag-id="size">Size Review And Comments</li>
                            </ul>
                        </div>
                        <div class="productTable active" >
                            <div class="col-lg-6 col-md-6">
                                <div class="table-responsive">
                                    <table class="table info-table">
                                        <tbody>
                                            <tr>
                                                <td>Category Name</td>
                                                <td>{{$productDetails['category']['category_name']}}</td>
                                            </tr>
                                             <tr>
                                                <td>Product Code</td>
                                                <td>{{$productDetails['product_code']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Product Quantity</td>
                                                <td>{{$productDetails['product_quantity']}}</td>
                                            </tr>
                                            <tr>
                                                <td>Product Weight</td>
                                                <td>{{$productDetails['product_weight']}} gram</td>
                                            </tr> 
                                           
                                            <tr>
                                                <td>Product Stock</td>
                                                <td> @if($total_stock>0) <span style="color:green;font-size:20px">In Stock </span> @else <span style="color:red;font-size:15px">Not Available</span> @endif</td>
                                            </tr>
                                            
                                            @if($productDetails['occasional'])
                                            <tr>
                                                <td>Event</td>
                                                <td>{{$productDetails['occasion']['name']??""}}</td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td>Product Sku</td>
                                                 @foreach($productSizes as $size)
                                                <td>{{$size['sku']}},</td>
                                                @endforeach
                                            </tr>
                                            @foreach($productFilters as $filter)
                                               <?php
                                                   $filterAvailable=ProductFilter::filterAvailable($filter['id'],$productDetails['category_id']);
                                               ?>
                                               @if($filterAvailable=='Yes')
                                               @if(count($filter['filter_values'])>0)
                                              <tr>
                                                <td>{{$filter['filter_name']}}</td>
                                                 @foreach($filter['filter_values'] as $key=>$value) 
                                                <td>
                                                    @if(!empty($productDetails[$filter['filter_column']]) && $value['filter_value'] ==$productDetails[$filter['filter_column']])
                                                    {{ucwords($value['filter_value'])}}
                                                    @endif
                                                    </td>
                                                @endforeach
                                            </tr>
                                            @endif
                                            @endif
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                         
                        <div class="select_wrap row form-group commentAnswer" style="display:none">
                            <div class="col-lg-6 col-md-6 col-6">
                                <div class="comment-box overflow-hidden">
                                    <div class="leave-title">
                                        <h3>Question And Answer Of The Products</h3>
                                    </div>
                                    <div class="user-comment-box">
                                        <ul>
                                            <?php
                                                $id=$productDetails['id'];
                                                $userComment=App\ProductComment::where('status',1)->where('product_id',$id)->get();
                                               // dd($userComment);die;
                                            ?>
                                            @if(count($userComment)>0)
                                            @foreach($userComment as $row)
                                            <li>
                                                <div class="user-box border-color">
                                                    <div class="user-iamge">
                                                        <img src="{{ asset('public/no_image.png') }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                        <div class="user-name">
                                                            <h6>{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}</h6>
                                                            <h5 class="text-content">{{$row['users']['name']}}</h5>
                                                        </div>
                                                    </div>
            
                                                    <div class="user-contain">
                                                        <p>"{{$row['comment']}}"</p>
                                                    </div>
                                                </div>
                                            </li>
                                            <?php
                                                $id=$row['id'];
                                                $replayCount=App\ProductReplay::where('status',1)->where('comment_id',$id)->get();
                                                //dd($replayCount);die;
                                               ?>
                                            @foreach($replayCount as $data)
                                            <li class="li-padding">
                                                <div class="user-box">
                                                    <div class="user-iamge">
                                                        <img src="{{ asset('public/no_image.png') }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                        <div class="user-name">
                                                            <h6>{{Carbon\Carbon::parse($data['created_at'])->diffForHumans()}}</h6>
                                                            <h5 class="text-content">{{$data['admins']['name']??"No Name"}}</h5>
                                                        </div>
                                                    </div>
                                                    <div class="user-contain">
                                                        <p>"{!!$data['comment_replay']?? "Yet,To Replay"!!}"</p>
                                                    </div>
                                                </div>
                                            </li>
                                            @endforeach
                                            @endforeach
                                            @else
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            @guest
                            <div class="col-lg-6 col-md-6 col-6">
                            <h5 style="color:coral"><a href="{{url('user/login-registers')}}" target="_blank">Please Login</a></h5>
                            <p>Please Ask Relevent Question About the  Products!!</p>
                            </div>
                            @else
                            <div class="col-lg-6 col-md-6 col-6">
                            <form action="{{url('/check-user-post-comment-for-products')}}" method="post">
                                @csrf
                                <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                                <div class="col-lg-3 col-md-4 col-6">
                                   <textarea class="form-control" placeholder="Describe Something" name="comment" rows="4" cols="100"></textarea>
                                </div>
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-primary">
                                    <i class="icofont-water-drop"></i>
                                    <span>Send Query</span>
                                    </button>
                                </div>
                            </form>
                            </div>
                            @endguest
                        </div>
                    </div>
                    
                   <!-- review result area -->
                  <?php 
                        $reviewMany=App\ProductRating::where('product_id',$productDetails['id'])->where('status',1)->get();
                       // echo"<pre>";print_r($reviewMany);die;
                        //dd($reviewMany);die;
                        $getOrderStarCount=$reviewMany->count();
                        //d($getOrderStarCount);
                        $sumRate=$reviewMany->sum('rating');
                        if($getOrderStarCount>0){
                            $avg=round($sumRate/$getOrderStarCount,2);
                            $roundAvgProduct=round($sumRate/$getOrderStarCount);
                        }else{
                            $roundAvgProduct=0;
                        }
                    ?>
                <div class="review_result_area reviewComment" style="display:none">
                    <h3 class="total_review">{{$avg}} Reviews</h3>
                    <div class="reviews " id="size" style="display:block !important">
                        @foreach($reviewMany as $data)
                        <div class="review">
                            <div class="review_header">
                                <div class="review_image">
                                    <img src="{{ asset('public/no_image.png') }}" alt="">
                                </div>
                                <div class="review_bio">
                                    <p class="name"> <strong>{{$data['user']['name']}}</strong></p>
                                    <ul class="stars">
                                        <?php
                                            $star=1;
                                            while ($star <= $roundAvgProduct) {?>
                                            <li><i style="color:#b17714ab;" class="fa fa-star"></i></li>
                                            <?php $star++;
                                        }?>
                                    </ul>
                                </div>
                                <div class="review_date ms-auto">
                                    <p>{{date('Y-M-d',strtotime($data['created_at']))??""}}</p>
                                </div>
                            </div>
                            <div class="review_body">
                                <p class="review_message">{{$data['review']}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                
                <?php 
                    $reviewSize=App\ProductRating::select('size_review','size_rating','id')->where('product_id',$productDetails['id'])->where('status',1)->get();
                   // echo"<pre>";print_r($reviewMany);die;
                    //dd($reviewMany);die;
                    $getOrderStarCount=$reviewSize->count();
                    //d($getOrderStarCount);
                    $sumRate=$reviewSize->sum('size_rating');
                    if($getOrderStarCount>0){
                        $avg=round($sumRate/$getOrderStarCount,2);
                        $roundAvgProduct=round($sumRate/$getOrderStarCount);
                    }else{
                        $roundAvgProduct=0;
                    }
                ?>
                <div class="review_result_area reviewSizeComment" style="display:none">
                    <h3 class="total_review">{{$avg}} Reviews</h3>
                    <div class="reviews " id="size" style="display:block !important">
                        @foreach($reviewSize as $data)
                        <div class="review">
                            <div class="review_header">
                                <div class="review_image">
                                    <img src="{{ asset('public/no_image.png') }}" alt="" style="width:80px">
                                </div>
                                <div class="review_bio">
                                    <p class="name"> <strong>{{$data['user']['name']??"No Name"}}</strong></p>
                                    <ul class="stars">
                                        <?php
                                            $star=1;
                                            while ($star <= $roundAvgProduct) {?>
                                            <li><i style="color:#b17714ab;" class="fa fa-star"></i></li>
                                            <?php $star++;
                                        }?>
                                    </ul>
                                </div>
                                <div class="review_date ms-auto">
                                    <p>{{$data->created_at}}</p>
                                </div>
                            </div>
                            <div class="review_body">
                                <p class="review_message">{{$data['size_review']}}</p>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    </main>
    
    <!-- ================== Size Guide Modal Start ================== -->
<div class="modal fade" id="sizeguidemodal" tabindex="-1" aria-labelledby="sizeguidemodalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg  modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="sizeguidemodalLabel">Size Guide</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <h2 class="title">{{$productDetails['product_mode']}}</h2>
          <p class="con">Designed for the perfect fit. Use the size chart to find your new wardrobe stable.</p>
          <table class="table  table-hover table-responsive">
            <thead>
                <tr class="table-active">
                    <th>Length Size</th>
                    <th>Chest (in)</th>
                    <th>Waist (in)</th>
                </tr>
            </thead>
            <tbody>
                @foreach($productDetails['attributes'] as $attribute)
                <tr>
                    <td>{{$attribute['length']}}</td>
                    <td>{{$attribute['chest']}}</td>
                    <td>{{$attribute['waist']}}</td>
                </tr>
                @endforeach
            </tbody>
          </table>
          <img src="{{asset($productDetails['image_two'])}}" class="mb-5 mt-5 " alt="Image">
        </div>        
      </div>
    </div>
  </div>
<!-- ================== Size Guide Modal End ================== -->
<script src="{{asset('public/frontend/assets/js/venobox.min.js')}}"></script>

   <script type="text/javascript">
           //=====add to cart button====//
            
        $(document).ready(function(){
            $('.staple-colors .staple-radio-buttons li').click(function(e){
                e.preventDefault();
                var color=$(this).data('staple-color');
                var product_id = $(this).data('product-id');
                //alert(product_id);
                $.ajax({
                   headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                   url: "{{  url('product-image-change') }}",
                   data:{color:color,product_id:product_id,},
                   type:'post',
                   success:function(resp){
                       $('#uploaded_image').html(resp.uploaded_image);
                   },error:function(status){
                       alert(status);
                   }
                });
            });
        });
    </script>
    
 <script type="text/javascript">
        $(document).ready(function() {
           $(".product_size ul.size li").on('click', function(){
               //alert('ok')
           var weight_size = $(this).data('size-id');
           //alert(weight_size)
            if(weight_size==""){
               alert("Please select Size");
               return false;
           }
           var product_id = $('.product_id').val();
           $.ajax({
               headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
               url: "{{  url('get-product-size-post') }}",
               data:{weight_size:weight_size,product_id:product_id,},
               type:'post',
               success:function(resp){
                   if(resp['discount']>0){
                      $(".getAttrSize").html("<del>$."+resp['selling_price']+"</del> $."+resp['final_price']);
                      $(".getTotal").html("$."+resp['discount']);
                   }else{
                       $(".getAttrSize").html("$."+resp['selling_price']);
                   }

               },error:function(){
                   alert("Error");
               }
           });
       });
     });
    </script>

    <script>
        $(document).ready(function(){
           $('.plus-class').click(function(e){
             e.preventDefault();
               var incre=$('.qty-class').val();
               var value=parseInt(incre,10);
               //alert(value)
               value=isNaN(value)?0:value;
               if(value<10){
                   value++;
                   $('.qty-class').val(value);
               }
           });

           $('.minus-class').click(function(e){
            e.preventDefault();
              var dcre=$('.qty-class').val();
              var value=parseInt(dcre,10);
              value=isNaN(value)?0:value;
              if(value>1){
                  value--;
                  $('.qty-class').val(value);
              }
          });

        });
    </script>
   <script>
        $(document).ready(function(){
            $('.venobox').venobox(); 
         });
   </script>
@endsection


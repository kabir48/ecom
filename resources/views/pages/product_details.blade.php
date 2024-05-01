@extends('layouts.app')
@section('content')


<style>
    .xs.available{
        display: contents;
    }
    tbody tr td:last-child{
        display:;
    }
    tbody tr td:nth-child(3){
        display:none;
    }
    tbody tr td:nth-child(4){
        display:none;
    }
    .spr-review-content {
    /* margin: 0; */
    margin-left: 15px !important;
}
.reviewLink .svg-inline--fa {
     color: #fbe75b;
     font-size: 12px;
}
.spr-review-header-byline {
    margin-bottom: 23px;
}
</style>
  
    <div id="page-content">  
     <?php
        use App\ProductFilter;
        use App\Product;
        $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$productDetails['id'])->where('status',1)->get();
        $productFilters=ProductFilter::productFilters();
        
        // ======Currency=====with===== ip====//
            $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
            $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
            $discounted_price=App\Product::getProductdiscount($productDetails['id']);
            if($getIp->country !='Bangladesh'){
                if($currencieCount>0){
                    $amount= $currencies->exchange_rate;
                    $selling_price=$productDetails['selling_price'] * $amount;
                    $discounte=$discounted_price * $amount;
                }else{
                   $selling_price=$productDetails['selling_price'];
                   $discounte=$discounted_price ;
                }
            }else{
                $selling_price=$productDetails['selling_price'];
               // dd($selling_price);
                $discounte=$discounted_price ;
            }
        
        //===rating part====//
        
        $getMostPopular=App\ProductRating::with('product')->where('product_id',$productDetails['id'])->get();
        $getOrderDetailStarCount=$getMostPopular->count();
        $sumRating=$getMostPopular->sum('rating');
        if($getOrderDetailStarCount>0){
            $avg=round($sumRating/$getOrderDetailStarCount,2);
            $roundAvg=round($sumRating/$getOrderDetailStarCount);
        }else{
            $roundAvg=0;
        }
        
        //===stock check===//
        $productSizes =App\AttributeProduct::select('weight_size')->where('product_id',$productDetails['id'])->where('status',1)->where('stock','>',0)->get();
        $stock=$productSizes->sum('stock');
    ?>
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{url('/')}}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>{{$productDetails['product_name']}}</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
            <div class="row">
                <div class="col-lg-9 col-md-9 col-sm-12 col-12">
                    <div class="product-detail-container product-single-style1">
                        <div class="product-single">
                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 ">
                                        <div class="product-details-img product-horizontal-style">
                                            <div class="zoompro-wrap product-zoom-right pl-20">
                                                <div class="zoompro-span">
                                                    <img id="zoompro" class="zoompro prlightbox" src="{{asset($productDetails['image_one'])}}" data-zoom-image="{{asset($productDetails['image_one'])}}" alt="{{$productDetails['product_name']}}" />
                                                </div>
                                                @if($productDetails['discount_price'])
                                                <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                                @else
                                                <div class="product-labels"><span class="lbl pr-label1">new</span></div>
                                                @endif
                                                <div class="product-buttons">
                                                    @if($productDetails['youtube_link'])
                                                    <a target="_blank" href="{{$productDetails['youtube_link']}}" class="mfpbox mfp-with-anim btn popup-video" title="View Video">
                                                        <i class="fa fa-video-camera" aria-hidden="true"></i>
                                                        <span class="tooltip-label">Watch Video</span>
                                                    </a>
                                                    @endif
                                                    <a href="javascript:void(0)" class="btn prlightbox" title="Zoom">
                                                        <i class="fa fa-plus" aria-hidden="true"></i>
                                                        <span class="tooltip-label">Zoom Image</span>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="product-thumb product-horizontal-thumb">
                                                <div id="gallery" class="product-thumb-style1">
                                                    @if(count($attributeImages)>0)
                                                    @foreach($attributeImages as $key=>$image)
                                                    <a data-image="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" data-zoom-image="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" class="slick-slide slick-cloned" data-slick-index="-{{$key}}" aria-hidden="true" tabindex="-1">
                                                        <img class="blur-up lazyload" data-src="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" src="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" alt="{{$image['product']['product_name']}}" />
                                                    </a>
                                                    @endforeach
                                                    @else
                                                    <a data-image="{{asset($productDetails['image_one'])}}" data-zoom-image="{{asset($productDetails['image_one'])}}" class="slick-slide slick-cloned" data-slick-index="-1" aria-hidden="true" tabindex="-1">
                                                        <img class="blur-up lazyload" data-src="{{asset($productDetails['image_one'])}}" src="{{asset($productDetails['image_one'])}}" alt="" />
                                                    </a>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="lightboximages">
                                                @if(count($attributeImages)>0)
                                                 @foreach($attributeImages as $key=>$image)
                                                <a href="{{asset('public/media/product/multiple/large/'.$image['product_image'])}}" data-size="1000x1280"></a>
                                                @endforeach
                                                @else
                                                <a href="{{asset($productDetails['image_one'])}}" data-size="1000x1280"></a>
                                                @endif
                                              
                                            </div>
                                        </div>
                                    </div>
                                <div class="col-lg-6 col-md-6 col-sm-12 col-12 quick_product_data">
                                    <div class="product-single__meta">
                                        <h1 class="product-single__title">{{$productDetails['product_name']}}</h1>
                                        <div class="prInfoRow">
                                            <div class="product-review">
                                                <a class="reviewLink" href="#tab2">
                                                    <?php
                                                        $star=1;
                                                        while ($star <= 5) {?>
                                                        <i class="font-13 fa fa-star"></i>
                                                        <?php $star++;
                                                    }?>
                                                <span class="spr-badge-caption">({{$roundAvg}}) reviews</span>
                                                </a>
                                            </div>
                                            <div class="product-sku">Product Code: <span class="variant-sku">{{$productDetails['product_code']}}</span></div>
                                            <div class="product-stock"> @if($stock>0 || $productDetails['product_quantity']>0)<span class="instock">In Stock</span>@else <span class="outstock hide">Unavailable</span>@endif </div>
                                        </div>
                                        <p class="product-single__price product-single__price-product-template">
                                          
                                            <span class="visually-hidden">Regular price</span>
                                            @if($discounted_price>0)
                                            <s id="ComparePrice-product-template"><span class="money moneyTwo">{{$getIp->currency}} {{$selling_price}}</span></s>
                                            
                                            <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                                <span id="ProductPrice-product-template"><span class="money getAttrSize">{{$getIp->currency}} {{$discounte}}</span></span>
                                            </span>
                                            @else
                                             <span id="ComparePrice-product-template"><span class="money getAttrSize">{{$getIp->currency}} {{$selling_price}}</span></s>
                                            @endif
                                            @if($discounted_price>0)
                                            <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                                <span>You Save</span>
                                                <span class="product-single__save-amount"><span class="money">{{$getIp->currency}} <?php echo $selling_price - $discounted_price; ?></span></span>
                                                <span class="off">(<span>{{$productDetails['discount_price']}}</span>%)</span>
                                            </span>  
                                            @endif
                                        </p>
                                    </div>
                                    <?php
                                        $aboutId=explode(',',$productDetails['about_product_id']);
                                        
                                        $abouts=App\AboutProduct::where('status',1)->whereIn('id',$aboutId)->get()->toArray();
                                        $sectionId=App\Section::find($productDetails['section_id']);
                                        $get=App\Product::where('product_mode','!=',$productDetails['product_mode'])->where('category_id','!=',$productDetails['category_id'])->where('section_id',$productDetails['section_id'])->where('status',1)->get();
                                        //dd($get);die;
                                    ?>
                                    <div class="product-single__description rte">
                                     <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                            <div class="product-form__item">
                                              <div data-value="XS" class=" xs available">
                                                @if(count($abouts)>0)
                                                @foreach($abouts as $key=>$about) 
                                                <label class="swatchLbl medium" style="background: #3051d{{$key+1}};padding: 10px 5px;border-radius: 10px;color: white;" for="swatch-1-xs" title="XS">{{$about['title']}}</label>
                                                @endforeach
                                                @endif
                                              </div>
                                            </div>
                                        </div>
                                     
                                    </div>
                                    <form class="product-form product-form-product-template hidedropdown">
                                        <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                            <div class="product-form__item">
                                              <label class="label">Size:<span class="required">*</span> <span class="slVariant" id="slVariant">XS</span> <a href="#sizechart" class="sizelink btn-link"><i class="fa-solid fa-ruler"></i> Size Guide</a></label>
                                                @foreach($productSizes as  $key=>$size)
                                                  <div data-value="XS" class="xs available">
                                                    @if($size->sum('stock') > 0)
                                                    <input class="swatchInput getSize" id="swatch-1-{{$size->weight_size}}" onclick="sizeProduct()" productsize-id="{{$productDetails['id']}}" type="radio" name="w_size" value="{{$size->weight_size}}">
                                                    <label class="swatchLbl medium" for="swatch-1-{{$size->weight_size}}" title="{{$size->weight_size}}">{{$size->weight_size}}</label>
                                                    @else
                                                    <input class="swatchInput" id="swatch-1-{{$size->weight_size}}" type="radio" name="w-size" value="{{$size->weight_size}}" disabled>
                                                    <label class="swatchLbl medium" for="swatch-1-{{$size->weight_size}}" title="{{$size->weight_size}}">{{$size->weight_size}}</label>
                                                    @endif
                                                  </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <p class="infolinks">
                                            <a class="wishlist add-to-wishlist" href="javascript:void(0)" title="Add to Wishlist"><i class="fa fa-heart" aria-hidden="true"></i> <span>Add to Wishlist</span></a>
                                            @guest
                                            <a href="{{url('user/login-registers')}}" target="_blank">Do You Have Question <i class="fa fa-question" aria-hidden="true"></i></a>
                                            @else
                                            <a href="#ShippingInfo" class="mfp btn shippingInfo"><i class="fa fa-question" aria-hidden="true"></i> Enquiry Product</a>
                                            @endguest
                                        </p>
                                        <!-- Product Action -->
                                        <div class="product-action clearfix">
                                            <div class="product-form__item--quantity">
                                                <div class="wrapQtyBtn">
                                                    <div class="qtyField">
                                                        <a class="qtyBtn minus minus-class" href="javascript:void(0);"><i class="fa fa-minus" aria-hidden="true"></i></a>
                										<input type="text" name="quantity" value="1" class="product-form__input qty qty-class qty_cart">
                										<a class="qtyBtn plus plus-class" href="javascript:void(0);"><i class="fa fa-plus" aria-hidden="true"></i></a>
                                                    </div>
                                                </div>
                                            </div>                                
                                           
                                            <input type="hidden" value="{{$productDetails['id']}}" class="product_id_cart">
                							<div class="product-form__item--submit">
                								<button type="button" class="btn product-form__cart-submit addToCartProduct">
                									<span>Add to cart</span>
                								</button>
                							</div>
                                           
                                        </div>
                                        <!-- End Product Action -->
                                    </form>
                                     <?php
                                        $aboutTrigger=DB::table('announcements')->where('trigger','detail')->where('status',1)->first();
                                    ?>
                                    <p id="freeShipMsg" class="freeShipMsg"><i class="fa fa-truck" aria-hidden="true"></i>{!!$aboutTrigger->note!!}</p>
                                    <p class="shippingMsg"><i class="fa fa-clock" aria-hidden="true"></i> Estimated Delivery Between <b id="fromDate">{{\Carbon\Carbon::now()->addDays(6)->format('Y-M-d')}}</b>.</p>
                                    <div class="userViewMsg" data-user="20" data-time="11000">
                                        <i class="fa fa-users" aria-hidden="true"></i> <strong class="uersView"><?php $most_populars=DB::table('most_populars')->where('product_id',$productDetails['id'])->count(); echo $most_populars; ?></strong> People are Looking for this Product
                                    </div>
                                    <div class="social-sharing">
                                        <span>Ship to <i class="fa fa-hand" aria-hidden="true" onclick="handClick()"></i></span>
                                        <form action="#" method="post" class="row" id="formHidden" style="display:none">
                                            <input type="serach" id="zipCode" class="col-8 zipcode" placeholder="zip code" required>
                                            <button type="button" id="checkPinCode" class="col-4 submit">Verify</button>
                                        </form>
                                        <span id="zipCodeStatus" style="margin-top:10px"></span>
                                    </div>
                                  
                                    <div class="type-product">
                                        <span>Type:</span> <a href="{{url('category-products/'.$productDetails['category']['category_name'])}}">{{$productDetails['category']['category_name']}}</a>
                                    </div>
                                    <div class="category-products-list">
                                        <span>Category:</span> <a href="{{url('category-products/'.$productDetails['category']['category_name'])}}">{{$productDetails['category']['category_name']}}</a>, <a href="{{url('section-products/'.$productDetails['section']['name'])}}">{{$productDetails['section']['name']}}</a> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Product Tabs-->
                    <div class="tabs-listing tab-accordian-style">
                        <div class="tab-container">
                             <h3 class="acor-ttl active" rel="tab1">Product Details</h3>
                             <div id="tab1" class="tab-content">
                                 <div class="product-description rte">
                                     <div class="row">
                                         <div class="col-12 col-sm-6 col-md-8 col-lg-8 mb-4">
                                            <h3>Product Details</h3>
                                            <p>{!!$productDetails['product_details']!!}</p>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                             <h3 class="acor-ttl" rel="tab2">All Answer For This Product </h3>
                             <div id="tab2" class="tab-content">
                                 <div class="row">
                                     <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                         <div class="spr-reviews">
                                             <h3 class="spr-form-title">Question And Answer For {{$productDetails['product_name']}}</h3>
                                             <div class="review-inner">
                                             <div class="spr-review">
                                                    <?php
                                                    $id=$productDetails['id'];
                                                    $userComment=App\ProductComment::where('status',1)->where('product_id',$id)->get();
                                                    //dd($userComment);die;
                                                    ?>
                                                @if(empty($userComment['comment']))
                                                @foreach($userComment as $row)
                                                 <div class="spr-review-header">
                                                     <h3 class="spr-review-header-title">{{$row['users']['name']}}</h3>
                                                     <span class="spr-review-header-byline"><strong style="padding-left:25px;color:blue;font-weight:15px"><i class="fa-solid fa-comment"></i>  {{$row['comment']}}</strong>  ({{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}}) <strong></strong></span>
                                                 </div>
                                               
                                                 <?php
                                                 $id=$row['id'];
                                                 $replayCount=App\ProductReplay::where('status',1)->where('comment_id',$id)->get();
                                                 //dd($replayCount);die;
                                                ?>
                                                @foreach($replayCount as $data)
                    
                                                 <div class="spr-review-header">
                                                    <h3 class="spr-review-header-title">{{$data['admins']['name']??"No Name"}}</h3>
                                                    <span class="spr-review-header-byline"><strong style="padding-left:25px;color:green;font-weight:15px"><i class="fa-regular fa-comment-dots"></i> {!!$data['comment_replay']??"Yet,To Replay"!!}</strong>  ({{Carbon\Carbon::parse($data['created_at'])->diffForHumans()}})<strong></strong></span>
                                                </div>
                                                
                                                 @endforeach
                                                 @endforeach
                                                 @else
                    					         @endif
                                             </div>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                    
                            <h3 class="acor-ttl" rel="tab3">Product Reviews</h3>
                            <div id="tab3" class="tab-content">
                            <div class="row">
                                <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                    <div class="spr-reviews">
                                        <h3 class="spr-form-title">Customer Reviews</h3>
                                        <div class="review-inner">
                                        <div class="spr-review">
                                            @foreach($reviewSize as $row)
                                            <div class="spr-review-header">
                                                <span class="product-review spr-starratings spr-review-header-starratings"><span class="reviewLink">
                                                    <?php
                                                        $star=1;
                                                        while ($star <= $row['rating']) {?>
                                                        <i class="font-13 fa fa-star" style="color:#CBA461 !important"></i>
                                                        <?php $star++;
                                                    }?>
                                            </div>
                                            <div class="spr-review-content">
                                                <p class="spr-review-content-body"><i class="fa fa-commenting" aria-hidden="true"></i> {{$row['review']}}</p>
                                            </div>
                                            <span class="spr-review-header-byline"><strong style="font-size:15px;font-weight:600">Color: </strong> {{$row['color_review']}}&nbsp;
                                            (<?php
                                                $star=1;
                                                while ($star <= $row['color_rating']) {?>
                                                <i class="font-13 fa fa-star" style="color:#CBA461 !important"></i>
                                                <?php $star++;
                                            }?>)
                                            </span>
                                            <span class="spr-review-header-byline"><strong style="font-size:15px;font-weight:600">Size: </strong> {{$row['size_review']}}&nbsp;
                                            (<?php
                                                $star=1;
                                                while ($star <= $row['size_rating']) {?>
                                                <i class="font-13 fa fa-star" style="color:#CBA461 !important"></i>
                                                <?php $star++;
                                            }?>)
                                            </span>
                                            <h3 class="spr-review-header-title">{{$row['user']['name']??"No Name"}} &nbsp; ({{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}})</h3>
                                            @endforeach
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <h3 class="acor-ttl" rel="tab4">Product Type</h3>
                            <div id="tab4" class="tab-content">
                            <h3> {{ $productDetails['product_name'] }}</h3>
                            <table>
                            <tbody>
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
                            @if($productDetails['video_link'])
                            <h3 class="acor-ttl" rel="tab5">Product Video</h3>
                            <div id="tab5" class="tab-content">
                                <div class="row">
                                    <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                        <div class="spr-reviews">
                                            <video controls id="videoMy" style="width: 100%; height: auto; margin:0 auto; frameborder:0;">
                                                <source src="{{asset('public/video/product/'.$productDetails['video_link'])}}" type="video/mp4">
                                            </video>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <!--End Product Tabs-->
                </div>
                <!--Sidebar-->
                <div class="col-lg-3 col-md-3 col-sm-12 col-12 sidebar">
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>You May Like This</h2></div>
                        <div class="widget-content">
                            <?php
                             $sectionId=App\Section::find($productDetails['section_id']);
                             $getOTherProducts=App\Product::where('product_mode','!=',$productDetails['product_mode'])->where('category_id','!=',$productDetails['category_id'])->where('section_id',$productDetails['section_id'])->where('status',1)->get();
                            
                            ?>
                            <div class="list list-sidebar-products">
                                <div class="grid">
                                    @foreach($getOTherProducts as $data)
                                    <?php
                                     //====Ip Block====//
            
                                        $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                        $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                        $discounted_price=App\Product::getProductdiscount($data['id']);
                                        if($getIp->country !='Bangladesh'){
                                            if($currencieCount>0){
                                                $amount= $currencies->exchange_rate;
                                                $selling_price=$data['selling_price'] * $amount;
                                                $discounte=$discounted_price * $amount;
                                            }else{
                                               $selling_price=$data['selling_price'];
                                               $discounte=$discounted_price ;
                                            }
                                        }else{
                                            $selling_price=$data['selling_price'];
                                           // dd($selling_price);
                                            $discounte=$discounted_price ;
                                        }
                                        
                                        
                                         $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
                                            $getOrderDetailStarCount=$getMostPopular->count();
                                            $sumRating=$getMostPopular->sum('rating');
                                            if($getOrderDetailStarCount>0){
                                                $avg=round($sumRating/$getOrderDetailStarCount,2);
                                                $roundAvg=round($sumRating/$getOrderDetailStarCount);
                                            }else{
                                                $roundAvg=0;
                                            }
                                            
                                            $name=preg_replace('/\s+/', '', $data['product_name']);
                                                                    
                                    ?>
                                    <div class="grid__item">
                                      <div class="mini-list-item">
                                        <div class="mini-view_image">
                                            <a class="grid-view-item__link" href="{{url('product/details/'.$data['id'].'/'.$name)}}">
                                                <img class="grid-view-item__image blur-up ls-is-cached lazyloaded" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="">
                                            </a>
                                        </div>
                                        <div class="details">
                                            <a class="grid-view-item__title" href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{$data['product_name']}}</a>
                                            <div class="grid-view-item__meta">
                                                @if($discounte)
                            					<span class="price old-price">{{$getIp->currency}} {{$selling_price}}</span>
                            					<span class="price">{{$getIp->currency}} {{$discounte}}</span>
                            					@else
                            					<span class="price">{{$getIp->currency}} {{$selling_price}}</span>
                            					@endif
                                            </div>
                                            <div class="product-review">
                                                <?php
                                                    $star=1;
                                                    while ($star <= 5) {?>
                                                    <i style="color:#b17714ab;" class="fa fa-star"></i>
                                                    <?php $star++;
                                                }?>
                                            </div>
                                            <div class="reviews"><a href="#">{{$roundAvg}} Reviews</a></div>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Related Products</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                                <div class="grid">
                                    @foreach($realatedProducts as $data)
                                    <?php
                                     //====Ip Block====//
            
                                        $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                        $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                        $discounted_price=App\Product::getProductdiscount($data['id']);
                                        if($getIp->country !='Bangladesh'){
                                            if($currencieCount>0){
                                                $amount= $currencies->exchange_rate;
                                                $selling_price=$data['selling_price'] * $amount;
                                                $discounte=$discounted_price * $amount;
                                            }else{
                                               $selling_price=$data['selling_price'];
                                               $discounte=$discounted_price ;
                                            }
                                        }else{
                                            $selling_price=$data['selling_price'];
                                           // dd($selling_price);
                                            $discounte=$discounted_price ;
                                        }
                                        
                                        
                                         $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
                                            $getOrderDetailStarCount=$getMostPopular->count();
                                            $sumRating=$getMostPopular->sum('rating');
                                            if($getOrderDetailStarCount>0){
                                                $avg=round($sumRating/$getOrderDetailStarCount,2);
                                                $roundAvg=round($sumRating/$getOrderDetailStarCount);
                                            }else{
                                                $roundAvg=0;
                                            }
                                            
                                            $name=preg_replace('/\s+/', '', $data['product_name']);
                                                                    
                                    ?>
                                    <div class="grid__item">
                                      <div class="mini-list-item">
                                        <div class="mini-view_image">
                                            <a class="grid-view-item__link" href="{{url('product/details/'.$data['id'].'/'.$name)}}">
                                                <img class="grid-view-item__image blur-up ls-is-cached lazyloaded" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="">
                                            </a>
                                        </div>
                                        <div class="details">
                                            <a class="grid-view-item__title" href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{$data['product_name']}}</a>
                                            <div class="grid-view-item__meta">
                                                @if($discounte)
                            					<span class="price old-price">{{$getIp->currency}} {{$selling_price}}</span>
                            					<span class="price">{{$getIp->currency}} {{$discounte}}</span>
                            					@else
                            					<span class="price">{{$getIp->currency}} {{$selling_price}}</span>
                            					@endif
                                            </div>
                                            <div class="product-review">
                                                <?php
                                                    $star=1;
                                                    while ($star <= 5) {?>
                                                    <i style="color:#b17714ab;" class="fa fa-star"></i>
                                                    <?php $star++;
                                                }?>
                                            </div>
                                            <div class="reviews"><a href="#">{{$roundAvg}} Reviews</a></div>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="sidebar_widget">
                        <div class="widget-title"><h2>Recently Viewd Products</h2></div>
                        <div class="widget-content">
                            <div class="list list-sidebar-products">
                                <div class="grid">
                                    @foreach($recentlyProducts as $data)
                                     <?php
                                     //====Ip Block====//
            
                                        $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                        $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                        $discounted_price=App\Product::getProductdiscount($data['id']);
                                        if($getIp->country !='Bangladesh'){
                                            if($currencieCount>0){
                                                $amount= $currencies->exchange_rate;
                                                $selling_price=$data['selling_price'] * $amount;
                                                $discounte=$discounted_price * $amount;
                                            }else{
                                               $selling_price=$data['selling_price'];
                                               $discounte=$discounted_price ;
                                            }
                                        }else{
                                            $selling_price=$data['selling_price'];
                                           // dd($selling_price);
                                            $discounte=$discounted_price ;
                                        }
                                        
                                        
                                         $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
                                            $getOrderDetailStarCount=$getMostPopular->count();
                                            $sumRating=$getMostPopular->sum('rating');
                                            if($getOrderDetailStarCount>0){
                                                $avg=round($sumRating/$getOrderDetailStarCount,2);
                                                $roundAvg=round($sumRating/$getOrderDetailStarCount);
                                            }else{
                                                $roundAvg=0;
                                            }
                                            
                                            $name=preg_replace('/\s+/', '', $data['product_name']);
                                                                    
                                    ?>
                                    <div class="grid__item">
                                      <div class="mini-list-item">
                                        <div class="mini-view_image">
                                            <a class="grid-view-item__link" href="{{url('product/details/'.$data['id'].'/'.$name)}}">
                                                <img class="grid-view-item__image blur-up ls-is-cached lazyloaded" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="">
                                            </a>
                                        </div>
                                        <div class="details">
                                            <a class="grid-view-item__title" href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{$data['product_name']}}</a>
                                            <div class="grid-view-item__meta">
                                                @if($discounte)
                            					<span class="price old-price">{{$getIp->currency}} {{$selling_price}}</span>
                            					<span class="price">{{$getIp->currency}} {{$discounte}}</span>
                            					@else
                            					<span class="price">{{$getIp->currency}} {{$selling_price}}</span>
                            					@endif
                                            </div>
                                            <div class="product-review">
                                                <?php
                                                    $star=1;
                                                    while ($star <= 5) {?>
                                                    <i style="color:#b17714ab;" class="fa fa-star"></i>
                                                    <?php $star++;
                                                }?>
                                            </div>
                                            <div class="reviews"><a href="#">{{$roundAvg}} Reviews</a></div>
                                        </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--End Sidebar-->
            </div>
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->
    

    
  
   
    <!-- Shipping Popup-->
    <div id="ShippingInfo" class="mfpbox mfp-with-anim mfp-hide">
        <h5>Please Ask Relevent Question About This Products</h5>
        <form method="post" action="{{url('/check-user-post-comment-for-products')}}" id="new-review-form" class="new-review-form">
        @csrf
        <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
         <h3 class="spr-form-title">Questions About This Product </h3>
         <fieldset class="spr-form-review">
           <div class="spr-form-review-body">
             <label class="spr-form-label" for="message">Body of Question</label>
             <div class="spr-form-input">
               <textarea class="spr-form-input spr-form-input-textarea " id="message" name="comment" rows="5"></textarea>
             </div>
           </div>
         </fieldset>
         <div class="spr-form-actions">
             <input type="submit" class="spr-button spr-button-primary button button-primary btn btn-primary" value="Submit Qusetion">
         </div>
     </form>
    </div>

    <!--Size Chart-->
    <div id="sizechart" class="mfpbox mfp-with-anim mfp-hide">
        <h4>{{$productDetails['product_name']}}</h4>
        <p><strong>Ready to Wear Clothing With Accurate Size</strong></p>
        <table>
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
        <button title="Close (Esc)" type="button" class="mfp-close">×</button>
    </div>
    <!--End Size Chart-->
    
    
    <div class="pswp" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="pswp__bg"></div>
        <div class="pswp__scroll-wrap">
            <div class="pswp__container">
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
                <div class="pswp__item"></div>
            </div>
        <div class="pswp__ui pswp__ui--hidden">
            <div class="pswp__top-bar">
                <div class="pswp__counter"></div>
                <button class="pswp__button pswp__button--close" title="Close (Esc)"></button>
                <button class="pswp__button pswp__button--share" title="Share"></button>
                <button class="pswp__button pswp__button--fs" title="Toggle fullscreen"></button>
                <button class="pswp__button pswp__button--zoom" title="Zoom in/out"></button>
                <div class="pswp__preloader">
                    <div class="pswp__preloader__icn">
                        <div class="pswp__preloader__cut">
                            <div class="pswp__preloader__donut"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pswp__share-modal pswp__share-modal--hidden pswp__single-tap">
                <div class="pswp__share-tooltip"></div>
            </div>
            <button class="pswp__button pswp__button--arrow--left" title="Previous (arrow left)"></button>
            <button class="pswp__button pswp__button--arrow--right" title="Next (arrow right)"></button>
            <div class="pswp__caption"><div class="pswp__caption__center"></div></div>
        </div>
     </div>
     </div>

        
    <script src="{{url('public/frontend/assets/js/vendor/photoswipe.min.js')}}"></script>
    <script type="text/javascript">
     $(document).ready(function() {
    	$(".getSize").on('click', function(){
		var weight_size = $(this).val();
        		if(weight_size==""){
			alert("Please select Size");
			return false;
		}
        var product_id =$(this).attr("productsize-id");
		$.ajax({
			url: "{{  url('get-product-size-post') }}",
			data:{weight_size:weight_size,product_id:product_id,},
			type:'post',
			success:function(resp){
                if(resp['discount']>0){
                   $(".getAttrSize").html("<del>{{$getIp->currency}}."+resp['selling_price']+"</del> {{$getIp->currency}}."+resp['final_price']);
                   $(".moneyTwo").hide();
                }else{
                    $(".getAttrSize").html("{{$getIp->currency}}."+resp['selling_price']);
                }

			},error:function(){
				alert("Error");
			}
		});
	});
	});
    </script>  
    <script>
        function handClick(){
            $('#formHidden').toggle(); // Toggle the visibility of the element
        }
    </script> 
    <script>
        $(function(){
            var $pswp = $('.pswp')[0],
                image = [],
                getItems = function() {
                    var items = [];
                    $('.lightboximages a').each(function() {
                        var $href   = $(this).attr('href'),
                            $size   = $(this).data('size').split('x'),
                            item = {
                                src : $href,
                                w: $size[0],
                                h: $size[1]
                            }
                            items.push(item);
                    });
                    return items;
                }
            var items = getItems();
        
            $.each(items, function(index, value) {
                image[index]     = new Image();
                image[index].src = value['src'];
            });
            $('.prlightbox').on('click', function (event) {
                event.preventDefault();
              
                var $index = $(".active-thumb").parent().attr('data-slick-index');
                $index++;
                $index = $index-1;
        
                var options = {
                    index: $index,
                    bgOpacity: 0.9,
                    showHideOpacity: true
                }
                var lightBox = new PhotoSwipe($pswp, PhotoSwipeUI_Default, items, options);
                lightBox.init();
            });
        });
        </script>
    <script>
		   function sizeProduct() {
              // Get all radio buttons with class 'swatchInput'
              var radioButtons = document.getElementsByClassName('swatchInput');
              //console.log(radioButtons)
              var slVariant=document.getElementById("slVariant")
            
              // Loop through radio buttons to find the selected one
              for (var i = 0; i < radioButtons.length; i++) {
                if (radioButtons[i].checked) {
                  // Get the value of the selected radio button
                  var selectedValue = radioButtons[i].value;
                  //alert(selectedValue)
                  slVariant.innerHTML=selectedValue
                  // Do something with the selected value
                  //console.log("Selected value: " + selectedValue);
                  break; // Exit the loop once a selected radio button is found
                }
              }
            }

		</script>     
  @endsection
  
    
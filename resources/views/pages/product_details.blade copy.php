@extends('layouts.app')
@section('content')
<?php
use App\Product;
?>

<div id="page-content">
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{ url('/') }}" title="Back to the home page">
                    @if(session()->get('lang') == 'english')Home
                    @elseif (session()->get('lang') == 'germany')
                    Heimat
                    @elseif (session()->get('lang') == 'spanish')
                    casa
                    @elseif (session()->get('lang') == 'french')
                    domicile
                    @elseif (session()->get('lang') == 'arabic')
                    الصفحة الرئيسية
                    @elseif (session()->get('lang') == 'japanese')
                    家
                    @else
                    Home
                    @endif
                </a> <span aria-hidden="true">|</span> <span>
                    @if(session()->get('lang') == 'english'){{$productDetails['product_name']}}
                    @elseif (session()->get('lang') == 'germany')
                    {{$productDetails['product_name_germany']}}
                    @elseif (session()->get('lang') == 'spanish')
                    {{$productDetails['product_name_spanish']}}
                    @elseif (session()->get('lang') == 'french')
                    {{$productDetails['product_name_french']}}
                    @elseif (session()->get('lang') == 'arabic')
                    {{$productDetails['product_name_arabic']}}
                    @elseif (session()->get('lang') == 'japanese')
                    {{$data['product_name_japanese']}}
                    @else
                    {{ $productDetails['product_name'] }}
                    @endif
                    </span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
            <div class="product-detail-container product-single-style1">
				<div class="product-single">
					<div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product-details-img product-horizontal-style">
                                <div class="zoompro-wrap product-zoom-right pl-20">
                                    <div class="zoompro-span">
                                        <img id="zoompro" class="zoompro prlightbox" src="{{asset($productDetails['image_three'])}}" data-zoom-image="{{asset($productDetails['image_three'])}}" alt="" />
                                    </div>
                                    <div class="product-buttons">
                                        <a href="#" class="btn prlightbox" title="Zoom">
                                            <i class="icon anm anm-expand-l-arrows" aria-hidden="true"></i>
                                            <span class="tooltip-label">Zoom Image</span>
                                        </a>
                                    </div>
                                </div>
                                <div class="product-thumb product-horizontal-thumb">
                                    <div id="gallery" class="product-thumb-style1">
                                        <a data-image="{{asset($productDetails['image_three'])}}" data-zoom-image="{{asset($productDetails['image_three'])}}" class="slick-slide slick-cloned" data-slick-index="-4" aria-hidden="true" tabindex="-1">
                                            <img class="blur-up lazyload" data-src="{{asset($productDetails['image_three'])}}" src="{{asset($productDetails['image_three'])}}" alt="" />
                                        </a>
                                        <a data-image="{{asset($productDetails['image_four'])}}" data-zoom-image="{{asset($productDetails['image_four'])}}" class="slick-slide slick-cloned" data-slick-index="-3" aria-hidden="true" tabindex="-1">
                                            <img class="blur-up lazyload" data-src="{{asset($productDetails['image_four'])}}" src="{{asset($productDetails['image_four'])}}" alt="" />
                                        </a>
                                        <a data-image="{{asset($productDetails['image_five'])}}" data-zoom-image="{{asset($productDetails['image_five'])}}" class="slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1">
                                            <img class="blur-up lazyload" data-src="{{asset($productDetails['image_five'])}}" src="{{asset($productDetails['image_five'])}}" alt="" />
                                        </a>
                                        <a data-image="{{asset($productDetails['image_six'])}}" data-zoom-image="{{asset($productDetails['image_six'])}}" class="slick-slide slick-cloned" data-slick-index="-2" aria-hidden="true" tabindex="-1">
                                            <img class="blur-up lazyload" data-src="{{asset($productDetails['image_six'])}}" src="{{asset($productDetails['image_six'])}}" alt="" />
                                        </a>

                                    </div>
                                </div>
                                <div class="lightboximages">
                                    <a href="{{asset($productDetails['image_three'])}}" data-size="1000x1280"></a>
                                    <a href="{{asset($productDetails['image_four'])}}" data-size="1000x1280"></a>
                                    <a href="{{asset($productDetails['image_five'])}}" data-size="1000x1280"></a>
                                    <a href="{{asset($productDetails['image_six'])}}" data-size="1000x1280"></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            <div class="product-single__meta">
                                <h1 class="product-single__title">
                                    @if(session()->get('lang') == 'english'){{$productDetails['product_name']}}
                                    @elseif (session()->get('lang') == 'germany')
                                    {{$productDetails['product_name_germany']}}
                                    @elseif (session()->get('lang') == 'spanish')
                                    {{$productDetails['product_name_spanish']}}
                                    @elseif (session()->get('lang') == 'french')
                                    {{$productDetails['product_name_french']}}
                                    @elseif (session()->get('lang') == 'arabic')
                                    {{$productDetails['product_name_arabic']}}
                                    @elseif (session()->get('lang') == 'japanese')
                                    {{$data['product_name_japanese']}}
                                    @else
                                    {{ $productDetails['product_name'] }}
                                    @endif
                                </h1>
                                <div class="prInfoRow">

                                    <div class="product-sku">Product Code: <span class="variant-sku"></span></div>
                                    <div class="product-stock"> <span class="instock ">In-stock </div>
                                </div>
                                <p class="product-single__price product-single__price-product-template">
                                    <span class="visually-hidden">Regular price</span>
                                    <?php
                                     $discounted_price=Product::getProductdiscount($productDetails['id']);

                                     $total=$productDetails['selling_price']-$discounted_price;
                                    ?>
                                    @if($discounted_price>0)
                                    <s id="ComparePrice-product-template"><span class="money">${{$productDetails['selling_price']}}</span></s>
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money">${{round($discounted_price,2)}}</span></span>
                                    </span>
                                    @else
                                    <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                        <span id="ProductPrice-product-template"><span class="money">${{$productDetails['selling_price']}}</span></span>
                                    </span>
                                    @endif
                                    @if($discounted_price>0)
                                    <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                        <span>You Save</span>
                                        <span class="product-single__save-amount"><span class="money">${{ round($total,2) }}</span></span>
                                        <span class="off">(<span>{{ $productDetails['discount_price'] }}</span>%)</span>
                                    </span>
                                    @endif
                                </p>
                            </div>
                            <div class="product-single__description rte">
                                @if(!empty($productDetails['small_detail']))
                                {{$productDetails['small_detail'] }}
                                @endif
                            </div>
                            <form method="post" action="#" class="product-form product-form-product-template hidedropdown">
                                <div class="swatch clearfix swatch-0 option1">
                                    <div class="product-form__item">
                                        <label class="label">Color:<span class="required">*</span> <span class="slVariant">Red</span></label>
                                        @foreach($product_color as $color)
                                        <div class="swatch-element color">
                                            <input class="swatchInput" id="swatch-black1" type="radio" name="option-0" value="Black">
                                            <label class="swatchLbl small {{ $color }}" for="swatch-black1" title="Black"></label>
                                        </div>
                                        @endforeach

                                    </div>
                                </div>
                                <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                    <div class="product-form__item">
                                      <label class="label">Size:<span class="required">*</span> <span class="slVariant">XS</span> <a href="#sizechart" class="sizelink btn-link"><i class="anm anm-ruler"></i> Size Guide</a></label>
                                      @foreach($product_size as $size)
                                      <div data-value="XS" class="swatch-element xs available">
                                        <input class="swatchInput" id="swatch-1-xs" type="radio" name="option-1" value="XS">
                                        <label class="swatchLbl {{ $size }}" for="swatch-1-xs" title="XS">{{ $size }}</label>
                                      </div>
                                      @endforeach
                                    </div>
                                </div>
                            </form>

                            <div class="trustseal-img"><img src="assets/images/checkout-cards.png" alt=""></div>
                            <div class="social-sharing">
                                <span class="label">Share:</span>
                                <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-facebook" title="Share on Facebook">
                                    <i class="anm anm-facebook-f" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Share</span>
                                </a>
                                <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-twitter" title="Tweet on Twitter">
                                    <i class="fa fa-twitter" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Tweet</span>
                                </a>
                                <a href="#" title="Share on google+" class="btn btn--small btn--secondary btn--share" >
                                    <i class="fa fa-google-plus" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Google+</span>
                                </a>
                                <a target="_blank" href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Pin on Pinterest">
                                    <i class="fa fa-pinterest" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Pin it</span>
                                </a>
                                <a href="#" class="btn btn--small btn--secondary btn--share share-pinterest" title="Share by Email" target="_blank">
                                    <i class="fa fa-envelope" aria-hidden="true"></i> <span class="share-title" aria-hidden="true">Email</span>
                                </a>
                             </div>
                             @if(!empty($productDetails['dress']))
                            <div class="type-product">
                                <span>Type:</span> <a>{{ $productDetails['dress'] }}</a>
                            </div>
                            @endif
                            @if(!empty($productDetails['sleeve']))
                            <div class="type-product">
                                <span>Type:</span> <a>{{ $productDetails['sleeve'] }}</a>
                            </div>
                            @endif
                            @if(!empty($productDetails['fabric']))
                            <div class="type-product">
                                <span>Type:</span> <a>{{ $productDetails['fabric'] }}</a>
                            </div>
                            @endif
                            <div class="category-products-list">
                                <span>Category:</span> <a href="#">All Products</a>, <a href="#">All Products</a>, <a href="#">Hot Collection</a>, <a href="#">New Arrivals</a>, <a href="#">Women</a>
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
                                    <h3>Specification</h3>
                                    @if(session()->get('lang') == 'english')<p>{!!$productDetails['product_details']!!}</p>
                                    @elseif (session()->get('lang') == 'germany')
                                    <p>{!!$productDetails['detail_germany']!!}</p>
                                    @elseif (session()->get('lang') == 'spanish')
                                    <p>{!!$productDetails['detail_spanish']!!}</p>
                                    @elseif (session()->get('lang') == 'french')
                                    <p>{!!$productDetails['detail_french']!!}</p>
                                    @elseif (session()->get('lang') == 'arabic')
                                    <p>{!!$productDetails['detail_arabic']!!}</p>
                                    @elseif (session()->get('lang') == 'japanese')
                                    <p>{!!$productDetails['detail_japanese']!!}</p>
                                    @else
                                    <p>{!!$productDetails['product_details']!!}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <h3 class="acor-ttl" rel="tab2">Product Reviews</h3>
                    <div id="tab2" class="tab-content">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                                <div class="spr-form clearfix">
                                    <form method="post" action="#" id="new-review-form" class="new-review-form">
                                        <h3 class="spr-form-title">Write Your Own Review</h3>
                                        <fieldset class="spr-form-contact">
                                            <div class="spr-form-review-rating">
                                                <label class="spr-form-label">How do you rate this product?<span class="required">*</span></label>
                                                <div class="spr-form-input spr-starrating">
                                                  <div class="product-review"><a class="reviewLink" href="#"><i class="fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i></a></div>
                                                </div>
                                            </div>
                                            <div class="spr-form-contact-name">
                                              <label class="spr-form-label" for="nickname">Whats your nickname?<span class="required">*</span></label>
                                              <input class="spr-form-input spr-form-input-text" id="nickname" type="text" name="nickname" value="">
                                            </div>
                                            <div class="spr-form-contact-email">
                                              <label class="spr-form-label" for="email">Email Address<span class="required">*</span></label>
                                              <input class="spr-form-input spr-form-input-email " id="email" type="email" name="email" value="">
                                            </div>
                                        </fieldset>
                                        <fieldset class="spr-form-review">
                                          <div class="spr-form-review-title">
                                            <label class="spr-form-label" for="review">Review Title</label>
                                            <input class="spr-form-input spr-form-input-text " id="review" type="text" name="review" value="">
                                          </div>

                                          <div class="spr-form-review-body">
                                            <label class="spr-form-label" for="message">Body of Review <span class="spr-form-review-body-charactersremaining">(1500) characters remaining</span></label>
                                            <div class="spr-form-input">
                                              <textarea class="spr-form-input spr-form-input-textarea " id="message" name="message" rows="5"></textarea>
                                            </div>
                                          </div>
                                        </fieldset>
                                        <div class="spr-form-actions">
                                            <input type="submit" class="spr-button spr-button-primary button button-primary btn btn-primary" value="Submit Review">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <div class="spr-reviews">
                                    <h3 class="spr-form-title">Customer Reviews</h3>
                                    <div class="review-inner">
                                    <div class="spr-review">
                                        <div class="spr-review-header">
                                            <span class="product-review spr-starratings spr-review-header-starratings"><span class="reviewLink"><i class="fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star-o"></i><i class="font-13 fa fa-star-o"></i></span></span>
                                            <h3 class="spr-review-header-title">Lorem ipsum dolor sit amet</h3>
                                            <span class="spr-review-header-byline"><strong>dsacc</strong> on <strong>Apr 09, 2019</strong></span>
                                        </div>
                                        <div class="spr-review-content">
                                            <p class="spr-review-content-body">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                                        </div>
                                    </div>
                                    <div class="spr-review">
                                      <div class="spr-review-header">
                                        <span class="product-review spr-starratings spr-review-header-starratings"><span class="reviewLink"><i class="fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i></span></span>
                                        <h3 class="spr-review-header-title">Lorem Ipsum is simply dummy text of the printing</h3>
                                        <span class="spr-review-header-byline"><strong>larrydude</strong> on <strong>Dec 30, 2018</strong></span>
                                      </div>

                                      <div class="spr-review-content">
                                        <p class="spr-review-content-body">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.
                                        </p>
                                      </div>
                                    </div>
                                    <div class="spr-review">
                                      <div class="spr-review-header">
                                        <span class="product-review spr-starratings spr-review-header-starratings"><span class="reviewLink"><i class="fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i></span></span>
                                        <h3 class="spr-review-header-title">Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...</h3>
                                        <span class="spr-review-header-byline"><strong>quoctri1905</strong> on <strong>Dec 30, 2018</strong></span>
                                      </div>

                                      <div class="spr-review-content">
                                        <p class="spr-review-content-body">Lorem Ipsum is simply dummy text of the printing  typesetting industry. Lorem Ipsum has been the industrys standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.<br>
                                        <br>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                      </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="tab5" class="tab-content">
                        <p>You can set different tabs for each products.</p>
                    </div>
                </div>
            </div>
            <!--End Product Tabs-->

            <!--Related Product Slider-->
            <div class="related-product grid-products">
                <div class="section-header">
                    <h2 class="section-header__title text-center h2"><span>Related Products</span></h2>
                    <p class="sub-heading">You can stop autoplay, increase/decrease aniamtion speed and number of grid to show and products from store admin.</p>
                </div>
                <div class="productPageSlider">
                    @foreach($realatedProducts as $product)
                    <div class="col-12 item">
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="product-layout1.html" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{asset($product['image_one'])}}" src="{{asset($product['image_one'])}}" alt="image" title="product">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{asset($product['image_two'])}}" src="{{asset($product['image_two'])}}" alt="image" title="product">
                                <!-- End hover image -->
                                <!-- product label -->
                                <div class="product-labels rectangular"><span class="lbl pr-label1">new</span></div>
                                <!-- End product label -->
                            </a>
                            <!-- end product image -->
                            <!--Product Button-->
                        </div>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="{{url('product/details/'.$product['id'].'/'.$product['product_name'])}}">
                                    @if(session()->get('lang') == 'english'){{$product['product_name']}}
                                    @elseif (session()->get('lang') == 'germany')
                                    {{$product['product_name_germany']}}
                                    @elseif (session()->get('lang') == 'spanish')
                                    {{$product['product_name_spanish']}}
                                    @elseif (session()->get('lang') == 'french')
                                    {{$product['product_name_french']}}
                                    @elseif (session()->get('lang') == 'arabic')
                                    {{$product['product_name_arabic']}}
                                    @elseif (session()->get('lang') == 'japanese')
                                    {{$data['product_name_japanese']}}
                                    @else
                                    {{ $product['product_name'] }}
                                    @endif
                                </a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                <?php
                                   $discounted_price=Product::getProductdiscount($product['id']);
                                 ?>
                                 @if($discounted_price>0)
                                 <span>${{$discounted_price}}</span> <del style="color:red">${{$product['selling_price'] }}</del>
                                 @else
                                 <span class="price">${{$product['selling_price'] }}</span>
                                 @endif
                               </div>
                            <!-- End product price -->

                            <!--Color Variant -->
                            <ul class="swatches">
                                <?php
                                $color=$product['product_color'];
                                $product_color = explode(',', $color);
                                ?>
                                @foreach($product_color as $color)
                                <li class="swatch small rounded" style="background-color: {{ $color }}"><span class="tooltip-label">{{ $color}}</span></li>
                                @endforeach
                            </ul>
                            <!-- End Variant -->
                        </div>
                        <!-- End product details -->
                    </div>
                    @endforeach
                </div>
                </div>
            <!--End Related Product Slider-->
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->

@endsection

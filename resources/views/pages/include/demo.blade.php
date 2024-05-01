 <div id="page-content">
     <!--Body Container-->
     <!--Breadcrumbs-->
     <div class="breadcrumbs-wrapper">
         <div class="container">
             <div class="breadcrumbs"><a href="{{ url('/') }}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>
                 @if(session()->get('lang') == 'english')
                 {{$productDetails['product_name']}}
                 @elseif (session()->get('lang') == 'bangla')
                 {{$productDetails['product_name_bangla']}}
                 @else
                 {{$productDetails['product_name']}}
                 @endif
                 </span></div>
         </div>
     </div>
     <!--End Breadcrumbs-->
     <div class="container">
         <div class="product-detail-container">
             <div class="product-single">
                 <div class="row">
                     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                             <div class="product-details-img">
                                 <div class="product-thumb">
                                     <div id="gallery" class="product-dec-slider-2 product-tab-left">
                                         @if($productDetails['image_one'])
                                         <a data-image="{{asset($productDetails['image_one'])}}" data-zoom-image="{{asset($productDetails['image_one'])}}" class="slick-slide" data-slick-index="1" aria-hidden="true" tabindex="-1">
                                             <img class="blur-up lazyload" data-src="{{asset($productDetails['image_one'])}}" alt="" />
                                         </a>
                                         @endif
                                         @if($productDetails['image_two'])
                                         <a data-image="{{asset($productDetails['image_two'])}}" data-zoom-image="{{asset($productDetails['image_two'])}}" class="slick-slide" data-slick-index="2" aria-hidden="true" tabindex="-1">
                                             <img class="blur-up lazyload" data-src="{{asset($productDetails['image_two'])}}" src="{{asset($productDetails['image_two'])}}" alt="" />
                                         </a>
                                         @endif
                                         @if($productDetails['image_three'])
                                         <a data-image="{{asset($productDetails['image_three'])}}" data-zoom-image="{{asset($productDetails['image_three'])}}" class="slick-slide" data-slick-index="3" aria-hidden="true" tabindex="-1">
                                             <img class="blur-up lazyload" data-src="{{asset($productDetails['image_three'])}}" src="{{asset($productDetails['image_three'])}}" alt="" />
                                         </a>
                                         @endif

                               

                                         @if($productDetails['image_two'])
                                         <a data-image="{{url('media/product/large/'.$productDetails['image_two'])}}" data-zoom-image="{{url('media/product/large/'.$productDetails['image_two'])}}}" class="slick-slide" data-slick-index="5" aria-hidden="true" tabindex="-1">
                                             <img class="blur-up lazyload" data-src="{{url('media/product/large/'.$productDetails['image_two'])}}" alt="" />
                                         </a>
                                         @endif

                                         @if($productDetails['image_one'])
                                         <a data-image="{{url('media/product/large/'.$productDetails['image_one'])}}" data-zoom-image="{{url('media/product/large/'.$productDetails['image_one'])}}" class="slick-slide" data-slick-index="6" aria-hidden="true" tabindex="-1">
                                             <img class="blur-up lazyload" data-src="{{url('media/product/large/'.$productDetails['image_one'])}}" alt="" />
                                         </a>
                                         @endif


                                     </div>
                                 </div>
                                 <div class="zoompro-wrap product-zoom-right pl-20">
                                     <div class="zoompro-span">
                                         <img id="zoompro" class="zoompro" src="{{asset($productDetails['image_three'])}}" data-zoom-image="{{asset($productDetails['image_three'])}}" alt="" />
                                     </div>
                                     <div class="product-labels"><span class="lbl pr-label1">new</span></div>
                                     <div class="product-buttons">
                                         @if($productDetails['video_link'])
                                         <a href="{{ $productDetails['video_link'] }}" class="mfpbox mfp-with-anim btn popup-video" title="View Video">
                                            <i class="fa fa-video-camera" aria-hidden="true"></i>
                                             <span class="tooltip-label">Watch Video</span>
                                         </a>
                                         @endif

                                     </div>
                                 </div>

                                 <div class="social-sharing">
                                     <span class="label">Share:</span>
                                    <div class="sharethis-inline-share-buttons"></div>
                                  </div>
                             </div>
                         </div>
                     <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                         <div class="product-single__meta">
                             <h1 class="product-single__title">
                                 @if(session()->get('lang') == 'english')
                                 {{Str::upper($productDetails['product_name'])}}
                                 @elseif (session()->get('lang') == 'bangla')
                                 {{$productDetails['product_name_bangla']}}
                                 @else
                                 {{Str::upper($productDetails['product_name'])}}
                                 @endif
                             </h1>
                             <div class="prInfoRow">
                                 <div class="product-review"><a class="reviewLink" href="#tab2"><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><span class="spr-badge-caption">{{ $reviewCount }} reviews</span></a></div>
                                 <div class="product-sku"> @if(session()->get('lang') == 'english')Product Code
                                     @elseif (session()->get('lang') == 'bangla')পণ্য কোড
                                     @else
                                     Product Code
                                     @endif: <span class="variant-sku">{{ $productDetails['product_code'] }}</span></div>
                                     <div class="product-stock"> <span class="instock">@if($total_stock>0) @if(session()->get('lang') == 'english')In Stock @elseif (session()->get('lang') == 'bangla')স্টকে @else In Stock @endif</span> @else<span class="outstock hide">Unavailable</span> @endif</div>
                             </div>
                             <p class="product-single__price product-single__price-product-template">
                                 <span class="visually-hidden">Regular price</span>
                                 <?php
                                  $discounted_price=Product::getProductdiscount($productDetails['id']);

                                  $total=$productDetails['selling_price']-$discounted_price;
                                 ?>
                                 @if($discounted_price>0)
                                 <s id="ComparePrice-product-template"><span class="money">TK.{{$productDetails['selling_price']}}</span></s>
                                 <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                     <span id="ProductPrice-product-template"><span class="money getAttrSize">TK.{{round($discounted_price,2)}}</span></span>
                                 </span>
                                 @else
                                 <span class="product-price__price product-price__price-product-template product-price__sale product-price__sale--single">
                                     <span id="ProductPrice-product-template"><span class="money">Tk.{{$productDetails['selling_price']}}</span></span>
                                 </span>
                                 @endif
                                 @if($discounted_price>0)
                                 <span class="discount-badge"> <span class="devider">|</span>&nbsp;
                                     <span>You Save</span>
                                     <span class="product-single__save-amount"><span class="money getTotal">Tk.{{ round($total,2) }}</span></span>
                                     <span class="off">(<span>{{ $productDetails['discount_price'] }}</span>%)</span>
                                 </span>
                                 @endif
                             </p>
                             <?php
                              $next_day=date('Y-m-d', strtotime(' +1 day'));
                              $prev_date = date('Y-m-d', strtotime(' -1 day'));
                              $hourNow= Carbon\Carbon::now()->format('Y-m-d');
                    //$items = Item::where('created_at', '>=', $hourNow)->get()->count();
                             //$items = App\OrderDetail::select('created_at')->where('product_id',$productDetails['id'])->whereDate('created_at', '>=', $hourNow)->get()->toArray();
                            //dd($hourNow);die;
                              $orderCount=App\OrderDetail::where('product_id',$productDetails['id'])->where('created_at','>=',$next_day)->count();
                              //dd($orderCount);die;
                             ?>
                             <div class="orderMsg" data-user="23" data-time="24">
                                 <p><strong class="items">@if($orderCount>0) {{ $orderCount }} @endif</strong> sold in last <strong class="time">24</strong> hours</p>
                             </div>
                         </div>
                         <div class="product-single__description rte">
                             <ul>
                                 {{ $productDetails['small_detail'] ??"No description"}}
                             </ul>
                         </div>
                         <div id="quantity_message">Hurry! Only  <span class="items">{{ $total_stock }}</span>  left in stock.</div>
                         <!-- countdown start -->
                         @if($discounted_price>0 && $sale->status==1 && $sale->sale_date > Carbon\carbon::now())
                         <div class="saleTime product-countdown" data-countdown="{{ Carbon\Carbon::parse($sale->sale_date)->format('Y/m/d h:m:s') }}"></div>
                         @endif
                         <!-- countdown end -->
                         <form method="post" action="{{url('cart-product-add')}}" id="product_form_10508262282" accept-charset="UTF-8" class="product-form product-form-product-template hidedropdown" enctype="multipart/form-data">
                            <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                             @csrf
                             <div class="swatch clearfix swatch-0 option1" data-option-index="0">
                                 <div class="product-form__item">
                                   <label class="label">Color:<span class="required">*</span> <span class="slVariant">Red</span></label>
                                   @foreach($product_color as $color)
                                   <div class="swatch-element color">
                                       <input class="swatchInput" id="swatch-{{ $color }}" type="radio" name="color" value="{{ $color }}" required>
                                       <label class="swatchLbl small" for="swatch-{{ $color }}" title="{{ $color }}" style="background-color:{{ $color }}"></label>
                                   </div>
                                   @endforeach
                                 </div>
                                 @if ($errors->has('color'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('color') }}</strong>
                                 </span>
                                 @endif
                             </div>
                             <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                 <div class="product-form__item">
                                   <label class="label">Size:<span class="required">*</span> <span class="slVariant">XS</span> <a href="#sizechart" class="sizelink btn-link"><i class="anm anm-ruler"></i> Size Guide</a></label>
                                   @forelse($productDetails['attributes'] as $attribute)
                                   
                                   <div data-value="XS" class="swatch-element xs available">
                                     <input class="swatchInput getSize" id="swatch-1-{{ $attribute['weight_size'] }}" type="radio" name="weight_size" value="{{ $attribute['weight_size'] }}" required id="getSize" productsize-id="{{$productDetails['id']}}">
                                     <label class="swatchLbl medium" for="swatch-1-{{ $attribute['weight_size'] }}" title="{{ $attribute['weight_size'] }}">{{ $attribute['weight_size'] }}</label>
                                   </div>
                                     @empty
                                     <h5>No Size Available</h5>
                                     @endforelse
                                 </div>
                                 @if ($errors->has('weight_size'))
                                 <span class="invalid-feedback" role="alert">
                                     <strong>{{ $errors->first('weight_size') }}</strong>
                                 </span>
                                 @endif
                             </div>
                             <p class="infolinks">
                                 <a class="wishlist add-to-wishlist" href="my-wishlist.html" title="Add to Wishlist"><i class="icon anm anm-heart-l" aria-hidden="true"></i> <span>Add to Wishlist</span></a>

                             </p>
                             <!-- Product Action -->
                             <div class="product-action clearfix">
                                 <div class="product-form__item--quantity">
                                     <div class="wrapQtyBtn">
                                         <div class="qtyField">
                                             <a class="qtyBtn minus" ><i class="fa fa-minus" aria-hidden="true"></i></a>
                                             <input type="text" name="quantity" class="product-form__input qty" placeholder="quantity" required onkeyup="numberOnly(this)">
                                             <a class="qtyBtn plus" ><i class="fa fa-plus" aria-hidden="true"></i></a>
                                         </div>
                                         @if ($errors->has('quantity'))
                                         <span class="invalid-feedback" role="alert">
                                             <strong>{{ $errors->first('quantity') }}</strong>
                                         </span>
                                         @endif
                                     </div>
                                 </div>
                                 <div class="product-form__item--submit">
                                    @if($total_stock>0)
                                     <button type="submit" class="btn product-form__cart-submit">
                                         <span>Add to cart</span>
                                     </button>
                                     @else
                                     <span>Try Another Product</span>
                                     @endif
                                 </div>
                                 <div class="agree-check">
                                    <input type="checkbox" id="prTearm" class="checkbox" value="tearm" required="">
                                    <label for="prTearm"><span class="checkbox"></span> I agree with the terms and conditions</label>
                                </div>
                                 <div class="buy-it-btn">
                                     <button type="button" class="btn" disabled="disabled">Buy it now</button>
                                 </div>
                             </div>
                             <!-- End Product Action -->
                         </form>
                        
                         <p id="freeShipMsg" class="freeShipMsg" data-price="199"><i class="fa fa-truck" aria-hidden="true"></i> In Dhaka City! Only <b class="freeShip"><span class="money" data-currency-usd="tk.80" data-currency="BDT">TK.80</span></b> Away From Dhaka <b>Tk.140</b></p>
                   
                         <p class="shippingMsg"><i class="fa fa-clock-o" aria-hidden="true"></i> Estimated Delivery Between <b id="fromDate">1</b> and <b id="toDate"> 2 particular Orders Day</b>.</p>
                         
                         <div class="userViewMsg">
                             <i class="fa fa-users" aria-hidden="true"></i> <strong class="uersView " id="visits"></strong> People are Looking for this Product
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
                                 @elseif (session()->get('lang') == 'bangla')
                                 <p>{!!$productDetails['detail_bangla']!!}</p>
                                 @else
                                 <p>{!!$productDetails['product_details']!!}</p>
                                 @endif
                             </div>
                         </div>
                     </div>
                 </div>
                 <h3 class="acor-ttl" rel="tab2">Ask Question For This Product </h3>
                 <div id="tab2" class="tab-content">
                     <div class="row">
                         <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                            @guest
                            <div class="spr-review">
                                <div class="spr-review-content">
                                    <h5 style="color:coral"><a href="{{url('user/login-registers')}}" target="_blank">Please Login</a></h5>
                                    <p>Please Ask Relevent Question About Products!!</p>

                                </div>
                             </div>
                             @else

                             <div class="spr-form clearfix">
                                 <form method="post" action="{{url('/check-user-post-comment-for-products')}}" id="new-review-form" class="new-review-form">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                                     <h3 class="spr-form-title">Questions About This Product </h3>
                                     <fieldset class="spr-form-review">
                                       <div class="spr-form-review-body">
                                         <label class="spr-form-label" for="message">Body of Question <span class="spr-form-review-body-charactersremaining">Pls Dont share email,phone,password And Relevent Question</span></label>
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
                             @endguest
                         </div>
                         <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                             <div class="spr-reviews">
                                 <h3 class="spr-form-title">Question For This Product</h3>
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
                                         <span class="spr-review-header-byline"><strong>dsacc</strong>{{Carbon\Carbon::parse($row['created_at'])->diffForHumans()}} <strong></strong></span>
                                     </div>
                                     <div class="spr-review-content">
                                         <p class="spr-review-content-body">{{$row['comment']}}</p>
                                     </div>
                                     <?php
                                     $id=$row['id'];
                                     $replayCount=App\ProductReplay::where('status',1)->where('comment_id',$id)->get();
                                     //dd($replayCount);die;
                                    ?>
                                    @foreach($replayCount as $data)

                                     <div class="spr-review-header">
                                        <h3 class="spr-review-header-title">{{$data['admins']['name']??"No Name"}}</h3>
                                        <span class="spr-review-header-byline"><strong>dsacc</strong>{{Carbon\Carbon::parse($data['created_at'])->diffForHumans()}} <strong></strong></span>
                                    </div>
                                    <div class="spr-review-content">
                                        <p class="spr-review-content-body">{!!$data['comment_replay']??"Yet,To Replay"!!}</p>
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
                                @foreach($OrderDetail as $row)
                                <div class="spr-review-header">
                                    <span class="product-review spr-starratings spr-review-header-starratings"><span class="reviewLink"><i class="fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i><i class="font-13 fa fa-star"></i></span></span>
                                    <h3 class="spr-review-header-title">{{$row['users']['name']}}</h3>
                                    <span class="spr-review-header-byline"><strong>dsacc</strong> on <strong>{{Carbon\Carbon::parse($row['review_date'])->diffForHumans()}}</strong></span>
                                </div>
                                <div class="spr-review-content">
                                    <p class="spr-review-content-body">{{$row['comment']}}</p>
                                </div>
                                @endforeach
                            </div>
                            </div>
                        </div>
                    </div>
                    </div>
                 </div>
                  <h3 class="acor-ttl" rel="tab4">Size Chart</h3>
                 <div id="tab4" class="tab-content">
                    <h3> {{ $productDetails['product_name'] }}</h3>
                    <table>
                      <tbody>
                        <tr>
                         <th>Size</th>
                          @forelse($productDetails['attributes'] as $attribute)
                          <th>{{ $attribute['weight_size'] }}</th>
                          @empty
                          <td>No Size Available</td>
                          @endforelse
                        </tr>
                        <tr>
                          <td>Chest</td>
                          @forelse($productDetails['attributes'] as $attribute)
                          <td>{{ $attribute['chest'] }}</td>
                          @empty
                          <td>No Size Available</td>
                          @endforelse
                        </tr>
                        <tr>
                          <td>Collar</td>
                          @forelse($productDetails['attributes'] as $attribute)
                          <td>{{ $attribute['waist'] }}</td>
                          @empty
                          <td>No Size Available</td>
                          @endforelse
                        </tr>
                        <tr>
                          <td>Length</td>
                          @forelse($productDetails['attributes'] as $attribute)
                          <td>{{ $attribute['length'] }}</td>
                          @empty
                          <td>No Size Available</td>
                          @endforelse
                        </tr>


                      </tbody>
                    </table>
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
                         <a href="{{url('product/details/'.$product['id'].'/'.$product['product_name'])}}" class="product-img">
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
                                 @elseif (session()->get('lang') == 'bangla')
                                 {{$product['product_name_bangla']}}

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

     <!--Product Navigation-->
     <a href="#" class="product-nav prev-pro" title="Previous Product">
         <span class="details">Sunset Sleep Scarf Top<br>
             <span class="price">$49</span>
         </span>
         <span class="img"><img src="assets/images/product-images/product5.jpg" alt="" /></span>
     </a>
     <a href="#" class="product-nav next-pro" title="Next Product">
         <span class="img"><img src="assets/images/product-images/product9.jpg" alt=""></span>
         <span class="details">Toledo Mules shoes<br>
             <span class="price">$588</span>
         </span>
     </a>
     <!--End Product Navigation-->
 </div><!--End Page Wrapper-->
 <script>
	var video=document.getElementById('video');
	var videoMy=document.getElementById('videoMy');
	fuction stopVideo(){
		video.style.display="none";
	}

</script>

<script type="text/javascript">
    $(document).ready(function() {
       $(".getSize").on('change', function(){
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
                  $(".getAttrSize").html("<del>TK."+resp['selling_price']+"</del> TK."+resp['final_price']);
                  $(".getTotal").html("TK."+resp['discount']);
               }else{
                   $(".getAttrSize").html("TK."+resp['selling_price']);
               }

           },error:function(){
               alert("Error");
           }
       });
   });
   });
</script>

<!--Size Chart-->
<div id="sizechart" class="mfpbox mfp-with-anim mfp-hide">
    <h4>{{ $productDetails['product_name'] }}</h4>
    <p><strong>Ready to Wear Clothing</strong></p>
    <table>
    <tbody>
        <tr>
            <th>Size</th>
             @forelse($productDetails['attributes'] as $attribute)
             <th>{{ $attribute['weight_size'] }}</th>
             @empty
             <td>No Size Available</td>
             @endforelse
           </tr>
           <tr>
             <td>Chest</td>
             @forelse($productDetails['attributes'] as $attribute)
             <td>{{ $attribute['chest'] }}</td>
             @empty
             <td>No Size Available</td>
             @endforelse
           </tr>
           <tr>
             <td>Collar</td>
             @forelse($productDetails['attributes'] as $attribute)
             <td>{{ $attribute['waist'] }}</td>
             @empty
             <td>No Size Available</td>
             @endforelse
           </tr>
           <tr>
             <td>Length</td>
             @forelse($productDetails['attributes'] as $attribute)
             <td>{{ $attribute['length'] }}</td>
             @empty
             <td>No Size Available</td>
             @endforelse
           </tr>
    </tbody>
    </table>
    <button title="Close (Esc)" type="button" class="mfp-close">×</button>
</div>
<!--End Size Chart-->
@endsection
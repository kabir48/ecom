   <style>
        .product-form__item .swatchInput+.swatchLbl {
    color: #000;
    font-size: 12px;
    font-weight: 400;
    line-height: 26px;
    text-transform: capitalize;
    display: inline-block;
    margin: 0;
    min-width: 30px;
    height: 30px;
    overflow: hidden;
    text-align: center;
    background-color: #f9f9f9;
    padding: 0 10px;
    border: 2px solid #fff;
    box-shadow: 0 0 0 1px #ddd;
    border-radius: 0;
    -ms-transition: all 0.5s ease-in-out;
    -webkit-transition: all 0.5s ease-in-out;
    transition: all 0.5s ease-in-out;
    cursor: pointer;
}
   </style>
   
   
   <!--====New Arrival For Panjabi====-->
   
    <!--====All Casual Dress===-->
    <div class="container">
        <div class="section product-slider">
            <div class="section-header">
                <h2> @if(session()->get('lang')=='bangla'){{__('heading.new_arrival_panjabi_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.new_arrival_panjabi_en')}} @else {{__('heading.new_arrival_panjabi_bn')}} @endif</h2>
            </div>
            @if(count($newArrivalPanjabies)>0)
            <div class="productSlider grid-products">
                @foreach($newArrivalPanjabies as $key=>$data)
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 item quick_product_data">
                   <?php
                            $data_format=date('Y-m-d',strtotime($data['discount_date']));
                            $discounted_price=App\Product::getProductdiscount($data['id']);
                            $name=preg_replace('/\s+/', '', $data['product_name']);
                            
                            //====Ip Block====//
                            $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                            $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                            if($getIp->country !='Bangladesh'){
                                if($currencieCount>0){
                                    $amount= $currencies->exchange_rate;
                                    $selling_price=$data['selling_price'] * $amount;
                                    $discounted_price=$discounted_price * $amount;
                                }else{
                                   $selling_price=$data['selling_price'];
                                   $discounted_price=$discounted_price ;
                                }
                            }else{
                                $selling_price=$data['selling_price'];
                               // dd($selling_price);
                                $discounted_price=$discounted_price ;
                            }
                            
                            $productSizes =App\AttributeProduct::with('product')->where('product_id',$data['id'])->where('status',1)->get()->toArray();
                        ?>
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="{{url('product/details/'.$data['id'].'/'.$name)}}" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                <!-- End hover image -->
                                @if($data['discount_price'])
                                <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                @endif
                                
                                @if($data['product_quantity'] < 0 || empty($data['product_quantity']))
                                    <span class="sold-out"><span>Sold out</span></span>
                                @endif
                            </a>
                            <!-- end product image -->
                            
                            @if(!empty($data['discount_date']))
                           
                            <!--Countdown Timer-->
                            <div class="saleTime desktop" data-countdown="{{$data_format}}"></div>
                            <!--End Countdown Timer-->
                            @endif
                            
                            <!--Product Button-->
                            <div class="button-set style1">
                                <ul>
                                    <li>
                                        <input class="form-control input-number qty_cart qty-input" type="hidden" value="1">
                                            <input type="hidden" value="{{$data['id']}}" class="product_id_cart">
                                        <!--Cart Button-->
                                        <form class="add">
                                            <button class="btn-icon btn btn-addto-cart addToCartProduct" type="button" tabindex="0" data-mode="buy_now">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Buy Now</span>
                                            </button>
                                        </form>
                                        <!--end Cart Button-->
                                    </li>
                                    <li>
                                        <!--Quick View Button-->
                                        <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data['id'] }}">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            <span class="tooltip-label">Quick View</span>
                                        </a>
                                        <!--End Quick View Button-->
                                    </li>
                                    <li>
                                        <!--Wishlist Button-->
                                        <div class="wishlist-btn">
                                            <a class="btn-icon wishlist add-to-wishlist product-wish" href="javascript:void(0)">
                                               <i class="fa fa-heart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Add To Wishlist</span>
                                            </a>
                                        </div>
                                        <!--End Wishlist Button-->
                                    </li>
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{ucfirst($data['product_name'])}}</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                 @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif @if($discounted_price>0) 
                                 <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($discounted_price)}}  @elseif(session()->get('lang')=='english') {{$discounted_price}} @else {{convertToBanglaNumber($discounted_price)}} @endif &nbsp;&nbsp;
                                 <del style="color:red">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</del></span> @else <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</span> @endif
                            </div>
                            <!-- End product price -->
                            <!--Product Review-->
                            <?php
                                $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
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
                            <div class="product-review">
                                <?php
                                    $star=1;
                                    while ($star <= 5) {?>
                                    <i class="font-13 fa fa-star"></i>
                                    <?php $star++;
                                }?>
                                ({{$roundAvg}})
                            </div>
                            <!--End Product Review-->
                            
                            
                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                <div class="product-form__item">
                                @foreach($productSizes as $key=>$size)
                                  <div data-value="{{$size['weight_size']}}" class="swatch-element xs available">
                                    <input class="swatchInput" id="swatch-1-{{$key}}" type="radio" name="w_size" value="{{$size['weight_size']}}">
                                    <label class="swatchLbl medium" for="swatch-1-{{$key}}" title="{{$size['weight_size']}}">{{$size['weight_size']}}</label>
                                  </div>
                                @endforeach
                               
                                </div>
                            </div>
                        </div>
                        <!-- End product details -->
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>         
    <!--====End Formals Parts===--> 
   <!--====New Arrival For Panjabi End====-->
   
   
   <!--====New Arrivals====-->
    <div class="container">
        <div class="section product-slider">
                <div class="section-header">
                    <h2>@if(session()->get('lang')=='bangla'){{__('heading.new_arrival_shirt_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.new_arrival_shirt_en')}} @else {{__('heading.new_arrival_shirt_bn')}} @endif</h2>
                </div>
                <div class="productSlider grid-products">
                    @foreach($newArrivals as $key=>$data)
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 item quick_product_data">
                       <?php
                                $data_format=date('Y/m/d',strtotime($data['discount_date']));
                                $discounted_price=App\Product::getProductdiscount($data['id']);
                                $name=preg_replace('/\s+/', '', $data['product_name']);
                                
                                //====Ip Block====//
                                $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                if($getIp->country !='Bangladesh'){
                                    if($currencieCount>0){
                                        $amount= $currencies->exchange_rate;
                                        $selling_price=$data['selling_price'] * $amount;
                                        $discounted_price=$discounted_price * $amount;
                                    }else{
                                       $selling_price=$data['selling_price'];
                                       $discounted_price=$discounted_price ;
                                    }
                                }else{
                                    $selling_price=$data['selling_price'];
                                   // dd($selling_price);
                                    $discounted_price=$discounted_price ;
                                }
                                
                                $productSizes =App\AttributeProduct::with('product')->where('product_id',$data['id'])->where('status',1)->get()->toArray();
                            ?>
                            <!-- start product image -->
                            <div class="product-image">
                                <!-- start product image -->
                                <a href="{{url('product/details/'.$data['id'].'/'.$name)}}" class="product-img main-img">
                                    <!-- image -->
                                    <img class="primary blur-up lazyload" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="hover hover-img blur-up lazyload" data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                    <!-- End hover image -->
                                    @if($data['discount_price'])
                                    <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                    @endif
                                    
                                    @if($data['product_quantity'] < 0 || empty($data['product_quantity']))
                                        <span class="sold-out"><span>Sold out</span></span>
                                    @endif
                                </a>
                                <!-- end product image -->
                                
                                @if($data['discount_date'])
                               
                                <!--Countdown Timer-->
                                <div class="saleTime desktop" data-countdown="{{$data_format}}"></div>
                                <!--End Countdown Timer-->
                                @endif
                                
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <ul>
                                        <li>
                                            <input class="form-control input-number qty_cart qty-input" type="hidden" value="1">
                                            <input type="hidden" value="{{$data['id']}}" class="product_id_cart">
                                            <!--Cart Button-->
                                            <form class="add">
                                                <button class="btn-icon btn btn-addto-cart addToCartProduct" type="button" tabindex="0" data-mode="buy_now">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <span class="tooltip-label">Buy Now</span>
                                                </button>
                                            </form>
                                            <!--end Cart Button-->
                                        </li>
                                        <li>
                                            <!--Quick View Button-->
                                            <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data['id'] }}">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                <span class="tooltip-label">Quick View</span>
                                            </a>
                                            <!--End Quick View Button-->
                                        </li>
                                        <li>
                                            <!--Wishlist Button-->
                                            <div class="wishlist-btn">
                                                <a class="btn-icon wishlist add-to-wishlist product-wish" href="javascript:void(0)">
                                                   <i class="fa fa-heart" aria-hidden="true"></i>
                                                    <span class="tooltip-label">Add To Wishlist</span>
                                                </a>
                                            </div>
                                            <!--End Wishlist Button-->
                                        </li>
                                    </ul>
                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- end product image -->
                            <!--start product details -->
                            <div class="product-details text-center">
                                <!-- product name -->
                                <div class="product-name">
                                    <a href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{ucfirst($data['product_name'])}}</a>
                                </div>
                                <!-- End product name -->
                                <!-- product price -->
                                 <div class="product-price">
                                     @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif @if($discounted_price>0) 
                                     <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($discounted_price)}}  @elseif(session()->get('lang')=='english') {{$discounted_price}} @else {{convertToBanglaNumber($discounted_price)}} @endif &nbsp;&nbsp;
                                     <del style="color:red">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</del></span> @else <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</span> @endif
                                </div>
                                <!-- End product price -->
                                <!--Product Review-->
                                <?php
                                    $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
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
                                <div class="product-review">
                                    <?php
                                        $star=1;
                                        while ($star <= 5) {?>
                                        <i class="font-13 fa fa-star"></i>
                                        <?php $star++;
                                    }?>
                                    ({{$roundAvg}})
                                </div>
                                <!--End Product Review-->
                                
                                  
                                

                                
                                <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                    <div class="product-form__item">
                                @foreach($productSizes as $key => $size)
                                    <div data-value="{{$size['weight_size']}}" class="swatch-element xs available">
                                        
                                        <input class="swatchInput" id="swatch-1-{{$key}}" type="radio" name="w_size" value="{{$size['weight_size']}}" @if($key === 0) checked @endif>
                                        
                                        <!--<label class="swatchLbl medium" for="swatch-1-{{$key}}" title="{{$size['weight_size']}}">{{$size['weight_size']}}</label>-->
                                         <label class="swatchLbl medium" for="swatch-1-{{$key}}" title="{{$size['weight_size']}}">{{$size['weight_size']}}</label>

                                    </div>
                                @endforeach
                                                                   
                                    </div>
                                </div>
                            </div>
                            <!-- End product details -->
                    </div>
                    @endforeach
                </div>
            </div>
    </div>         
    <!--====End New Arrivals===-->  
    
    <!--====All Formals Dress===-->
    <div class="container">
        <div class="section product-slider">
            <div class="section-header">
                <h2> @if(session()->get('lang')=='bangla'){{__('heading.formal_shirt_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.formal_shirt_en')}} @else {{__('heading.formal_shirt_bn')}} @endif</h2>
            </div>
            @if(count($getFormalShirts)>0)
            <div class="productSlider grid-products">
                @foreach($getFormalShirts as $key=>$data)
                    <div class="col-12 col-sm-12 col-md-12 col-lg-12 item quick_product_data">
                        <?php
                            $data_format=date('Y/m/d',strtotime($data['discount_date']));
                            $discounted_price=App\Product::getProductdiscount($data['id']);
                            $name=preg_replace('/\s+/', '', $data['product_name']);
                            
                            //====Ip Block====//
                            $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                            $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                            if($getIp->country !='Bangladesh'){
                                if($currencieCount>0){
                                    $amount= $currencies->exchange_rate;
                                    $selling_price=$data['selling_price'] * $amount;
                                    $discounted_price=$discounted_price * $amount;
                                }else{
                                   $selling_price=$data['selling_price'];
                                   $discounted_price=$discounted_price ;
                                }
                            }else{
                                $selling_price=$data['selling_price'];
                               // dd($selling_price);
                                $discounted_price=$discounted_price ;
                            }
                            
                            $productSizes =App\AttributeProduct::with('product')->where('product_id',$data['id'])->where('status',1)->get()->toArray();
                        ?>
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="{{url('product/details/'.$data['id'].'/'.$name)}}" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                <!-- End hover image -->
                                @if($data['discount_price'])
                                <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                @endif
                                
                                @if($data['product_quantity'] < 0 || empty($data['product_quantity']))
                                <span class="sold-out"><span>Sold out</span></span>
                                @endif
                            </a>
                            <!-- end product image -->
                            
                            @if($data['discount_date'])
                           
                            <!--Countdown Timer-->
                            <div class="saleTime desktop" data-countdown="{{$data_format}}"></div>
                            <!--End Countdown Timer-->
                            @endif
                            
                            <!--Product Button-->
                            <div class="button-set style1">
                                <ul>
                                    <li>
                                        <input class="form-control input-number qty_cart qty-input" type="hidden" value="1">
                                        <input type="hidden" value="{{$data['id']}}" class="product_id_cart">
                                        <!--Cart Button-->
                                        <form class="add">
                                            <button class="btn-icon btn btn-addto-cart addToCartProduct" type="button" tabindex="0" data-mode="buy_now">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Buy Now</span>
                                            </button>
                                        </form>
                                        <!--end Cart Button-->
                                    </li>
                                    <li>
                                        <!--Quick View Button-->
                                        <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data['id'] }}">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            <span class="tooltip-label">Quick View</span>
                                        </a>
                                        <!--End Quick View Button-->
                                    </li>
                                    <li>
                                        <!--Wishlist Button-->
                                        <div class="wishlist-btn">
                                            <a class="btn-icon wishlist add-to-wishlist product-wish" href="javascript:void(0)">
                                               <i class="fa fa-heart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Add To Wishlist</span>
                                            </a>
                                        </div>
                                        <!--End Wishlist Button-->
                                    </li>
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{ucfirst($data['product_name'])}}</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                             <div class="product-price">
                                 @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif @if($discounted_price>0) 
                                 <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($discounted_price)}}  @elseif(session()->get('lang')=='english') {{$discounted_price}} @else {{convertToBanglaNumber($discounted_price)}} @endif &nbsp;&nbsp;
                                 <del style="color:red">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</del></span> @else <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</span> @endif
                            </div>
                            <!-- End product price -->
                            <!--Product Review-->
                            <?php
                                $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
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
                            <div class="product-review">
                                <?php
                                    $star=1;
                                    while ($star <= 5) {?>
                                    <i class="font-13 fa fa-star"></i>
                                    <?php $star++;
                                }?>
                                ({{$roundAvg}})
                            </div>
                            <!--End Product Review-->
                            
                          <!--  <div class="swatch clearfix swatch-1 option2" data-option-index="1">-->
                          <!--     <div class="product-form__item">-->
                          <!--      <div data-value="XS" class="xs available">-->
                          <!--      <input class="swatchInput getSize" id="swatch-1-Xl" onclick="sizeProduct()" productsize-id="2" type="radio" name="w_size" value="Xl">-->
                          <!--       <label class="swatchLbl medium" for="swatch-1-Xl" title="Xl">Xl</label>-->
                          <!--  </div>-->
                          <!--  <div data-value="XS" class="xs available">-->
                          <!--   <input class="swatchInput getSize" id="swatch-1-M" onclick="sizeProduct()" productsize-id="2" type="radio" name="w_size" value="M">-->
                          <!--    <label class="swatchLbl medium" for="swatch-1-M" title="M">M</label>-->
                          <!--   </div>-->
                          <!--  </div>-->
                          <!--</div>-->
                            
                            
                            
                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                <div class="product-form__item">
                                @foreach($productSizes as $key=>$size)
                                  <div data-value="{{$size['weight_size']}}" class="swatch-element xs available">
                                    <input class="swatchInput" id="swatch-1-{{$key}}" type="radio" name="w_size" value="{{$size['weight_size']}}">
                                    <label class="swatchLbl medium" for="swatch-1-{{$key}}" title="{{$size['weight_size']}}">{{$size['weight_size']}}</label>
                                  </div>
                                @endforeach
                               
                                </div>
                            </div>
                        </div>
                        <!-- End product details -->
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>         
    <!--====End Formals Parts===--> 
    
    <!--====All Casual Dress===-->
    <div class="container">
        <div class="section product-slider">
            <div class="section-header">
                <h2>@if(session()->get('lang')=='bangla'){{__('heading.casual_shirt_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.casual_shirt_en')}} @else {{__('heading.casual_shirt_bn')}} @endif</h2>
            </div>
            @if(count($allCasuals)>0)
            <div class="productSlider grid-products">
                @foreach($allCasuals as $key=>$data)
                <div class="col-12 col-sm-12 col-md-12 col-lg-12 item quick_product_data">
                   <?php
                            $data_format=date('Y/m/d',strtotime($data['discount_date']));
                            $discounted_price=App\Product::getProductdiscount($data['id']);
                            $name=preg_replace('/\s+/', '', $data['product_name']);
                            
                            //====Ip Block====//
                            $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                            $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
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
                            
                            $productSizes =App\AttributeProduct::with('product')->where('product_id',$data['id'])->where('status',1)->get()->toArray();
                        ?>
                        <!-- start product image -->
                        <div class="product-image">
                            <!-- start product image -->
                            <a href="{{url('product/details/'.$data['id'].'/'.$name)}}" class="product-img">
                                <!-- image -->
                                <img class="primary blur-up lazyload" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                <!-- End image -->
                                <!-- Hover image -->
                                <img class="hover blur-up lazyload" data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                <!-- End hover image -->
                                @if($data['discount_price'])
                                <div class="product-labels"><span class="lbl on-sale">Sale</span></div>
                                @endif
                                
                                @if($data['product_quantity'] < 0 || empty($data['product_quantity']))
                                    <span class="sold-out"><span>Sold out</span></span>
                                @endif
                            </a>
                            <!-- end product image -->
                            
                            @if($data['discount_date'])
                           
                            <!--Countdown Timer-->
                            <div class="saleTime desktop" data-countdown="{{$data_format}}"></div>
                            <!--End Countdown Timer-->
                            @endif
                            
                            <!--Product Button-->
                            <div class="button-set style1">
                                <ul>
                                    <li>
                                        <input class="form-control input-number qty_cart qty-input" type="hidden" value="1">
                                            <input type="hidden" value="{{$data['id']}}" class="product_id_cart">
                                        <!--Cart Button-->
                                        <form class="add">
                                            <button class="btn-icon btn btn-addto-cart addToCartProduct" type="button" tabindex="0" data-mode="buy_now">
                                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Buy Now</span>
                                            </button>
                                        </form>
                                        <!--end Cart Button-->
                                    </li>
                                    <li>
                                        <!--Quick View Button-->
                                        <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data['id'] }}">
                                            <i class="fa fa-search-plus" aria-hidden="true"></i>
                                            <span class="tooltip-label">Quick View</span>
                                        </a>
                                        <!--End Quick View Button-->
                                    </li>
                                    <li>
                                        <!--Wishlist Button-->
                                        <div class="wishlist-btn">
                                            <a class="btn-icon wishlist add-to-wishlist product-wish" href="javascript:void(0)">
                                               <i class="fa fa-heart" aria-hidden="true"></i>
                                                <span class="tooltip-label">Add To Wishlist</span>
                                            </a>
                                        </div>
                                        <!--End Wishlist Button-->
                                    </li>
                                </ul>
                            </div>
                            <!--End Product Button-->
                        </div>
                        <!-- end product image -->
                        <!--start product details -->
                        <div class="product-details text-center">
                            <!-- product name -->
                            <div class="product-name">
                                <a href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{ucfirst($data['product_name'])}}</a>
                            </div>
                            <!-- End product name -->
                            <!-- product price -->
                            <div class="product-price">
                                 @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif @if($discounted_price>0) 
                                 <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($discounted_price)}}  @elseif(session()->get('lang')=='english') {{$discounted_price}} @else {{convertToBanglaNumber($discounted_price)}} @endif &nbsp;&nbsp;
                                 <del style="color:red">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</del></span> @else <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</span> @endif
                            </div>
                            <!-- End product price -->
                            <!--Product Review-->
                            <?php
                                $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
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
                            <div class="product-review">
                                <?php
                                    $star=1;
                                    while ($star <= 5) {?>
                                    <i class="font-13 fa fa-star"></i>
                                    <?php $star++;
                                }?>
                                ({{$roundAvg}})
                            </div>
                            <!--End Product Review-->
                            
                            
                            <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                <div class="product-form__item">
                                @foreach($productSizes as $key=>$size)
                                  <div data-value="{{$size['weight_size']}}" class="swatch-element xs available">
                                    <input class="swatchInput" id="swatch-1-{{$key}}" type="radio" name="w_size" value="{{$size['weight_size']}}">
                                    <label class="swatchLbl medium" for="swatch-1-{{$key}}" title="{{$size['weight_size']}}">{{$size['weight_size']}}</label>
                                  </div>
                                @endforeach
                               
                                </div>
                            </div>
                        </div>
                        <!-- End product details -->
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>         
    <!--====End Formals Parts===--> 
        
    <!--====All Panjabi from here=====-->
    <div class="container-fluid">
        <div class="row">
			<!--Main Content-->
			<div class="col-12 col-sm-12 col-md-12 col-lg-12 main-col">
                <div class="page-title"><h1>@if(session()->get('lang')=='bangla'){{__('heading.all_trendy_panjabi_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.all_trendy_panjabi_en')}} @else {{__('heading.all_trendy_panjabi_bn')}} @endif</h1></div>
                @if(count($allPanjabies)>0)
                <!--Product Grid-->
                <div class="grid-products grid--view-items">
                    <div class="row">
                        @foreach($allPanjabies as $key=>$data)
                        <div class="col-12 col-sm-12 col-md-4 col-lg-3 item quick_product_data">
                            <?php
                                $data_format=date('Y/m/d',strtotime($data['discount_date']));
                                $discounted_price=App\Product::getProductdiscount($data['id']);
                                $name=preg_replace('/\s+/', '', $data['product_name']);
                                
                                //====Ip Block====//
                                $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                if($getIp->country !='Bangladesh'){
                                    if($currencieCount>0){
                                        $amount= $currencies->exchange_rate;
                                        $selling_price=$data['selling_price'] * $amount;
                                        $discounted_price=$discounted_price * $amount;
                                    }else{
                                       $selling_price=$data['selling_price'];
                                       $discounted_price=$discounted_price ;
                                    }
                                }else{
                                    $selling_price=$data['selling_price'];
                                   // dd($selling_price);
                                    $discounted_price=$discounted_price ;
                                }
                                
                                $productSizes =App\AttributeProduct::with('product')->where('product_id',$data['id'])->where('status',1)->get()->toArray();
                            ?>
                            <!-- start product image -->
                            <div class="product-image">
                                <!-- start product image -->
                                <a href="{{url('product/details/'.$data['id'].'/'.$name)}}" class="product-img">
                                    <!-- image -->
                                    <img class="primary blur-up lazyload small"  data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                    <!-- End image -->
                                    <!-- Hover image -->
                                    <img class="hover blur-up lazyload small"  data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}">
                                    <!-- End hover image -->
                                    @if($data['discount_price'])
                                    <div class="product-labels"><span class="lbl on-sale">New</span></div>
                                    @endif
                                </a>
                                <!-- end product image -->
                                
                                @if($data['discount_date'])
                               
                                <!--Countdown Timer-->
                                <div class="saleTime desktop" data-countdown="{{$data_format}}"></div>
                                <!--End Countdown Timer-->
                                @endif
                                
                                <!--Product Button-->
                                <div class="button-set style1">
                                    <ul>
                                        <li>
                                            <input class="form-control input-number qty_cart qty-input" type="hidden" value="1">
                                            <input type="hidden" value="{{$data['id']}}" class="product_id_cart">
                                            <!--Cart Button-->
                                            <form class="add">
                                                <button class="btn-icon btn btn-addto-cart addToCartProduct" type="button" tabindex="0" data-mode="buy_now">
                                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                                    <span class="tooltip-label">Buy Now</span>
                                                </button>
                                            </form>
                                            <!--end Cart Button-->
                                        </li>
                                        <li>
                                            <!--Quick View Button-->
                                            <a href="javascript:void(0)" title="Quick View" class="btn-icon quick-view-popup quick-view" data-toggle="modal" data-target="#content_quickview" onclick="productview(this.id)" id="{{ $data['id'] }}">
                                                <i class="fa fa-search-plus" aria-hidden="true"></i>
                                                <span class="tooltip-label">Quick View</span>
                                            </a>
                                            <!--End Quick View Button-->
                                        </li>
                                        <li>
                                            <!--Wishlist Button-->
                                            <div class="wishlist-btn">
                                                <a class="btn-icon wishlist add-to-wishlist product-wish" href="javascript:void(0)">
                                                   <i class="fa fa-heart" aria-hidden="true"></i>
                                                    <span class="tooltip-label">Add To Wishlist</span>
                                                </a>
                                            </div>
                                            <!--End Wishlist Button-->
                                        </li>
                                    </ul>
                                </div>
                                <!--End Product Button-->
                            </div>
                            <!-- end product image -->
                            <!--start product details -->
                            <div class="product-details text-center">
                                <!-- product name -->
                                <div class="product-name">
                                    <a href="{{url('product/details/'.$data['id'].'/'.$name)}}">{{ucfirst($data['product_name'])}}</a>
                                </div>
                                <!-- End product name -->
                                <!-- product price -->
                                <div class="product-price">
                                     @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif @if($discounted_price>0) 
                                     <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($discounted_price)}}  @elseif(session()->get('lang')=='english') {{$discounted_price}} @else {{convertToBanglaNumber($discounted_price)}} @endif &nbsp;&nbsp;
                                     <del style="color:red">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</del></span> @else <span class="price">@if(session()->get('lang')=='bangla'){{convertToBanglaNumber($selling_price)}}  @elseif(session()->get('lang')=='english') {{$selling_price}} @else {{convertToBanglaNumber($selling_price)}} @endif</span> @endif
                                </div>
                                <!-- End product price -->
                                <!--Product Review-->
                                <?php
                                    $getMostPopular=App\ProductRating::with('product')->where('product_id',$data['id'])->get();
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
                                <div class="product-review">
                                    <?php
                                        $star=1;
                                        while ($star <= 5) {?>
                                        <i class="font-13 fa fa-star"></i>
                                        <?php $star++;
                                    }?>
                                    ({{$roundAvg}})
                                </div>
                                <!--End Product Review-->
                                
                                
                                <!-- Product Sizes -->
                                <div class="swatch clearfix swatch-1 option2" data-option-index="1">
                                    <div class="product-form__item">
                                       <!-- Your Blade template code -->
                                    @foreach($productSizes as $key => $size)
                                        <div data-value="{{$size['weight_size']}}" class="swatch-element xs available">
                                            <input class="swatchInput" id="swatch-{{$key}}" type="radio" name="w_size" value="{{$size['weight_size']}}">
                                            <label class="swatchLbl" name="title" for="swatch-{{$size['weight_size']}}" title="{{$size['weight_size']}}">
                                                {{$size['weight_size']}}
                                            </label>
                                        </div>
                                    @endforeach
                                    </div>
                                </div>
                                <!-- End Product Sizes -->
                            </div>
                            <!-- End product details -->
                        </div>
                        @endforeach
                    </div>
                </div>
                <!--End Product Grid-->
                @endif
			</div>
			<!--End Main Content-->
		</div>
    
    </div>
    <!--All Panjabi  End Here-->
    
       







    
    
    
    
    
    
    
    
     
    




        
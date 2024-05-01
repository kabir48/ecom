    <?php
      use App\Product;
      $currentDateTime = Carbon\Carbon::now();
    ?>

    @forelse($categoryPro as $data)
    <div class="col-6 col-sm-6 col-md-4 col-lg-4 item">
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
                <img class="primary blur-up lazyload" data-src="{{asset($data['image_one'])}}" src="{{asset($data['image_one'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}"  style="height:310px">
                <!-- End image -->
                <!-- Hover image -->
                <img class="hover blur-up lazyload" data-src="{{asset($data['image_two'])}}" src="{{asset($data['image_two'])}}" alt="{{$data['product_name']}}" title="{{$data['product_name']}}" style="height:310px">
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
                {{$getIp->currency}} @if($discounted_price>0) <span class="price">{{$discounte}}&nbsp;&nbsp;<del style="color:red">{{$selling_price}}</del></span> @else <span class="price">{{$selling_price}}</span> @endif
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
                    <label class="swatchLbl medium" for="swatch-1-{{$key}}" title="{{$size['weight_size']}}">{{$size['weight_size']}}</label>
                </div>
                @endforeach                  
                </div>
            </div>
        </div>
        <!-- End product details -->
    </div>
    
   @empty
   <h3>No Products</h3>
                            
   @endforelse
    
    
    
    
    
    
    
    
    
                             
   










  



    <!--========== Introducing Kids Area===========-->
   
    @if($sectionKidCount>0)
    
    <div class="product_area">
         <!-- Full Summer Set Product -->
        <div class="porduct_wrapper">
            <div class="container">
                <!-- Products Header -->
                <div class="product_wrpper_hearder row">
                    <div class="col-sm-6 col-10">
                        <h2 class="prw_title">{{Str::upper('Category For')}} {{Str::upper($getSectionkidId->name)}}</h2>
                    </div>
                </div>
            </div>

            <!-- Full summer set carousel -->
            <div class="full-summer-set-carousel product_inner owl-carousel owl-theme PB10">
                @foreach($getkidCategory as $data)
                <div class="item carousel-box">
                    <a href="{{url('category-products/'.$data['url'])}}">
                        <img src="{{asset('public/media/category/large/'.$data['image'])}}" alt="Carousel Image" class="img-fluid w-100">
                        <h4 class="image_h2_hover">{{$data['category_name']}}</h4>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
    <!-----=====All Events For Kids=====----->
    <div class="product_area">
        <div class="container">
            @if(count($allEvents)>0)
            @foreach($allEvents as $event)
            <div class="porduct_wrapper">
                <?php
                    $chunkProductMode=App\Product::where('status',1)->where('section_id',$getSectionKidId->id)->where('occasional',$event['id'])->select('product_mode')->groupBy('product_mode')->orderBy('id','DESC')->inRandomOrder()->get()->toArray();
                    //$allChunk=array_chunk($chunkProductMode,4);
                ?>
                @foreach($chunkProductMode as $mode)
                <?php
                    $arrayChunk=array();
                    if(!empty($mode['product_mode'])){
                        $arrayChunk=App\Product::where('status',1)->where('section_id',$getSectionKidId->id)->where('occasional',$event['id'])->where(['product_mode'=>$mode['product_mode']])->get()->toArray();
                    }
                ?>
                <!-- Products Header -->
                <div class="product_wrpper_hearder row">
                    <div class="col-sm-6 col-10">
                        <h2 class="prw_title">{{Str::upper($event['name'])}} &nbsp;{{Str::upper('collections')}}</h2>
                        <h4 class="prw_sub_tilte">{{Str::upper($mode['product_mode'])}}</h4>
                    </div>
                    <div class="col-sm-6 col-2">
                        <a target="_blank" href="{{url('/single-event/'.$event['name'])}}"  class="cbtn ms-auto">
                            <span class="d-sm-inline-block d-none">See all</span>
                            <i class="fal fa-angle-right d-sm-none"></i>
                        </a>
                    </div>
                </div>

                <!-- Products Inner -->
                <div class="product_inner summer-collections-slider owl-carousel owl-theme owl-loaded PB10">
                    @foreach($arrayChunk as $row)
                    <?php
                        //$discounted_price=App\Product::getProductdiscount($data['id']);
                        $total_stock=App\AttributeProduct::where('product_id',$row['id'])->sum('stock');
                        $qty=App\Product::where('id',$row['id'])->where('status',1)->sum('product_quantity');
                        $productSizes =App\AttributeProduct::with('product')->where('product_id',$row['id'])->where('status',1)->get()->toArray();
                        $productColor =App\AttributeProduct::where('product_id',$row['id'])->where('status',1)->first();
                    ?>
                    <div class="product_box item quick_product_data @if($qty == 0 || $total_stock==0) product-disable @else   @endif">
                        <div class="productVariations">
                            @foreach($productSizes as $key=>$data)
                            <?php
                                $discounted_price=App\Product::getProductdiscount($data['product']['id']);
                                $name=preg_replace('/\s+/', '', $data['product']['product_name']);
                            ?>
                  
                            <div class="productVariation" id="variation-id-{{$key+1}}">
                                        <!-- product Image box -->
                                <div class="image_box">
                                    @if($discounted_price>0)
                                    <h4 class="product_tag">{{Str::ucfirst('on sale')}}</h4>
                                    @else
                                    <h4 class="product_tag">{{Str::ucfirst('New')}}</h4>
                                    @endif
                                    <!--<button class="product-wish wish"><i class="fas fa-heart"></i></button>-->
                                    <a href="{{url('product/details/'.$data['product']['id'].'/'.$name)}}">
                                        <span class="uploadedImage">
                                            <img src="{{asset('public/media/product/multiple/medium/'.$data['product_images'])}}" alt="Product Image" class="product_image" >
                                        </span>
                                    </a>
                                    <input class="form-control input-number qty_cart" type="hidden" value="1">
                                    <input type="hidden" value="{{$data['product']['id']}}" class="product_id_cart">

                                    <div class="addtocardbox">
                                        <button class="quick_add addToCartProduct">
                                            <i class="far fa-plus"></i>
                                            <span>Quick Add</span>
                                        </button>
                                        <ul class="productsize">
                                            @if(count($productSizes)>0)
                                            @foreach($productSizes as $size)
                                            @if($size['stock'] > 0 && !empty($size['color']))
                                                <li class="li_weight_size">
                                                    <input type="radio" class="size_cart addToCartProduct" name="w_size_cart" value="{{$size['weight_size']}}">
                                                    <span>{{$size['weight_size']}}</span>
                                                </li>
                                             @else
                                                <li class="li_weight_size">
                                                     <span>{{__('Restricted')}}</span>
                                                </li>
                                            @endif    
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!-- Product Content Box -->
                                <div class="product_meta_box">
                                    <h4 class="product_color product_color_name">{{$data['color']}}</h4>
                                    <a href="{{url('product/details/'.$data['product']['id'].'/'.$name)}}">
                                        <h2 class="product_title">{{$data['product']['product_name']}}</h2>
                                    </a>
                                    <?php
                                        $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                        $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                        if($currencieCount>0){
                                            $amount= $currencies->exchange_rate;
                                            $selling_price=$data['price'] * $amount;
                                            $discounte=$discounted_price * $amount;
                                        }else{
                                            $selling_price=$data['price'];
                                             $discounte=$discounted_price ;
                                        }
                                    ?>
                                    <h4 class="product_price">{{getIp()->currency}} @if($discounted_price>0)<span>{{$discounte}}</span>&nbsp;&nbsp;<del style="color:red">{{$selling_price}}</del> @else <span>{{$selling_price}}</span> @endif</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <ul class="colorVariations">
                            @foreach($productSizes as $key=>$color)
                            @if($size['stock']>0)
                                <li style="background-color: {{$color['color']}};" class="li" data-product-variation-id="variation-id-{{$key+1}}" value="{{$color['color']}}">
                                    <input type="radio" name="color_cart" class="color_cart" value="{{$color['color']}}" style="width: 20px;height: 20px;">
                                </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
            @endforeach
            </div>
            @endforeach
            @endif
        </div>
    </div>
    
    <!-----=====All Events For Kids End=====----->
    
        
    <!--==========Category Product area For The Kids ===========-->
    
    <div class="product_area">
        <div class="container">
            <div class="porduct_wrapper">
                @foreach($getParentKidCat as $row) 
                <div class="product_wrpper_hearder row">
                    <div class="col-sm-6 col-10">
                        <h2 class="prw_title">{{Str::upper($row['category_name'])}}</h2>
                    </div>
                    <div class="col-sm-6 col-2">
                        <a href="{{url('category-products/'.$row['url'])}}" class="cbtn ms-auto">
                            <span class="d-sm-inline-block d-none">See all</span>
                            <i class="fal fa-angle-right d-sm-none"></i>
                        </a>
                    </div>
                </div>
                    <?php
                        $catProductWomenMode=App\Product::where('status',1)->where('section_id',$getSectionKidId->id)->where('category_id',$row['id'])->get()->toArray();
                        //$allChunk=array_chunk($chunkProductMode,4);
                    ?>
                <!-- Products Inner -->
                <div class="product_inner summer-collections-slider owl-carousel owl-theme owl-loaded PB10">
                    @foreach($catProductKidMode as $data)
                        <?php
                            //$discounted_price=App\Product::getProductdiscount($data['id']);
                            $total_stock=App\AttributeProduct::where('product_id',$row['id'])->sum('stock');
                            $qty=App\Product::where('id',$row['id'])->where('status',1)->sum('product_quantity');
                            $productSizes =App\AttributeProduct::with('product')->where('product_id',$row['id'])->where('status',1)->get()->toArray();
                            $productColor =App\AttributeProduct::where('product_id',$row['id'])->where('status',1)->first();
                        ?>
                    <div class="product_box item quick_product_data @if($qty == 0 || $total_stock==0) product-disable @else   @endif">
                        <div class="productVariations">
                            @foreach($productSizes as $key=>$data)
                            <?php
                                $discounted_price=App\Product::getProductdiscount($data['product']['id']);
                                $name=preg_replace('/\s+/', '', $data['product']['product_name']);
                            ?>
                  
                            <div class="productVariation" id="variation-id-{{$key+1}}">
                                        <!-- product Image box -->
                                <div class="image_box">
                                    @if($discounted_price>0)
                                    <h4 class="product_tag">{{Str::ucfirst('on sale')}}</h4>
                                    @else
                                    <h4 class="product_tag">{{Str::ucfirst('New')}}</h4>
                                    @endif
                                    <!--<button class="product-wish wish"><i class="fas fa-heart"></i></button>-->
                                    <a href="{{url('product/details/'.$data['product']['id'].'/'.$name)}}">
                                        <span class="uploadedImage">
                                            <img src="{{asset('public/media/product/multiple/medium/'.$data['product_images'])}}" alt="Product Image" class="product_image" >
                                        </span>
                                    </a>
                                    <input class="form-control input-number qty_cart" type="hidden" value="1">
                                    <input type="hidden" value="{{$data['product']['id']}}" class="product_id_cart">

                                    <div class="addtocardbox">
                                        <button class="quick_add addToCartProduct">
                                            <i class="far fa-plus"></i>
                                            <span>Quick Add</span>
                                        </button>
                                        <ul class="productsize">
                                            @if(count($productSizes)>0)
                                            @foreach($productSizes as $size)
                                            @if($size['stock'] > 0 && !empty($size['color']))
                                                <li class="li_weight_size">
                                                    <input type="radio" class="size_cart addToCartProduct" name="w_size_cart" value="{{$size['weight_size']}}">
                                                    <span>{{$size['weight_size']}}</span>
                                                </li>
                                             @else
                                                <li class="li_weight_size">
                                                     <span>{{__('Restricted')}}</span>
                                                </li>
                                            @endif    
                                            @endforeach
                                            @endif
                                        </ul>
                                    </div>
                                </div>
                                <!-- Product Content Box -->
                                <div class="product_meta_box">
                                    <h4 class="product_color product_color_name">{{$data['color']}}</h4>
                                    <a href="{{url('product/details/'.$data['product']['id'].'/'.$name)}}">
                                        <h2 class="product_title">{{$data['product']['product_name']}}</h2>
                                    </a>
                                    <?php
                                        $currencies=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->first();
                                        $currencieCount=App\CurrencyConverter::where('status',1)->where('currency_code',$getIp->currency)->count();
                                        if($currencieCount>0){
                                            $amount= $currencies->exchange_rate;
                                            $selling_price=$data['price'] * $amount;
                                            $discounte=$discounted_price * $amount;
                                        }else{
                                            $selling_price=$data['price'];
                                             $discounte=$discounted_price ;
                                        }
                                    ?>
                                    <h4 class="product_price">{{getIp()->currency}} @if($discounted_price>0)<span>{{$discounte}}</span>&nbsp;&nbsp;<del style="color:red">{{$selling_price}}</del> @else <span>{{$selling_price}}</span> @endif</h4>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <ul class="colorVariations">
                            @foreach($productSizes as $key=>$color)
                            @if($size['stock']>0)
                                <li style="background-color: {{$color['color']}};" class="li" data-product-variation-id="variation-id-{{$key+1}}" value="{{$color['color']}}">
                                    <input type="radio" name="color_cart" class="color_cart" value="{{$color['color']}}" style="width: 20px;height: 20px;">
                                </li>
                            @endif
                            @endforeach
                        </ul>
                    </div>
                    @endforeach
                </div>
                @endforeach
            </div>
        </div>
    </div>
    
     <!--==========Category Product area For The Kids End ===========-->
    
    @endif
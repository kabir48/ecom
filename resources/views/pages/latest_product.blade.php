@extends('layouts.app')
@section('content')
    <main>
     <!--========== Product area ===========-->
    <div class="product_area mt_40">
        <div class="container">
            <div class="porduct_wrapper">
                @foreach($getSection as $section)
                <?php
                    $getCategory=App\Model\Admin\Category::where('status',1)->where('section_id',$section['id'])->select('id','category_name')->orderBy('id','DESC')->get()->toArray();
                        //dd($getpros);
                ?>
                <div class="product_wrpper_hearder row">
                    <div class="col-sm-6 col-10">
                        <h2 class="prw_title">{{Str::upper($section['name'])}}</h2>
                    </div>
                </div>
                @foreach($getCategory as $category)
                <?php
                   $getpros=array();
                        if(!empty($category['id'])){
                            $getpros=App\Product::where('category_id',$category['id'])->where('section_id',$section['id'])->inRandomOrder()->where('is_feature','Yes')->latest()->get()->toArray();
                        }
                           
                   ?>       
                    
                   <h4 class="prw_sub_tilte">{{$category['category_name']}}</h4>
                    <!-- Products Inner -->
                    <div class="product_inner summer-collections-slider owl-carousel owl-theme owl-loaded PB10">
                        @foreach($getpros as $key=>$row)
                         <?php
                            //$discounted_price=App\Product::getProductdiscount($data['id']);
                            $total_stock=App\AttributeProduct::where('product_id',$row['id'])->sum('stock');
                            $qty=App\Product::where('id',$row['id'])->where('status',1)->sum('product_quantity');
                            $productSizes =App\AttributeProduct::with('product')->where('product_id',$row['id'])->where('status',1)->get()->toArray();
                            $productColor =App\AttributeProduct::with('product')->where('product_id',$row['id'])->where('status',1)->first();
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
                                            @if($data['product_images'])
                                            <img src="{{asset('public/media/product/multiple/medium/'.$data['product_images'])}}" alt="{{$data['product']['product_name']}}" class="product_image" >
                                            @else
                                            <img src="https://raselislam.com/public/image/defualt-product.png" alt="Product Image" class="product_image" >
                                            @endif
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
                @endforeach
            </div>
           
        </div>
    </div>   
    </main>
    
        <script type="text/javascript">
        $('.product_area .product_inner .product_box .productVariations').children().first().addClass('active');        
        var productVariations = $('.product_area .product_inner .product_box').children('.productVariations');  
        productVariations.each(function(i) {
            $(this).children().first().addClass('active');
        });  
        var colorVariations = $('.product_area .product_inner .product_box').children('.colorVariations');  
        colorVariations.each(function(i) {
            $(this).children().first().addClass('active');
        });  
        $(document).ready(function () {
            $('.product_area .product_inner .colorVariations li').click(function () {
                var productVariationId ="#" + $(this).data('product-variation-id');
                $(this).parent().parent().children().first().children().removeClass('active');
                $(this).parent().parent().children('.productVariations').children(productVariationId).addClass('active');
                $(this).parent().children().removeClass('active');
                $(this).addClass('active');
            });
        });

    </script>
    @endsection
    

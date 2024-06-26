@extends('layouts.app')
@section('content')
    <link href="{{asset('public/frontend/assets/css/single.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('public/frontend/assets/css/kits-new-store.css')}}" rel="stylesheet" type="text/css" />
    <?php
        use App\Product;
        $currentDateTime = Carbon\Carbon::now();
    ?>
    <main style="margin-top:30px">
        <div class="product_area mb_50 mt_30">
            <div class="container">
                <div class="porduct_wrapper">
                    <div class="product_wrpper_hearder row">
                        <div class="col-sm-6 col-10">
                            <h2 class="prw_title"><h2><?php echo Str::ucfirst($brandingDetails['breadcumbs']);?></h2></h2>
                        </div>
                    </div>
                    <div class="product_inner row">
                        @forelse($brandProducts as $row)
                           <?php
                                $total_stock=App\AttributeProduct::where('product_id',$row['id'])->sum('stock');
                                $qty=App\Product::where('id',$row['id'])->where('status',1)->sum('product_quantity');
                                $productSizes =App\AttributeProduct::with('product')->where('product_id',$row['id'])->where('status',1)->where('stock','>',0)->get()->toArray();
                            ?>
                        <div class="product_box col-lg-3 col-md-6 quick_product_data">
                            <div class="productVariations">
                                @foreach($productSizes as $key=>$data)
                                <?php
                                    $discounted_price=App\Product::getProductdiscount($data['product']['id']);
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
                                        <a href="{{url('product/details/'.$data['product']['id'].'/'.$data['product']['product_name'])}}">
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
                                        <a href="{{url('product/details/'.$data['product']['id'].'/'.$data['product']['product_name'])}}">
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
                                        <h4 class="product_price">{{getIp()->currency}} @if($discounted_price>0)<span>{{$discounted_price}}</span>&nbsp;&nbsp;<del style="color:red">{{$selling_price}}</del> @else <span>{{$selling_price}}</span> @endif</h4>
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
                        @empty
                        <h3>No Products</h3>
                        @endforelse
                    </div>
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
    
    
    
    
    
    
    
    



    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
   


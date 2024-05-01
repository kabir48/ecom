<?php
    use App\Product;
    $clientIP = \Request::ip();
    $getIp=geoip()->getLocation($clientIP=null);
?>
            <div class="col-xxl-9">
                    <div class="cart-table my-5" >
                        <div class="table-responsive-xl">
                            <table class="table">
                                <tbody>
                                     <?php $total_price = 0; ?>
                                       @foreach($userCartItems as $item)
                                        <?php
                                            $attrPrice=Product::getDiscountedAttrPrice($item['product_id'],$item['weight_size']);
                                            $name=preg_replace('/\s+/', '', $item['product']['product_name']);
                                        ?>
                                        <tr class="product-box-contain">
                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href="{{url('product/details/'.$item['product']['id'].'/'.$name)}}" class="product-image" style="text-decoration: none;">
                                                    <img src="{{asset($item['product']['image_one'])}}"
                                                        class="img-fluid blur-up lazyload" alt="">
                                                </a>
                                                <div class="product-detail">
                                                    <ul>
                                                        <li class="name">
                                                            <a style="text-decoration: none;" href="{{url('product/details/'.$item['product']['id'].'/'.$name)}}">{{$item['product']['product_name']}}</a>
                                                        </li>
                                                        <?php 
                                                            $discounted_price=App\Product::getProductdiscount($item['product_id']);
                                                        ?>
                                                        

                                                        <li class="text-content"><span
                                                                class="text-title">@if(session()->get('lang')=='bangla') {{__('heading.size_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.size_en')}} @else  {{__('heading.size_bn')}} @endif</span> - {{$item['weight_size']}}</li>

                                                        <li>
                                                            <h5 class="text-content d-inline-block">@if(session()->get('lang')=='bangla') {{__('heading.price_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.price_en')}} @else  {{__('heading.price_bn')}} @endif :</h5>
                                                            @if($discounted_price>0)
                                                            <span style="color:red">@if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}}{{convertToBanglaNumber($discounted_price)}}  @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{$discounted_price}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber($discounted_price)}} @endif</span>
                                                            @else
                                                            <span class="text-content">{{$attrPrice['selling_price']}}</span>
                                                            @endif
                                                        </li>
                                                         <?php $total_price= $total_price + ($attrPrice['final_price']*$item['quantity']);?>
                                                        <li>
                                                            <h5 class="saving theme-color">Saving : <?php echo  $attrPrice['selling_price'] - $discounted_price; ?></h5>
                                                        </li>

                                                        <li class="quantity-price-box">
                                                            <div class="cart_qty">
                                                                <div class="input-group">
                                                                    <button type="button" class="btn qty-left-minus"
                                                                        data-type="minus" data-field="">
                                                                        <i class="fa fa-minus ms-0"
                                                                            aria-hidden="true"></i>
                                                                    </button>
                                                                    <input class="form-control input-number qty-input"
                                                                        type="text" name="quantity" value="0">
                                                                    <button type="button" class="btn qty-right-plus"
                                                                        data-type="plus" data-field="">
                                                                        <i class="fa fa-plus ms-0"
                                                                            aria-hidden="true"></i>
                                                                    </button>
                                                                </div>
                                                            </div>
                                                        </li>

                                                        <li>
                                                            <h5>Total:{{$attrPrice['final_price']*$item['quantity']}}</h5>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="price">
                                            <h4 class="table-title text-content">@if(session()->get('lang')=='bangla') {{__('heading.price_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.price_en')}} @else  {{__('heading.price_bn')}} @endif </h4>
                                           @if($discounted_price>0) <h5> @if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}}{{convertToBanglaNumber($discounted_price)}}  @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{$discounted_price}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber($discounted_price)}} @endif <del class="text-content">@if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['selling_price'])}} @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{$attrPrice['selling_price']}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['selling_price'])}} @endif </del></h5>
                                           <h6 class="theme-color">@if(session()->get('lang')=='bangla') {{__('heading.Saved_price_bn')}} @elseif(session()->get('lang')=='english'){{__('heading.Saved_price_en')}} @else {{__('heading.Saved_price_bn')}} @endif :@if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['discount']*$item['quantity'])}} @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{$attrPrice['discount']*$item['quantity']}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['discount']*$item['quantity'])}} @endif </h6>
                                           @else 
                                           <h5>@if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['selling_price'])}}  @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{$attrPrice['selling_price']}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['selling_price'])}} @endif </h5> 
                                           @endif
                                        </td>

                                        <td class="quantity">
                                            <h4 class="table-title text-content">@if(session()->get('lang')=='bangla'){{__("heading.qty_bn")}} @elseif(session()->get('lang')=='english') {{__("heading.qty_en")}} @else {{__("heading.qty_bn")}} @endif</h4>
                                            <div class="quantity-price">
                                                <div class="cart_qty">
                                                    <div class="input-group">
                                                        <input class="form-control input-number qty-input" type="text"
                                                            value="{{$item['quantity']}}" style="position: relative;left: -15px;">
                                                        <button type="button" class="btn qty-left-minus btnItemTwoUpdate qtyMinusTwo"
                                                            data-cartidtwo="{{$item['id']}}">
                                                            <i class="fa fa-minus ms-0" aria-hidden="true"></i>
                                                        </button>
                                                        <button type="button" class="btn qty-right-plus btnItemTwoUpdate qtyPlusTwo"
                                                            data-cartidtwo="{{$item['id']}}">
                                                            <i class="fa fa-plus ms-0" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>

                                        <td class="subtotal">
                                            <h4 class="table-title text-content">@if(session()->get('lang')=='bangla') {{__('heading.total_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.total_en')}} @else {{__('heading.total_bn')}} @endif</h4>
                                            <h5>@if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['final_price']*$item['quantity'])}} @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{$attrPrice['final_price']*$item['quantity']}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber($attrPrice['final_price']*$item['quantity'])}} @endif </h5>
                                        </td>

                                        <td class="save-remove">
                                            <h4 class="table-title text-content">@if(session()->get('lang')=='bangla') {{__("heading.action_bn")}} @elseif(session()->get('lang')=='english') {{__("heading.action_en")}} @else {{__("heading.action_bn")}} @endif</h4>
                                            <button style="border: none !important;" class="remove close_button btnItemDelete remove_cart_product" data-cartid="{{$item['id']}}">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        
                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">@if(session()->get('lang')=='bangla') {{__('heading.coupon_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.coupon_en')}} @else {{__('heading.coupon_bn')}} @endif</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <form action="javascript:void(0);" method="post" id="ApplyCoupon" @if(Auth::check()) user="1" @endif>
                                        @csrf
                                        <input type="search" placeholder="@if(session()->get('lang')=='bangla') {{__('heading.coupon_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.coupon_en')}} @else {{__('heading.coupon_bn')}} @endif" value="" id="code" class="form-control" name="code" required style="width:150px;height:50px">
                                        <button type="submit" value="Apply Coupon" name="apply_coupon" class="btn-apply" ><i class="fa-solid fa-magnifying-glass"></i></button>
                                    </form>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <h4>@if(session()->get('lang')=='bangla') {{__('heading.subtotal_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.subtotal_en')}} @else {{__('heading.subtotal_bn')}} @endif</h4>
                                    <h4 class="price">@if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}} {{convertToBanglaNumber($total_price)}} @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{$total_price}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber($total_price)}} @endif </h4>
                                </li>

                                <li>
                                    <h4>@if(session()->get('lang')=='bangla') {{__('heading.coupon_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.coupon_en')}} @else {{__('heading.coupon_bn')}} @endif</h4>
                                    <h4 class="price amount couponAmount">@if(Session::has('couponAmount')) - {{Session::get('couponAmount')}}@else 0 @endif</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>@if(session()->get('lang')=='bangla') {{__('heading.total_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.total_en')}} @else {{__('heading.total_bn')}} @endif</h4>
                                <h4 class="price theme-color amount grand_total">@if(session()->get('lang')=='bangla'){{__("heading.taka_bn")}} {{convertToBanglaNumber(($total_price) - Session::get('couponAmount'))}} @elseif(session()->get('lang')=='english') {{__("heading.taka_en")}} {{($total_price) - Session::get('couponAmount')}} @else {{__("heading.taka_bn")}} {{convertToBanglaNumber(($total_price) - Session::get('couponAmount'))}} @endif </h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href ='{{url('customer/user/checkout-pages')}}';"
                                        class="btn btn-animation proceed-btn fw-bold">@if(session()->get('lang')=='bangla') {{__('heading.checkout_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.checkout_en')}} @else {{__('heading.checkout_bn')}} @endif <i class="fa fa-arrow-right"></i></button>
                                </li>

                                <li>
                                    <button onclick="location.href = '{{url('/store-product/view')}}';"
                                        class="btn btn-light shopping-button text-dark">
                                        <i class="fa fa-arrow-left"></i>@if(session()->get('lang')=='bangla') {{__('heading.more_shopping_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.more_shopping_en')}} @else {{__('heading.more_shopping_bn')}} @endif</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {
                    	$(".currency").on('change', function(){
                    		var currency_code = $(this).val();
                    		var total_price=$(this).data("grand-total");
                            //alert(total_price)
                    		//alert(currency_code);
                            if(currency_code==""){
                    			alert("Please select Currency");
                    			return false;
                    		}
                    		
            		        $.ajax({
                                headers:{
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                url: "/currency-view",
                                type:'post',
                                data: {'total_price':total_price,'currency_code':currency_code},
                                success: function (resp) {
                                    $(".currencyName").text(currency_code +"   "+ resp.currencyName);
                                },
                            });
                	    });
                	});
                </script>
                
                <script>
                    $(document).ready(function(){
                       $("#ApplyCoupon").submit(function(){
                        var user = $(this).attr("user");
                          //alert(code);
                        if(user==1){
                           var code = $("#code").val(); 
                        }else{
                            alertify.set('notifier','position', 'top-right');
                            alertify.error("Please Login First To Apply Coupon"); 
                            return false;
                        }
                        $.ajax({
                                 headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data:{"code":code},
                                url:"/apply-coupon-code",
                                type:'post',
                                success:function(resp){
                                   if(resp.status===false){
                                    alert(resp.message);
                                    }else{
                                         alertify.set('notifier','position', 'top-right');
                                         alertify.success(resp.message);  
                                    }
                                    $(".totalCartItems").html(resp.totalCartItems);
                                    $("#appendCartItem").html(resp.view);
                                    $("#appendHeaderCartItem").html(resp.headerview);
                                    $("#appendHeaderCartItem").html(resp.deleteview);
                                    $("#appendHeaderCartItem").html(resp.loadview);
                                    if(resp.couponAmount>=0){
                                        $(".couponAmount").text("@if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif"+resp.couponAmount);
                                    }else{
                                        $(".couponAmount").text("");
                                    }
                                    if(resp.grand_total>=0){
                                    $(".grand_total").text("@if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif"+resp.grand_total);
                                    }
                                },error:function(){
                                 alert("Error");
                                }
                            });
                        });  
                    }); 
               </script>
               
            <script>
                 //=====Cart Items Update=====//
            $(document).on('click','.btnItemTwoUpdate',function(e){
             e.preventDefault();
             var cartidtwo = $(this).data('cartidtwo');
                if($(this).hasClass('qtyMinusTwo')){
                        // if qtyMinus button gets clicked by User
                    var quantityTwo = $(this).prev().val();
                    //alert(quantityTwo)
                    if(quantityTwo<=1){
                        alertify.set('notifier','position', 'top-right');
                        alertify.error("Item quantity must be 1 or greater!");
                            return false;
                        }else{
                            new_qty_two = parseInt(quantityTwo)-1;
                        }
                }
                    if($(this).hasClass('qtyPlusTwo')){
                        // if qtyPlus button gets clicked by User
                        quantityTwo = $(this).prev().prev().val();
                        new_qty_two = parseInt(quantityTwo)+1;
                    }
                    //alert(new_qty);
                    
                   // alert(cartidtwo)
                $.ajax({
                    headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        data:{"cartidtwo":cartidtwo,"new_qty_two":new_qty_two},
                        url:'{{url("/update-cart-item-two")}}',
                        type:'post',
                        success:function(resp){
                            if(resp.status===false){
                                alert(resp.message);
                            }else{
                              alertify.set('notifier','position', 'top-right');
                              alertify.success(resp.message);
                            }
                            $(".totalCartItems").html(resp.totalCartItems);
                            $("#appendCartItem").html(resp.view);
                            $("#appendHeaderCartItem").html(resp.headerview);
                            //$("#appendHeaderCartItem").html(resp.loadview);
    
                        },error:function(resp){
                            alert("Error");
                        }
                    });
                });
       
            </script>
               
    

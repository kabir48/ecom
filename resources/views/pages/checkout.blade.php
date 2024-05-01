   @extends('layouts.app')
   @section('content')
    
    <?php
    use App\Product;
    $curriency =App\CurrencyConverter::where('currency_code','=',$getIp->currency)->first();
    ?>
    <link href="{{asset('public/frontend/assets/css/cart.css')}}" rel="stylesheet" type="text/css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
 <style>
 
    a{
        text-decoration: none;
    }
    .footer .footer-top .h4 {
    font-weight: 600;
}
.footer-links a {
    font-size: 14px;
}
.display-table-cell p{
    font-size: 14px;
}
.btn {
    -moz-user-select: none;
    -ms-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: inline-block;
    width: auto;
    height: auto;
    text-decoration: none;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 0;
    padding: 8px 15px 8px;
    background-color: #000;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 1px;
    line-height: normal;
    white-space: normal;
    font-size: 13px;
    -ms-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
.btn-primary:hover {
    color: #fff;
    background-color: #5e5e5e;
    border-color: #0a58ca;
}
.btn:hover {
    color: #fff;
}
     .row{
        margin-top: 0 !important;
        margin-right:0px !important; 
        margin-left: 0 !important; 
    }
 

    .radio_form .currency {
        border: 2px solid #0da487;
        padding: 10px;
        font-size:15px;
    }
    
    .radio_form label{
        color: #0023ff;
        margin-bottom: 20px;
        font-size: 20px;
    }
  input[type=radio] {
    width: 29px !important;
    height: 32px !important;
}
   
 </style>
     <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>@if(session()->get('lang')=='bangla') {{__('heading.checkout_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.checkout_en')}} @else {{__('heading.checkout_bn')}} @endif</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">
                                        <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item">
                                    <a href="{{url('/product/cart-page')}}">
                                       @if(session()->get('lang')=='bangla') {{__('heading.cart_page_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.cart_page_en')}} @else {{__('heading.cart_page_bn')}} @endif
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@if(session()->get('lang')=='bangla') {{__('heading.checkout_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.checkout_en')}} @else {{__('heading.checkout_bn')}} @endif</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <form action="{{url('customer/user/checkout-pages')}}" method="post" id="checkoutForm" name="checkoutForm">
                @csrf
            <div class="row g-sm-4 g-3">
                
                    <div class="col-lg-6">
                        <div class="left-sidebar-checkout">
                            <div class="checkout-detail-box">
                                <ul>
                                    <li>
                                        <div class="checkout-icon">
                                            <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                                trigger="loop-on-hover"
                                                colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                                class="lord-icon">
                                            </lord-icon>
                                        </div>
                                        <div class="checkout-box">
                                            <div class="checkout-title">
                                                <h4>@if(session()->get('lang')=='bangla') {{__('heading.shipping_address_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.shipping_address_en')}} @else {{__('heading.shipping_address_bn')}} @endif</h4>
                                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addressModal" data-bs-whatever="@getbootstrap">@if(session()->get('lang')=='bangla') {{__('heading.new_shipping_address_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.new_shipping_address_en')}} @else {{__('heading.new_shipping_address_bn')}} @endif</button>
                                                
                                            </div>
    
                                            <div class="checkout-detail">
                                                <div class="row g-4">
                                                    <?php
                                                       //dd($deliveryAddresses)
                                                    ?>
                                                    @foreach($deliveryAddresses as $item)
                                                    
                                                     <div class="col-xxl-6 col-lg-12 col-md-12 col-12">
                                                        <div class="delivery-address-box">
                                                            <div>
                                                                <div class="form-check">
                                                                  <input @if(isset($item['shipping_charges'])) type="radio" @endif id="shipping{{$item['id']}}" class="form-check-input" name="shipping_id" value="{{$item['id']}}" shipping_charges="{{$item['shipping_charges']??""}}" total_price="{{$total_price}}" coupon_amount="{{Session::get('couponAmount')}}" pincodeCount="{{$item['pincodeCount']??""}}"><label for="address"></label>                                                            
                                                                
                                                                </div>
    
                                                                <div class="label">
                                                                    <label><a class="btn btn-sm add-button w-100" href="{{url('user/add-edit-shipping-address/'.$item['id'])}}">@if(session()->get('lang')=='bangla') {{__('heading.update_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.update_en')}} @else {{__('heading.update_bn')}} @endif</a><br></label>
                                                                </div>
    
                                                                <ul class="delivery-address-detail">
                                                                     <li>
                                                                        <h4 class="fw-500">{{$item['name']}}</h4>
                                                                    </li>
    
                                                                    <li>
                                                                        <p class="text-content"><span
                                                                                class="text-title">Phone
                                                                                : </span>{{$item['phone']}}</p>
                                                                    </li>
    
                                                                    <li>
                                                                        <h6 class="text-content"><span
                                                                                class="text-title">Full Adress:</span>{{$item['address']}}</h6>
                                                                    </li>
                                                                    @if($item['zip_code'])
                                                                     <li>
                                                                        <h6 class="text-content"><span
                                                                                class="text-title">Zip Code:</span>{{$item['zip_code']}}</h6>
                                                                    </li>
                                                                    @endif
    
                                                                    <li>
                                                                        <h6 class="text-content mb-0"><span
                                                                                class="text-title">Shipping Type
                                                                                :</span> {{$item['country']}}</h6>
                                                                    </li> 
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
    
                                    <li>
                                        <div class="checkout-icon">
                                            <lord-icon target=".nav-item" src="https://cdn.lordicon.com/oaflahpk.json"
                                                trigger="loop-on-hover" colors="primary:#0baf9a" class="lord-icon">
                                            </lord-icon>
                                        </div>
                                        <div class="checkout-box">
                                            <div class="checkout-title">
                                                <h4>@if(session()->get('lang')=='bangla') {{__('heading.payment_method_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.payment_method_en')}} @else {{__('heading.payment_method_bn')}} @endif</h4>
                                            </div>
    
                                            <div class="checkout-detail" >
                                                <div class="row g-4">
                                                    @if($getIp->country =='Bangladesh') 
                                                    <div class="col-xxl-6">
                                                        <div class="delivery-option">
                                                            <div class="delivery-category">
                                                                <div class="shipment-detail">
                                                                    <div
                                                                        class="form-check custom-form-check hide-check-box">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="payment_gateway" value="COD" id="standard" >
                                                                        <label class="form-check-label"
                                                                            for="standard">@if(session()->get('lang')=='bangla') {{__('heading.cod_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.cod_en')}} @else {{__('heading.cod_bn')}} @endif</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    @foreach($gateways as $key=>$gateway)
                                                    <div class="col-xxl-6">
                                                        <div class="delivery-option">
                                                            <div class="delivery-category">
                                                                <div class="shipment-detail">
                                                                    <div
                                                                        class="form-check custom-form-check hide-check-box">
                                                                        <input class="form-check-input" type="radio"
                                                                            name="payment_gateway" id="standard" value="{{$gateway->type}}" @if($key==0) checked @endif>
                                                                        <label class="form-check-label"
                                                                            for="standard">{{$gateway->title}}</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="col-lg-6">
                        <div class="right-side-summery-box">
                            <div class="summery-box-2">
                                <div class="summery-header">
                                    <h3>@if(session()->get('lang')=='bangla') {{__('heading.order_summary_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.order_summary_en')}} @else {{__('heading.order_summary_bn')}} @endif</h3>
                                </div>
    
                                <ul class="summery-contain">
                                    <?php $total_price = 0; ?>
                                    @foreach($userCartItems as $item)
                                            <?php
                                               $attrPrice=Product::getDiscountedAttrPriceSize($item['product_id'],$item['weight_size']);
                                                
                                            ?>
                                    <?php $total_price= $total_price + ($attrPrice['final_price']*$item['quantity']);?>
                                    @if($getIp->country !='Bangladesh')         
                                    <li>
                                         
                                        <img src="{{asset($item['product']['image_one'])}}"
                                            class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>{{$item['product']['product_name']}} <span>X {{$item['quantity']}}</span></h4>
                                        <h4 class="price">
                                            @if($attrPrice['discount']>0)
                                            @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif{{$attrPrice['discount']*$item['quantity']*$curriency->exchange_rate}}
                                            @else
                                            @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}} @endif{{$attrPrice['selling_price']*$item['quantity']*$curriency->exchange_rate}}
                                            @endif
                                        </h4>
                                    </li>
                                    @else
                                    <li>
                                         
                                        <img src="{{asset($item['product']['image_one'])}}"
                                            class="img-fluid blur-up lazyloaded checkout-image" alt="">
                                        <h4>{{$item['product']['product_name']}} <span>X {{$item['quantity']}}</span></h4>
                                        <h4 class="price">
                                            @if($attrPrice['discount']>0)
                                            @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}}@endif{{$attrPrice['final_price']*$item['quantity']}}
                                            @else
                                            @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}}@endif{{$attrPrice['selling_price']*$item['quantity']}}
                                            @endif
                                        </h4>
                                    </li>
                                    @endif
                                    @endforeach
                                </ul>
    
                                <ul class="summery-total">
                                    <li>
                                        <h4>@if(session()->get('lang')=='bangla') {{__('heading.subtotal_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.subtotal_en')}} @else {{__('heading.subtotal_bn')}} @endif</h4>
                                        
                                        @if($getIp->country !='Bangladesh')   
                                        <h4 class="price">{{$getIp->currency}}.{{$subtotatal= $total_price*$curriency->exchange_rate}} <?php Session::put('subtotatal',$subtotatal); ?></h4>
                                        @else
                                        <h4 class="price">@if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}}@endif{{$subtotatal= $total_price}} <?php Session::put('subtotatal',$subtotatal); ?></h4>
                                        @endif
                                      
                                    </li>
    
                                    <li>
                                        <h4>@if(session()->get('lang')=='bangla') {{__('heading.shipping_charge_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.shipping_charge_en')}} @else {{__('heading.shipping_charge_bn')}} @endif</h4>
                                        <h4 class="price shipping_charges"> <span id="charge"></span></h4>
                                    </li>
                                    
                                    <li id="coupon" style="display:none;">
                                        <h4>@if(session()->get('lang')=='bangla') {{__('heading.coupon_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.coupon_en')}} @else {{__('heading.coupon_bn')}} @endif</h4>
                                       
                                        <h4 class="price couponAmount">{{$getIp->currency}} {{Session::get('couponAmount')}}</h4>
                                    </li>
                                   @if($getIp->country !='Bangladesh') 
                                    <li class="list-total">
                                        <h4>Total</h4>
                                        <h4 class="price amount grand_total" >
                                        <?php
                                            
                                            $grand_total=($total_price ) - Session::get('couponAmount')*$curriency->exchange_rate;
                                            //dd($grand_total);
                                        ?> 
                                        {{$getIp->currency}}.{{$grand_total}} 
                                        <?php Session::put('grand_total',$grand_total);?>
                                        </h4>
                                    </li>
                                    @else
                                     <li class="list-total">
                                        <h4>@if(session()->get('lang')=='bangla') {{__('heading.total_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.total_en')}} @else {{__('heading.total_bn')}} @endif</h4>
                                        <h4 class="price amount grand_total" >
                                         @if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}}@endif{{$grand_total=$total_price - Session::get('couponAmount')}} 
                                         
                                        <?php Session::put('grand_total',$grand_total); ?>
                                        </h4>
                                    </li>
                                    @endif
                                </ul>
                            </div>
    
                            <div class="checkout-offer">
                                <div class="offer-title">
                                    <div class="offer-icon">
                                       <input class="form-check-input" type="checkbox" value="check" name="check"><p style="font-size:13px">@if(session()->get('lang')=='bangla'){{__('heading.agree_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.agree_en')}} @else {{__('heading.agree_bn')}} @endif</p>
                                    </div>
                                </div>
                            </div>
    
                            <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold">@if(session()->get('lang')=='bangla') {{__('heading.place_order_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.place_order_en')}} @else {{__('heading.place_order_bn')}} @endif</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <!-- Checkout section End -->
    <div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addressModalLabel">@if(session()->get('lang')=='bangla') {{__('heading.shipping_address_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.shipping_address_en')}} @else {{__('heading.shipping_address_bn')}} @endif</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form class="form-my-account" method="POST" action="{{url('user/add-edit-shipping-address')}}">
                @csrf
           
                <div class="mb-3">
                    <label for="recipient-name" class="col-form-label">@if(session()->get('lang')=='bangla') {{__('heading.address_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.address_en')}} @else {{__('heading.address_bn')}} @endif:</label>
                    <textarea type="text" placeholder="@if(session()->get('lang')=='bangla') {{__('heading.address_bn')}} @elseif(session()->get('lang')=='english')@else {{__('heading.address_bn')}} @endif" class="form-control" name="address" value="{{old('address')}}" required/></textarea>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">@if(session()->get('lang')=='bangla') {{__('heading.area_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.area_en')}} @else {{__('heading.area_bn')}} @endif:</label>
                    <input type="text" placeholder="@if(session()->get('lang')=='bangla') {{__('heading.area_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.area_en')}} @else {{__('heading.area_bn')}} @endif" class="form-control" name="area"  value="{{old('area')}}" required>
                </div>
                <div class="mb-3">
                    <label for="message-text" class="col-form-label">@if(session()->get('lang')=='bangla') {{__('heading.zip_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.zip_en')}} @else {{__('heading.zip_bn')}} @endif:</label>
                    <input type="text" placeholder="@if(session()->get('lang')=='bangla') {{__('heading.zip_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.zip_en')}} @else {{__('heading.zip_bn')}} @endif" class="form-control" name="zip_code"  value="{{old('zip_code')}}"/>
                </div>
                <div class="mb-3">
                    <select name="country" id="country" class="form-control">
                        <option value="">@if(session()->get('lang')=='bangla') {{__('heading.shipping_type_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.shipping_type_en')}} @else {{__('heading.shipping_type_bn')}} @endif</option>
                     
                        <option value="inside_dhaka" <?php if(request()->country=="inside_dhaka"){echo "selected";}?>>@if(session()->get('lang')=='bangla') {{__('heading.inside_dhaka_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.inside_dhaka_en')}} @else {{__('heading.inside_dhaka_bn')}} @endif</option>
                        <option value="outside_dhaka" <?php if(request()->country=="outside_dhaka"){echo "selected";}?>>@if(session()->get('lang')=='bangla') {{__('heading.outside_dhaka_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.outside_dhaka_en')}} @else {{__('heading.outside_dhaka_bn')}} @endif</option>
                    </select>
                </div>
                
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                
            </form>
          </div>
        </div>
      </div>
    </div>
    
    <script>
        $(document).on('click','.shippingAddress',function(){
            var result= confirm("Want to delete this Address?");
            if(!result){
                return false;
            }
        });
    </script>
    
        <script type="text/javascript">
        $(document).ready(function() {
        	$(".currency").on('change', function(){
        		var currency_code = $(this).val();
        		//alert(currency_code);
                if(currency_code==""){
        			alert("Please select Currency");
        			return false;
        		}
            		
            	var shipping_charges=$("input[name='shipping_id']:checked").attr("shipping_charges");
        //     	if(shipping_charges==""){
        //     	    alert("Please select Address");
        // 			return false;
        //     	}
                var total_price=$(this).data("grand-total");
                var grand_total =parseInt(total_price) + parseInt(shipping_charges);
                alert(grand_total)
    	
    	    });
    	});
    </script>
    
  @if($getIp->country !='Bangladesh')
     <script>
        $("input[name=shipping_id]").bind('change',function(){
            var shipping_charges=$(this).attr("shipping_charges");
            var total_price=$(this).attr("total_price");
            var coupon_amount=$(this).attr("coupon_amount");
            $(".shipping_charges").html("{{$getIp->currency}}."+shipping_charges);
            var pincodeCount=$(this).attr("pincodeCount");
            
            if(pincodeCount>0){
                $(".pinCodeBlock").show();
             }else{
                 $(".pinCodeBlock").hide(); 
            }
            
            if(coupon_amount==""){
                coupon_amount=0;
            }
     
           $('.couponAmount').html("{{$getIp->currency}}."+coupon_amount)
           var sum=parseInt(total_price) * parseInt(<?php echo $curriency->exchange_rate; ?>) 
           var charge=parseInt(shipping_charges) * parseInt(<?php echo $curriency->exchange_rate; ?>);
           var grand_total = sum + charge - parseInt(coupon_amount) * parseInt(<?php echo $curriency->exchange_rate; ?>) ;
           $(".grand_total").html("{{$getIp->currency}}."+grand_total);
           $("#charge").text("{{$getIp->currency}}"+charge);
        });
    </script>
    @else
      <script>
        $("input[name=shipping_id]").bind('change',function(){
            var shipping_charges=parseInt($(this).attr("shipping_charges"));
            var total_price=$(this).attr("total_price");
            var coupon_amount=$(this).attr("coupon_amount");
            $(".shipping_charges").html("@if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}}@endif"+shipping_charges);
            // var pincodeCount=$(this).attr("pincodeCount");
            
            // if(pincodeCount>0){
            //     $(".pinCodeBlock").show();
            //  }else{
            //      $(".pinCodeBlock").hide(); 
            // }
            
           if(coupon_amount===""){
                coupon_amount=0;
                $("#coupon").hide()
            }else{
                $("#coupon").show()
            }
       
           $('.couponAmount').html("@if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}}@endif"+coupon_amount)
           var grand_total =parseInt(total_price) + parseInt(shipping_charges) - parseInt(coupon_amount);
           $(".grand_total").html("@if(session()->get('lang')=='bangla'){{__('heading.taka_bn')}}@elseif(session()->get('lang')=='english') {{__('heading.taka_en')}} @else {{__('heading.taka_bn')}}@endif"+grand_total);

        });
    </script>
    @endif
    
    

    @endsection

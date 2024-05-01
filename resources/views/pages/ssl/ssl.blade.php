@extends('layouts.app')
@section('content')
<?php
    $getPaypalCount=DB::table('payment_gateways')->where('status',1)->where('type','ssl')->count();
    $getPaypal=DB::table('payment_gateways')->where('status',1)->where('type','ssl')->first();
?>
     <main>
		<div class="form_area" style="margin-bottom: 28px !important;
    margin-top: 122px !important; ">
			<div class="container">
					<div class="row">
					<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                        <div class="jumbotron text-center">
                            <h1 class="display-3">Please Make Payment By Paypal</h1>
                            <hr>
                            <?php
                    			//$orderDetails = App\Order::getOrderDetails(Session::get('order_id'));
                    			// = json_decode(json_encode($orderDetails));
                    			/*echo "<pre>"; print_r($orderDetails); die;*/
                    			$orderDetails=App\ShippingAddress::where('order_id',Session::get('order_id'))->first();
                    		
                    			
                    		?>
                    			<input type="hidden" id="currency_code" name="currency_code" value="BDT">
                				<input type="hidden" id="total_amount" name="amount" value="{{ Session::get('grand_total') }}">
                				<input type="hidden" id="customer_name" name="first_name" value="{{ Auth::user()->name }}">
                				<input type="hidden" id="email" name="first_name" value="{{ Auth::user()->email }}">
                				<input type="hidden" id="mobile" name="last_name" value="{{ $orderDetails['phone'] }}">
                				<input type="hidden" id="address" name="address1" value="{{ $orderDetails->address }}">
                				<input type="hidden" id="cus_postcode" name="address1" value="{{ $orderDetails->zip_code }}">
                				<input type="hidden" id="cus_city" name="address1" value="{{ $orderDetails->city }}">
                				<input type="hidden" id="cus_state" name="address1" value="{{ $orderDetails->area}}">
                				<input type="hidden" id="cus_country" name="address1" value="{{ $orderDetails->country}}">
                				<input type="hidden" id="order_id" name="address2" value="{{Session::get('order_id')}}">
                            <p style="color:#0B7CBB; margin-top:50px">
                                   <input type="hidden" name="amount" value="{{round(Session::get('grand_total'),2)}}">
                                   <button id="sslczPayBtn"token="if you have any token validation" postdata="" order="{{Session::get('order_id')}}" endpoint="{{ url('/pay-via-ajax') }}"> Pay Now</button>
                             
                            </p>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- End Content Page -->
	  </main>
    <script>
        var obj = {};
        obj.cus_name = $('#customer_name').val();
        obj.cus_phone = $('#mobile').val();
        obj.cus_email = $('#email').val();
        obj.cus_addr1 = $('#address').val();
        obj.amount = $('#total_amount').val();
        obj.currency = $('#currency_code').val();
        obj.cus_postcode = $('#cus_postcode').val();
        obj.cus_state = $('#cus_state').val();
        obj.cus_city = $('#cus_city').val();
        obj.cus_country = $('#cus_country').val();
        obj.cus_country = $('#cus_country').val();
        obj.order_id = $('#order_id').val();
        
        $("#customer_name").change(function(){
            $('#customer_name').val();
        })
        
        $("#cus_phone").change(function(){
            $('#cus_phone').val();
        })
        
        $("#cus_email").change(function(){
            $('#cus_email').val();
        })
        
        $("#cus_addr1").change(function(){
            $('#cus_email').val();
        }) 
        
        $("#amount").change(function(){
            $('#amount').val();
        })
        
        $("#order_id").change(function(){
            $('#order_id').val();
        })
    
        $('#sslczPayBtn').prop('postdata', obj);
 
        
        (function (window, document) {
            var loader = function () {
                var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
                // script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR LIVE
                script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7); // USE THIS FOR SANDBOX
                tag.parentNode.insertBefore(script, tag);
            };
    
            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
        })(window, document);
        
     
        
      
    </script>	 
@endsection
 
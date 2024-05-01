@extends('layouts.app')
@section('content')

</style>
     <main>
		<div class="form_area" style="margin-bottom: 28px !important;
    margin-top: 122px !important;">
			<div class="container">
					<div class="row">
					<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                        <div class="jumbotron text-center">
                            <h1 class="display-3">@if(session()->get('lang')=='bangla'){{__("heading.thank_message_bn")}} @elseif(session()->get('lang')=='english') {{__("heading.thank_message_en")}} @else {{__("heading.thank_message_bn")}} @endif</h1>
                            <p class="lead">@if(session()->get('lang')=='bangla'){{__("heading.order_email_bn")}} @elseif(session()->get('lang')=='english') {{__("heading.order_email_en")}} @else {{__("heading.order_email_en")}} @endif</p>
                            <p class="lead"><strong>@if(session()->get('lang')=='bangla'){{__("heading.order_number_bn")}} : {{convertToBanglaNumber(Session::get('order_id'))}} @elseif(session()->get('lang')=='english') {{__("heading.order_number_en")}} : {{Session::get('order_id')}} @else {{__("heading.order_number_bn")}} : {{convertToBanglaNumber(Session::get('order_id'))}} @endif and 
                            @if(session()->get('lang')=='bangla'){{__("heading.total_bn")}} : {{__("heading.taka_bn")}} {{convertToBanglaNumber(Session::get('grand_total'))}} @elseif(session(session()->get('lang')=='english')->get('lang')=='english') {{__("heading.total_en")}} {{__("heading.taka_en")}} Session::get('grand_total') @else {{__("heading.total_bn")}} :{{__("heading.taka_bn")}} {{convertToBanglaNumber(Session::get('grand_total'))}} @endif</p>
                            <hr>
                            <br/>
                            <p class="lead">
                                <a class="btn btn-primary btn-sm" href="{{url('/customer/dashboard')}}" role="button">@if(session()->get('lang')=='bangla') {{__("heading.home_page_bn")}} @elseif(session()->get('lang')=='english') {{__("heading.home_page_en")}} @else {{__("heading.home_page_bn")}} @endif</a>
                            </p>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- End Content Page -->
	  </main>
	 
@endsection
    <?php
        Session::forget('grand_total');
        Session::forget('order_id');
        Session::forget('couponAmount');
        Session::forget('couponCode');
     ?>
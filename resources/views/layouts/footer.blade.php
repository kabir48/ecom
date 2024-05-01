    <?php
        use App\CartModal;
        use App\Product;
        use App\Model\Admin\Category;
        $setting=DB::table('sitesettings')->first();
        $settingCount=DB::table('sitesettings')->count();
        $cateDetail=Category::cateDetail();
        //echo"<pre>";print_r($cateDetail);die;
    ?>
    <style>
        .invalid-feedback{
            display:block !important;
        }
    </style>
    
    <!--====Footer=====-->
    <div class="footer footer-1">
        <div class="footer-top clearfix">
            <div class="container">
                <div class="row" style="justify-content: center">
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 about-us-col">
                        @if($settingCount>0)
                        <img src="{{asset('public/media/logo/'.$setting->logo)}}" alt="@if($settingCount>0) {{$setting->company_name}} @endif" title="@if($settingCount>0) {{$setting->company_name}} @endif"/>
                        @else
                        <img src="{{ asset('public/frontend/assets/images/avon-logo.svg') }}" alt="{{Config::get('app.name')}}" title="{{Config::get('app.name')}}"/>
                        @endif
                        <p><b>@if(session()->get('lang')=='bangla'){{__('heading.phone_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.phone_en')}} @else {{__('heading.phone_bn')}}@endif(One)</b>: {{$setting->phone_one}}</p>
                        <p><b>@if(session()->get('lang')=='bangla'){{__('heading.phone_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.phone_en')}} @else {{__('heading.phone_bn')}}@endif(Two)</b>: {{$setting->phone_two}}</p>
                        <p><b>@if(session()->get('lang')=='bangla'){{__('heading.email_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.email_en')}} @else {{__('heading.email_bn')}}@endif</b>: <a href="mailto:sales@yousite.com">{{$setting->email}}</a></p>
                        <ul class="list--inline social-icons">
                            @if(isset($setting->facebook))
                            <li><a href="{{$setting->facebook}}" target="_blank"><i class="fa-brands fa-facebook"></i></a></li>
                            @endif
                            @if(isset($setting->instagram))
                            <li><a href="{{$setting->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a></li>
                            @endif
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 footer-links">
                        <h4 class="h4">@if(session()->get('lang')=='bangla'){{__('heading.quick_shop_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.quick_shop_en')}} @else {{__('heading.quick_shop_bn')}}@endif</h4>
                        <ul>
                            @foreach($cateDetail as $data)
                             <li><a href="{{url('bigben-products/'.$data['url'])}}">@if(session()->get('lang')=='bangla') {{$data['bangla_name']}} @elseif(session()->get('lang')=='english') {{$data['category_name']}} @else {{$data['bangla_name']}} @endif</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 footer-links">
                        <h4 class="h4">@if(session()->get('lang')=='bangla'){{__('heading.information_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.information_en')}} @else {{__('heading.information_bn')}}@endif</h4>
                        <ul>
                            <li><a href="{{ url('/all-pages/'.'about') }}">@if(session()->get('lang')=='bangla'){{__('heading.about_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.about')}} @else {{__('heading.about_bn')}}@endif</a></li>
                            <li><a target="_blank" href="{{ url('/all-pages/'.'policy') }}">@if(session()->get('lang')=='bangla'){{__('heading.privacy_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.privacy_en')}} @else {{__('heading.privacy_bn')}}@endif</a></li>
                            <li><a target="_blank" href="{{url('/all-pages/'.'refund')}}">@if(session()->get('lang')=='bangla'){{__('heading.refund_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.refund_en')}} @else {{__('heading.refund_bn')}}@endif</a></li>
                            <li><a target="_blank" href="javascript:void(0);"><i class="fa-solid fa-universal-access"></i> @if(session()->get('lang')=='bangla'){{__('heading.today_visitor_bn')}} : {{convertToBanglaNumber(todayVisitor())}} @elseif(session()->get('lang')=='english') {{__('heading.today_visitor_en')}} : {{todayVisitor()}} @else {{__('heading.today_visitor_bn')}} : {{convertToBanglaNumber(todayVisitor())}}@endif</a></li>
                            <li><a target="_blank" href="javascript:void(0);"><i class="fa-solid fa-users-viewfinder"></i>  @if(session()->get('lang')=='bangla'){{__('heading.total_visitors_bn')}} : {{convertToBanglaNumber(totalVisitor())}} @elseif(session()->get('lang')=='english') {{__('heading.total_visitors_en')}} : {{totalVisitor()}} @else {{__('heading.total_visitors_bn')}} : {{convertToBanglaNumber(totalVisitor())}}@endif </a></li>
                            <li><button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#trackModal" data-bs-whatever="@fat">@if(session()->get('lang')=='bangla'){{__('heading.track_order_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.track_order_en')}} @else {{__('heading.track_order_bn')}}@endif</button></li>
                        </ul>
                    </div>
                    
                    <div class="col-12 col-sm-12 col-md-4 col-lg-3 newsletter-col">
                        <div class="display-table">
                            <div class="display-table-cell footer-newsletter">
                                 <form action="{{url('/user-newsletter-post') }}" method="post">
                                    @csrf
                                    <label class="h4">@if(session()->get('lang')=='bangla'){{__('heading.newsletter_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.newsletter_en')}} @else {{__('heading.newsletter_bn')}}@endif</label>
                                    <p>@if(session()->get('lang')=='bangla'){{__('heading.newsletter_offer_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.newsletter_offer_en')}} @else {{__('heading.newsletter_offer_bn')}} @endif</p>
                                    <div class="input-group">
                                        <input type="email" class="input-group__field newsletter-input" name="email" placeholder="@if(session()->get('lang')=='bangla'){{__('heading.email_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.email_en')}} @else {{__('heading.email_bn')}}@endif" required>
                                         @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                        <span class="input-group__btn">
                                            <button type="submit" class="btn newsletter__submit" id="Subscribe"><span class="newsletter__submit-text--large">@if(session()->get('lang')=='bangla'){{__('heading.subscribe_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.subscribe_en')}} @else {{__('heading.subscribe_bn')}}@endif</span></button>
                                        </span>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer-bottom clearfix">
            <div class="container">
                <ul class="payment-icons list--inline">
                    <li><i class="fa-brands fa-paypal"></i></li>
                    <li><i class="fa-brands fa-cc-visa"></i></li>
                </ul>
                <div class="copytext">
                    &copy; {{ date('Y') }} {{$setting->company_name}}. All Rights Reserved.Developed By <a target="_blank" href="https://ahumayunkabir.xyz/">Md.Humayun Kabir</a>
                </div>
                <a target="_blank" href="https://www.sslcommerz.com/" title="SSLCommerz" alt="SSLCommerz"><img style="width:300px;height:auto;" src="https://securepay.sslcommerz.com/public/image/SSLCommerz-Pay-With-logo-All-Size-01.png" /></a>
            </div>
        </div>
    </div>
   <!--=====End Footer=====-->

 

   
    <!--<div class="product-notification" id="dismiss">-->
    <!--    <span class="close" aria-hidden="true"><i class="fa-solid fa-xmark"></i></span>-->
    <!--    <div class="media">-->
    <!--        <img class="mr-2" src="{{ asset('public/frontend/assets/images/product-images/product8.jpg') }}" alt="Generic placeholder image" />-->
    <!--        <div class="media-body">-->
    <!--          <h5 class="mt-0 mb-1">Someone purchsed a</h5>-->
    <!--          <p class="pname">Lorem ipsum dolor sit amet</p>-->
    <!--          <p class="detail">14 Minutes ago from New York, USA</p>-->
    <!--        </div>-->
    <!--    </div>-->
    <!--</div>-->
    
    <!--====Tracking Products====-->
    <div class="modal fade" id="trackModal" tabindex="-1" aria-labelledby="trackModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="trackModalLabel">New message</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
            <form method="get" action="{{ route('order.tracking') }}">
                <div class="modal-body pd-20">
                    <div class="form-group radio_form">
                        <label for="exampleInputEmail1">Tracking Your Order</label>
                        <input type="text" name="code" required="" class="form-control radio_info" placeholder="Your Order Status Code">
                    </div>
                </div><!-- modal-body -->
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info pd-x-20">Submit</button>
                </div>
            </form>
          </div>
        </div>
      </div>
    </div>

  










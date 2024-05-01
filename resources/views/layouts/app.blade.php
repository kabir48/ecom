    @php
        $setting=DB::table('sitesettings')->first();
        $seo=DB::table('seo')->first();
        $getPaypalCount=DB::table('payment_gateways')->where('status',1)->where('type','ssl')->count();
        $getPaypal=DB::table('payment_gateways')->where('status',1)->where('type','ssl')->first();
    @endphp
    
    <!DOCTYPE html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <!-- Plugins CSS -->
        {!! SEOMeta::generate() !!}
        {!! OpenGraph::generate() !!}
        {!! Twitter::generate() !!}
        {!! JsonLd::generate() !!}
        <title>@yield('title', $setting->company_name)</title>
                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"/>

        <!-- Favicon -->
        <link rel="shortcut icon" href="{{asset('public/media/logo/'.$setting->logo)}}"/>
        <!-- Main Style CSS -->

        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/all.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/toastr.min.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/plugins.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/alertify.min.css')}}">
        
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/style.css')}}">
        <link rel="stylesheet" href="{{asset('public/frontend/assets/css/responsive.css')}}">
        <script src="{{asset('public/frontend/assets/js/jquery.min.js')}}"></script>
        <script src="{{asset('public/frontend/assets/js/toastr.min.js')}}"></script>
        
    </head>

    <?php
    use App\CartModal;
    use App\Product;
    ?>
    <body class="template-index index-demo1">
        @if(Session::has('success'))
        <script>
            $.toast({
                heading: 'Success',
                text: '{{session("success")}}',
                position: 'top-right',
                loaderBg:'blue',
                bgColor: '#78459j',
                icon: 'success',
                hideAfter: 6000,
                stack: 6
            });
        </script>
        @endif
        @if(Session::has('error'))
        <script>
            $.toast({
                heading: 'Error',
                text: '{{session("error")}}',
                position: 'top-right',
                loaderBg:'#ff5050',
                bgColor: '#222',
                icon: 'error',
                hideAfter: 6000,
                stack: 6
            });
    
        </script>
        @endif
    <div id="pre-loader">
        <img src="{{asset('public/frontend/assets/images/loader.gif')}}" alt="Loading..." />
    </div>
    <div class="page-wrapper">
    @php
        $category=DB::table('categories')->get();
    @endphp

    @include('layouts.header')
    @include('layouts.menubar')
    @include('layouts.mobile_menu')
    @yield('content')
    @include('layouts.footer')
    
    
      
    
    <!--Scoll Top-->
    <span id="site-scroll"><i class="fa-solid fa-arrows-up-to-line"></i></span>
    <!--End Scoll Top-->
    <div id="quickView-modal" class="mfp-with-anim mfp-hide">
        <div id="modal-size" class="modal-lg">
            <div class="row"  id="addToCart-modal-body">
                
            </div>
        </div>
    </div>
   
     <!--MiniCart Drawer-->
    <div class="minicart-right-drawer modal right fade" id="minicart-drawer">
        <div class="modal-dialog">
            <div class="modal-content" id="appendHeaderCartItem">
                @include('layouts.minicart')
    		</div>
    	</div>
    </div>
    <!--End MiniCart Drawer-->
    
  
   

    
    
    <script src="{{asset('public/frontend/assets/js/alertify.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/vendor/js.cookie.js')}}"></script>
    <!--Including Javascript-->
    <script src="{{asset('public/frontend/assets/js/plugins.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/all.min.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/main.js')}}"></script>
    <script src="{{asset('public/frontend/assets/js/custom.js')}}"></script>
   
    @include('layouts.script')
    
    
   
    
  
    
    <!--End Quickview Popup-->
    <script type="text/javascript">
        function productview(id){
          
            $('#addToCart-modal-body').html(null);
            $('#quickView-modal').modal();
            $.get('{{  url('/cart/product/view/') }}/'+id, function(data){
                $('#addToCart-modal-body').html(data);
            });
        }
    </script>
    
   
    
  
    
    
    
 </div>  
</body>
</html>


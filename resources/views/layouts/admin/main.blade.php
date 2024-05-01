<?php
    $setting=DB::table('sitesettings')->where('status',1)->first();
    $settingCount=DB::table('sitesettings')->where('status',1)->count();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="description" content="">
    <meta name="keywords" content="app, landing, corporate, Creative, Html Template, Template">
    <meta name="author" content="web-themes">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, minimum-scale=1.0, maximum-scale=1.0, initial-scale=1">

    <!-- title -->
    <title>@yield('title',$setting->company_name)</title>

    <!-- favicon -->
    <link @if($settingCount>0) href="{{ asset('public/media/logo/'.$setting->logo)}}" @else href="{{ asset('public/backend/assets/image/img/favicon.png')}}" @endif type="image/png" rel="icon">

    <!-- all css here -->
    <link href="{{ asset('public/backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/asset/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/asset/css/fontawesome.min.css')}}" rel="stylesheet" type="text/css" /> 
    <link href="{{ asset('public/backend/asset/css/simplebar.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/asset/css/helper.css')}}" rel="stylesheet" type="text/css" />
     <link href="{{ asset('public/backend/asset/css/otika-css/app.min.css')}}"rel="stylesheet" >
    <link href="{{ asset('public/backend/asset/css/otika-css/style.css')}}"rel="stylesheet" >
    <link href="{{ asset('public/backend/asset/css/otika-css/components.css')}}"rel="stylesheet" >
    <link href="{{ asset('public/backend/assets/libs/select2/css/select2.min.css')}}" rel="stylesheet" type="text/css" />

        <!-- bootstrap-datepicker css -->
    <link href="{{ asset('public/backend/assets/libs/bootstrap-datepicker/css/bootstrap-datepicker.min.css')}}" rel="stylesheet">

        <!-- DataTables -->
    <link href="{{ asset('public/backend/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('public/backend/assets/css/toastr.min.css')}}" rel="stylesheet" type="text/css" />
    <link href=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.min.css " rel="stylesheet">
        <!-- Responsive datatable examples -->
    <link href="{{ asset('public/backend/assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/asset/css/style.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/asset/css/dashboard.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/backend/asset/css/responsive.css')}}" rel="stylesheet" type="text/css"/>
    
    <script src="{{ asset('public/backend/asset/js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/toastr.min.js')}}">
        </script>
</head>
<body>
    
    @if(Session::has('success'))
        <script>
            $.toast({
                heading: 'Success',
                text: '{{session("success")}}',
                position: 'top-right',
                loaderBg:'#ff5050',
                bgColor: '#2cd07e',
                icon: 'success',
                hideAfter: 3000,
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
                bgColor: 'red',
                icon: 'error',
                hideAfter: 3000,
                stack: 6
            });
        </script>
        @endif
    
    <!-- Preloader -->
    <!-- <div id="preloader">
        <div class="loader3">
            <span></span>
            <span></span>
        </div>
    </div> -->

    <!--========== Header area ===========-->
     @include('layouts.admin.header')
    <!--========== Sidebar area ===========-->
     @include('layouts.admin.sidebar')
    <!--=========== Main Body====== -->
     @yield('admin_content')
    <!--===========footer===========-->
     @include('layouts.admin.footer')

    <!-- all js here -->
    <script src=" https://cdn.jsdelivr.net/npm/sweetalert2@11.7.28/dist/sweetalert2.all.min.js "></script>
    <script src="{{ asset('public/backend/asset/js/plugins.js')}}"></script>
    <script src="{{ asset('public/backend/asset/js/graphsdemo.js')}}"></script>
    
     <!--tinymce js-->
    
    <script src="{{ asset('public/backend/assets/css/icons.min.js')}}"></script>
    
    <script src="{{ asset('public/backend/assets/libs/jquery.repeater/jquery.repeater.min.js')}}"></script>

        <!-- init js -->
    <script src="{{ asset('public/backend/assets/js/pages/form-editor.init.js')}}"></script>
        
         <!-- select2 -->
    <script src="{{ asset('public/backend/assets/libs/select2/js/select2.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/js/pages/ecommerce-select2.init.js')}}"></script>
    
    <!-- Required datatable js -->
    <script src="{{ asset('public/backend/assets/libs/datatables.net/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
        
        <!-- Responsive examples -->
    <script src="{{ asset('public/backend/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js')}}"></script>
    <script src="{{ asset('public/backend/assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js')}}"></script>
    
    
    <script src="{{ asset('public/backend/asset/js/otika-js/scripts.js')}}"></script>
    <!--<script src="{{ asset('public/backend/asset/js/otika-js/advance-table.js')}}"></script>-->
       <!-- Datatable init js -->
    <script src="{{ asset('public/backend/assets/js/pages/datatables.init.js')}}"></script>
    
    <script src="{{ asset('public/backend/asset/js/main.js')}}"></script>
    <script src="{{ asset('public/backend/js/admin.js')}}"></script>
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
    
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


</body>
</html>
<?php
    $setting=DB::table('sitesettings')->where('status',1)->first();
    $settingCount=DB::table('sitesettings')->where('status',1)->count();
?>
<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>
            @if($settingCount>0) {{$setting->company_name}} @else {{config('app.name')}} @endif
        </title>
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">
        
        <!-- Bootstrap Css -->
        <link href="{{ asset('public/backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="{{ asset('public/backend/assets/css/icons.min.css')}}" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="{{ asset('public/backend/assets/css/app.min.css')}}" id="app-style" rel="stylesheet" type="text/css" />
        <link rel="stylesheet" type="text/css" href="{{asset('public/backend/assets/css/toastr.min.css')}}" />
        
        <script src="{{ asset('public/backend/assets/libs/jquery/jquery.min.js')}}">
        </script>
        <script src="{{ asset('public/backend/assets/js/toastr.min.js')}}">
        </script>

    </head>

    <body class="auth-body-bg">
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
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    
                    <div class="col-xl-9">
                        <div class="auth-full-bg pt-lg-5 p-4">
                            <div class="w-100">
                                <div class="bg-overlay"></div>
                                <div class="d-flex h-100 flex-column">
    
                                    <div class="p-4 mt-auto">
                                        <div class="row justify-content-center">
                                            <div class="col-lg-7">
                                                <div class="text-center">
                                                    
                                                    <h4 class="mb-3"><i class="bx bxs-quote-alt-left text-primary h1 align-middle me-3"></i><span class="text-primary">Admin</span> and Stuff Only</h4>
                                                    
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->

                    <div class="col-xl-3">
                        <div class="auth-full-page-content p-md-5 p-4">
                            <div class="w-100">

                                <div class="d-flex flex-column h-100">
                                    <div class="mb-4 mb-md-5">
                                        @if($settingCount>0)
                                        <a href="javascript:void();" class="d-block auth-logo">
                                            <img src="{{ asset('public/media/logo/'.$setting->logo)}}" alt="" height="18" class="auth-logo-dark">
                                            <img src="{{ asset('public/media/logo/'.$setting->logo)}}" alt="" height="18" class="auth-logo-light">
                                        </a>
                                        @else
                                        <a href="javascript:void();" class="d-block auth-logo">
                                            <img src="{{ asset('public/media/logo/logo')}}" alt="" height="18" class="auth-logo-dark">
                                            <img src="{{ asset('public/media/logo/logo')}}" alt="" height="18" class="auth-logo-light">
                                        </a>
                                        @endif
                                    </div>
                                    <div class="my-auto">
                                        
                                        <div>
                                            <h5 class="text-primary">Welcome Back !</h5>
                                            
                                            <p class="text-muted">Forgot Your Password?</p>
                                        </div>
            
                                        <div class="mt-4">
                                            <form action="{{ url('admin/forgot-password-recovery') }}" class="custom-validation" method="post">
                                                @csrf
                                                <div class="mb-3">
                                                    <label for="username" class="form-label">Email Or Phone</label>
                                                    <input type="text" name="any_value" class="form-control" id="emailAddress"  value="{{request()->any_value}}" required placeholder="Email or phone number">
                                                </div>
                                                
                                                <div class="mt-3 d-grid">
                                                    <button class="btn btn-primary waves-effect waves-light" type="submit">Log In</button>
                                                </div>

                                            </form>
                                         
                                        </div>
                                    </div>

                                    <div class="mt-4 mt-md-5 text-center">
                                       <p class="text-2 text-muted text-center">Return to <a href="{{ url('admin/admin-login-page') }}">Sign In</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container-fluid -->
        </div>

        <!-- JAVASCRIPT -->
     
        <script src="{{ asset('public/backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
        <script src="{{ asset('public/backend/assets/libs/metismenu/metisMenu.min.js')}}"></script>
        <script src="{{ asset('public/backend/assets/libs/simplebar/simplebar.min.js')}}"></script>
        <script src="{{ asset('public/backend/assets/libs/node-waves/waves.min.js')}}"></script>
        <script src="{{ asset('public/backend/assets/js/app.js')}}"></script>
        <script src="{{ asset('public/backend/assets/libs/parsleyjs/parsley.min.js')}}"></script>

        <script src="{{ asset('public/backend/assets/js/pages/form-validation.init.js')}}"></script>

    </body>
</html>

@extends('layouts.website')
@section('title', 'Sign In')
@section('content')

<section id="chekout_sign_up">
        <div class="container">
            <div class="row">
                <div class="col-xl-12">
                    <div class="chekout_sign_up_title text-center">
                        <h1>Welcome, Please Sign In!</h1>
                    </div>
                </div>
            </div>
            <div class="chekout_sign_up_container">
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-9 mx-auto">
                        <div class="chekout_sign_up_container_top">
                            <div class="row align-items-center">
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="chekout_sign_up_container_top_fb">
                                        <a href="javascript:void(0)"><i class="fab fa-facebook"></i> Login With facebook</a>
                                    </div>
                                </div>
                                <div class="col-xl-6 col-lg-6 col-md-6">
                                    <div class="chekout_sign_up_container_top_gest text-center">
                                        <p>You don't have to create anaccount to place an order</p>
                                        <a href="{{url('customer/guest')}}" onclick="event.preventDefault();
                                        document.getElementById('signin-form').submit();"><i class="icofont-lock"></i> checkout-as-guest</a>
                                    </div>
                                    <form id="signin-form" action="{{ url('customer/guest') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-7 col-lg-7 col-md-9 mx-auto">
                        <nav>
                            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Login With Email Address</a>
                                <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Login with Mobile Number </a>
                            </div>
                        </nav>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
                                <form class="crat_sign_up_form" action="{{url('customer/signin/email')}}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email address</label>
                                        <input name="email" type="email" class="form-control" placeholder="Enter Your Email" value="{{old('email')}}" required="">

                                        @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Password</label>
                                        <input name="e_password" type="password" class="form-control" placeholder="Enter Your Password" required="">

                                        @if ($errors->has('e_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('e_password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox mr-sm-2">
                                            <input type="checkbox" class="custom-control-input" id="customControlAutosizing">
                                            <label class="custom-control-label" for="customControlAutosizing">Remember me</label>
                                        </div>
                                    </div>
                                    <button type="submit">Login Now</button>
                                </form>
                            </div>
                            <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
                                <form action="{{url('customer/signin/phone')}}" method="post">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Phone Number</label>
                                        <input name="phone" type="mobile" class="form-control" placeholder="Enter Your Phone Number" value="{{old('phone')}}" required="">

                                        @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('phone') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Password</label>
                                        <input name="p_password" type="password" class="form-control" placeholder="Enter Your Password" required="">

                                        @if ($errors->has('p_password'))
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('p_password') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    <button type="submit" class="btn btn-primary">Login Now</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
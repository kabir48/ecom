@extends('layouts.app')
@section('title', 'Customer Account')
@section('content')
    <div id="page-content">
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{ url('/') }}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>Password Change Page</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
        	<div class="page-title"><h1>My Account</h1></div>
            <div class="dashboard-upper-info">
            	<div class="row align-items-center no-gutters">
                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="d-single-info">
                        <p>Contact Us </p>
                        <p>{{$setting->email }}</p>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6 col-md-6">
                    <div class="d-single-info">
                        <p class="xs-fon-13 margin-10px-bottom"><span>Name:</span> {{Auth::user()->name}}</p>
                        <p class="xs-fon-13 margin-10px-bottom"><span>Email:</span> {{ Auth::user()->email}}</p>
                        <p class="xs-fon-13 margin-10px-bottom"><span>Phone:</span> {{ Auth::user()->phone}}</p>
                        <p class="xs-fon-13 margin-10px-bottom"><span>Address:</span> {{ Auth::user()->address}}</p>
                        <p class="xs-fon-13 margin-10px-bottom"><span>City:</span> {{ Auth::user()->city}}</p>
                        <button data-toggle="modal" data-target="#personalInfo">Update Information</button>

                    </div>
                </div>

            </div>
	        </div>
            <div class="row mb-5">
                <div class="col-xl-2 col-lg-2 col-md-12 md-margin-20px-bottom">
                    @include('pages.customer.sidebar')
                </div>
                <div class="col-xs-10 col-lg-10 col-md-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content" style="">
                        <!-- Orders -->
                        <div id="orders" class="product-order">
                            <div id="account-details" >
                                <h3>Account details </h3>
                                <div class="account-login-form bg-light-gray padding-20px-all">
                                    <form action="{{url('/check-user-pwd-update')}}" method="post" id="passwordForm">
                                        @csrf
                                        <fieldset>
                                            <p>Already have an account? <a href="login.html"> Log in instead!</a></p>
                                            <div class="row">
                                                <div class="form-group col-md-4 col-lg-4 col-xl-4 required">
                                                    <label for="input-email">Old Password <span class="required-f">*</span></label>
                                                    <input name="current_pwd" value="" id="current_pwd" class="form-control" type="password">
                                                </div>
                                                <div class="form-group col-md-4 col-lg-4 col-xl-4 required">
                                                    <label for="input-password">New Password <span class="required-f">*</span></label>
                                                    <input name="new_password" value=""id="new_password" class="form-control" type="password">
                                                </div>

                                                <div class="form-group col-md-4 col-lg-4 col-xl-4 required">
                                                    <label for="input-password">Confirm Password <span class="required-f">*</span></label>
                                                    <input name="password_confirmation" value=""id="password_confirmation" class="form-control" type="password">
                                                </div>
                                            </div>
                                        </fieldset>

                                        <button type="submit" class="btn margin-15px-top btn-primary">Save</button>
                                    </form>

                                </div>

                            </div>

                        </div>
                        <!-- End Orders -->
                    </div>
                    <!-- End Tab panes -->
                </div>
            </div>
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->

    <div class="modal fade" id="personalInfo" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalCenterTitle">Personal Information</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <form action="{{url('user/customer/account')}}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" name="name" value="{{$userDetails['name']}}" required="">
                    </div>
                    <div class="form-group">
                        <label for="name">Address</label>
                        <input type="text" class="form-control" name="address" value="{{$userDetails['address']}}">
                    </div>
                    <div class="form-group">
                        <label for="name">Phone</label>
                        <input type="text" class="form-control" name="phone" value="{{$userDetails['phone']}}">
                    </div>

                       <div class="form-group">
                        <label for="name">City</label>
                        <select class="form-control" name="city" id="city">
                            @foreach($districts as $district)
                            <option value="{{$district['name']}}" @if($district['name']==$userDetails['city']) Selected @endif>{{$district['name']}}</option>
                            @endforeach

                        </select>
                    </div>
                     <div class="form-group">
                        <label for="name">pincode</label>
                        <input type="text" class="form-control" name="pincode" value="{{$userDetails['pincode']}}">
                    </div>

                    <div class="form-group">
                        <label for="name">Email</label>
                        <input type="email" class="form-control" value="{{$userDetails['email']}}" readonly>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        </div>
    </div>
  

@endsection
    <script type="text/javascript" src="{{asset('public/website')}}/js/jquery.validate.min.js"></script>
    <script>
       //check current User Password
       $("#current_pwd").keyup(function(){
           var current_pwd=$(this).val();
           //alert(current_pwd);
           $.ajax({
               type:'post',
               url:"{{url('check-user-pwd')}}",
               data:{current_pwd:current_pwd},
               success:function(resp){
                //alert(resp);
                if(resp == false){
                    $("#chkpwd").html("<font color='red'>Current password is incorrect</font>");
                }else if(resp == true){
                $("#chkpwd").html("<font color='green'>Current password is Correct</font>");
    }
               },error:function(){
                   alert("Error");
               }
           });
       });
    </script>
     <script>
            $("#passwordForm").validate({
                rules: {
                    current_pwd: {
                        required: true,
                        minlength:6,
                        maxlength:20
                    },
                        new_password: {
                        required: true,
                        minlength: 6,
                        maxlength:20
                    },

                        password_confirmation: {
                        required: true,
                        minlength: 6,
                        maxlength:20,
                        equalTo:"#new_password"
                    },

                },
                messages: {
                    current_pwd: {
                        required: "Please provide a password",
                        minlength: "Your password must be at least 6 characters long"
                    },

                    new_password: {
                        required:"Please Enter your New Password",
                        minlength: "Your password must be at least 6 characters long"
                },
                password_confirmation: {
                        required:"Please Enter your New Password",
                        minlength: "Your password must be at least 6 characters long",
                        equalTo:"password does not match"
                },
                }
            });
        </script>













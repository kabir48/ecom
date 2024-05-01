@extends('layouts.app')
@section('content')
    <style>
        .form-my-account input[type="text"] {
        border: 1px solid #e5e5e5;
        color: #999;
        font-weight: 700;
        height: 50px;
        padding: 0 20px;
        text-transform: capitalize !important;
        width: 100%;
        }
        .form-my-account input[type] {
            border: 1px solid #e5e5e5;
            font-weight: 700;
            height: 50px;
            padding: 0 20px;
            text-transform: lowercase !important;
            width: 100%;
        }
        form.cmxform label.error,label.error{
            color:#0B7CBB;
        }
    </style>
    <?php
       $page=App\PageBuilder::where('url','login')->first();
    ?>
    @if($page)
    <div id="page-content" style="background-url({{asset('public/media/page/'.$page->banner)}})">
    @else
    <div id="page-content">
    @endif    
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{ url('/') }}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>@if($page){{$page->section}} @else Login Page @endif</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <!--Page Title with Image-->
        <div class="page-title"><h1>@if(session()->get('lang')=='bangla') লগইন তথ্য  @elseif(session()->get('lang')=='english') Login Page @else লগইন তথ্য @endif</h1></div>
        <!--End Page Title with Image-->
        <div class="container">
            <div class="row" style="justify-content: center;">
				<!--Main Content-->
                <div class="col-12 col-sm-12 col-md-10 col-lg-10 box">
                	<form class="form-my-account" method="post" action="{{ url('user/register-user') }}" id="registerForm">
                        @csrf
                        
                        <h2 class="title">@if(session()->get('lang')=='bangla') অর্ডার নিশ্চিত করতে, অনুগ্রহ করে আপনার নাম, ঠিকানা এবং ফোন নম্বর দিন @elseif(session()->get('lang')=='english') To confirm order, Please Provide your name, address, and phone number @else অর্ডার নিশ্চিত করতে, অনুগ্রহ করে আপনার নাম, ঠিকানা এবং ফোন নম্বর দিন  @endif</h2>
                        
                        <p>
                            <select id="changeValue">
                                <option>@if(session()->get('lang')=='bangla') আমাদের পোর্টালে আপনার কি একাউন্ট আছে? @elseif(session()->get('lang')=='english') Do you have an account in our portal? @else আমাদের পোর্টালে আপনার কি একাউন্ট আছে? @endif</option>
                                <option value="yes">@if(session()->get('lang')=='bangla') হ্যা আমার আছে @elseif(session()->get('lang')=='english') Yes,I have it @else হ্যা আমার আছে @endif</option>
                                <option value="no">@if(session()->get('lang')=='bangla') না, আমার নেই @elseif(session()->get('lang')=='english') No, I don't have @else না, আমার নেই @endif</option>
                            </select> 
                        </p>
                        
                        <div style="display:none" id="all">
                            <p><input type="text" placeholder="@if(session()->get('lang')=='bangla') আপনার পুরো নাম লিখুন  @elseif(session()->get('lang')=='english') Write Your Full Name @else আপনার পুরো নাম লিখুন @endif" name="name" value="{{old('name')}}"  id="name"/>
                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('name') }}</strong>
                                  </span>
                               @endif
                            </p>
                            <p><input type="email" placeholder="@if(session()->get('lang')=='bangla') ই-মেইল (অপশনাল
)
 @elseif(session()->get('lang')=='english' )E-mail (not needed)  @else ই-মেইল (অপশনাল
) @endif" name="email" value="{{old('email')}}" id="email"/>
                                 @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                              </span>
                           @endif
                        </p>
                         <p><input type="text" placeholder="@if(session()->get('lang')=='bangla') ফোন নম্বর *
 @elseif(session()->get('lang')=='english') Phone Number*@else ফোন নম্বর *
 @endif"  name="phone" value="{{old('phone')}}" id="phone"/>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                              </span>
                           @endif
                        </p>
                            <p>
                               <textarea id="address" name="address" rows="4" cols="50" placeholder="@if(session()->get('lang')=='bangla') {{__("heading.address_bn")}} * @elseif(session()->get('lang')=='english') {{__("heading.address_en")}} * @else {{__("heading.address_bn")}} * @endif ">{{request()->address}}</textarea>
                            </p>
                            
                           
                            
                            <p>
                                <select name="country" data-live-search="true" class="selectpicker">
                                   <option>@if(session()->get('lang')=='bangla') স্থান নির্বাচন করুন @elseif(session()->get('lang')=='english') Select Location @else স্থান নির্বাচন করুন @endif</option>
                                   <option value="inside_dhaka" <?php if(request()->country=="inside_dhaka"){echo "selected";}?>>@if(session()->get('lang')=='bangla') {{__(("heading.inside_dhaka_bn"))}} @elseif(session()->get('lang')=='english') {{__(("heading.inside_dhaka_en"))}} @else {{__(("heading.inside_dhaka_bn"))}} @endif</option>
                                   <option value="outside_dhaka" <?php if(request()->country=="outside_dhaka"){echo "selected";}?>>@if(session()->get('lang')=='bangla') {{__(("heading.outside_dhaka_bn"))}} @elseif(session()->get('lang')=='english') {{__(("heading.outside_dhaka_en"))}} @else {{__(("heading.outside_dhaka_bn"))}} @endif</option>
                                </select>
                            </p> 
                            
                            
                            
                        </div>
                        <div style="display:none" id="notAll">
                            <p><input type="text" placeholder="@if(session()->get('lang')=='bangla') আপনার যে নম্বরটি রেজিষ্ট্রেশন করা রয়েছে সে নম্বরটি প্রদান করুন
 *
 @elseif(session()->get('lang')=='english') Phone Number*@else আপনার যে নম্বরটি রেজিষ্ট্রেশন করা রয়েছে সে নম্বরটি প্রদান করুন
 *
 @endif"  name="phone" value="{{old('phone')}}" id="phone"/>
                            @if ($errors->has('phone'))
                                <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                              </span>
                           @endif
                        </p>
                           
                        </div>
                        
                        <p class="my-3"><input type="submit" class="btn mb-3" value="@if(session()->get('lang')=='bangla') জমা দিন @elseif(session()->get('lang')=='english') Submit @else জমা দিন @endif "></p>
                    </form>
                </div>
				<!--End Main Content-->
			</div>

        </div><!--End Body Container-->

    </div><!--End Page Wrapper-->
    <script type="text/javascript" src="{{asset('public/frontend/assets/js/jquery.validate.min.js')}}"></script>
    <script>
        $(document).ready(function(){
            $("#changeValue").on("change",function(){
                let val=$(this).val();
                if(val==='yes'){
                    $("#all").hide();
                    $("#notAll").show();
                }else if(val==='no'){
                    $("#all").show();
                    $("#notAll").hide();
                }else{
                    $("#all").hide();
                    $("#notAll").hide();
                }
            })
        })
    </script>
    <script>
        $("#registerForm").validate({
			rules: {

				name: "required",
				phone: {
					required: true,
                    maxlength:20,
                    digit:true
				},

				email: {
					required: true,
					email: true,
                    remote:"check-email",
				},
                	password: {
					required: true,
					minlength: 6,
				},

			},
			messages: {
				name: "Please enter your name",
				phone: {
					required: "Please enter a phone Number",
					maxlength: "Your username must consist of at least 20 characters",
                    digit:'please enter valid phone number'
				},
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},

				email: {
                    required:"Please enter a valid email address",
                    email:"please enter your valid email",
                    remote:"Email already Exit"
            },
			}
		});
    </script>

     <script>
        $(".contact-form").validate({
			rules: {
				email: {
					required: true,
					email: true,
				},
                	password: {
					required: true,
					minlength: 6,
				},

			},
			messages: {
				password: {
					required: "Please provide a password",
					minlength: "Your password must be at least 6 characters long"
				},

				email: {
                    required:"Please Enter your Email address",
                    email:"please Enter Your valid Email",
            },
			}
		});
    </script>
 @endsection

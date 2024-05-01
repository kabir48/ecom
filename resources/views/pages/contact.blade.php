@extends('layouts.app')
@section('content')
@php
    $setting=DB::table('sitesettings')->first();
    $seo=DB::table('seo')->first();
@endphp
    <div id="page-content">
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{ url('/') }}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>Pre Order Booking</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
        	<div class="page-title"><h1>Pre Order Booking</h1></div>
            <div class="row">
            	<div class="col-12 col-sm-12 col-md-4 col-lg-4 mb-4">
                	<div class="contact-form-in">
                        <h2>Drop Your Order</h2>
                        <div class="formFeilds contact-form form-vertical">
                          <form action="{{ url('customer-pre-order') }}" name="contactus" method="post" id="contact_form" class="contact-form">
                              @csrf
                              <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="ContactFormName" name="name" placeholder="Name" value="">
                                        <span class="error_msg" id="name_error"></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input type="email" id="ContactFormEmail" name="email" placeholder="Email" value="">
                                        <span class="error_msg" id="email_error"></span>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input type="tel" id="ContactFormPhone" name="phone" pattern="[0-9\-]*" placeholder="Phone Number" />
                                    </div>
                                  </div>
                                  <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <input type="text" id="ContactSubject" name="address" placeholder="Subject" value="">
                                        <span class="error_msg" id="subject_error"></span>
                                    </div>
                                  </div>
                              </div>

                              <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group">
                                      <input type="number" id="ContactFormPhone" name="quantity" pattern="[0-9\-]*" placeholder="Quantity" />
                                  </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                  <div class="form-group">
                                      <input type="text" id="ContactSubject" name="range" placeholder="price_range">
                                      <span class="error_msg" id="subject_error"></span>
                                  </div>
                                </div>
                            </div>
                              <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <textarea rows="10" id="ContactFormMessage" name="message" placeholder="Your Message"></textarea>
                                        <span class="error_msg" id="message_error"></span>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <?php
                                      $categories = App\Section::with('categories')->where('status',1)->get();
                                    ?>
                                    <div class="form-group">
                                        <select name="product_id[]" id="" class="form-control " multiple>
                                          <option>Select</option>
                                            @foreach($categories as $section)
                                            <optgroup label=" {{$section['name']}}"></optgroup>
                                            @foreach ($section['categories'] as $category)
                                                <option style="color:rgb(233, 120, 15)" value="{{$category['id']}}" @if(!empty(@old('category_id')) && $category['id']==@old('category_id')) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$category['category_name']}}</option>
                                                @foreach ($category['subcategories'] as $subcategory)
                                                     <option style="color:brown" value="{{$subcategory['id']}}"  @if(!empty(@old('category_id')) && $subcategory['id']==@old('category_id')) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$subcategory['category_name']}}</option>
                                                @endforeach
                                            @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                    <div class="form-group">
                                        <select name="size[]" id="" class="form-control" multiple>
                                            <option value="">Select Size</option>
                                            <option value="XXL">XXL</option>
                                            <option value="XL">XL</option>
                                            <option value="L">L</option>
                                            <option value="M">M</option>
                                            <option value="S">S</option>
                                          </select>
                                    </div>
                                </div>
                              </div>
                              <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="mailsendbtn">
                                    <input class="btn" type="submit"  value="Send Pre-Order" />
                                    <div class="loading"><img class="img-fluid" src="assets/images/ajax-loader.gif" alt="loading"></div>
                                </div>
                            </div>
                         </div>
                            </form>
                            <div class="response-msg"></div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-12 col-md-8 col-lg-8">
                	<div class="contact-details">
                    	<div class="row">
                        	<div class="col-12 col-sm-12 col-md-6 col-lg-6">
                                <ul class="addressFooter">
                                    <li>
                                        <i class="fa-solid fa-location-dot" style="position: relative;top: 22px"></i>
                                        <p>{{$setting->company_address}}</p>
                                    </li>
                                    <li class="phone">
                                        <i style="position: relative;top: 22px" class="fa-solid fa-mobile-retro"></i>
                                        <p>{{$setting->phone_one}}</p>
                                    </li>
                                    <li class="email">
                                        <i style="position: relative;top: 22px" class="fa-solid fa-envelope-open-text"></i>
                                        <p>{{$setting->email}}</p>
                                    </li>
                                </ul>
                                <ul class="list--inline site-footer__social-icons social-icons mb-5 mt-4">
                                    @if(isset($setting->facebook))
                                        <li>
                                            <a href="{{$setting->facebook}}" target="_blank"><i class="fa-brands fa-facebook"></i></a>
                                        </li>
                                    @endif
                                    @if(isset($setting->instagram))
                                        <li>
                                            <a href="{{$setting->instagram}}" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                            <div class="col-12 col-sm-12 col-md-6 col-lg-6 mb-4">
                            	<div class="open-hours">
                                    <strong>@if(session()->get('lang')=='bangla') শোরুম খোলার সময় @elseif(session()->get('lang')=='english')  Opening Hours For Showroom @else শোরুম খোলার সময়  @endif</strong><br>
                                    @if(session()->get('lang')=='bangla') সকাল 10টা-8টা (বুধবার থেকে সোমবার)
                                    মঙ্গলবার সাপ্তাহিক বন্ধ @elseif(session()->get('lang')=='english') 10am-8pm (Wednesday to Monday)
                                    Tuesday Weekly Off
                                    @else সকাল 10টা-8টা (বুধবার থেকে সোমবার)
                                    মঙ্গলবার সাপ্তাহিক বন্ধ @endif
                                </div>
                            </div>
                        </div>
                    </div>
                  
                </div>
            </div>
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->

@endsection

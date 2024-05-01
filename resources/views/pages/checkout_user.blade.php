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
     <main>
		<div class="form_area" style="margin-bottom: 28px !important;
    margin-top: 122px !important;">
			<div class="container">
				<div class="row">
				     <div class="col-md-12">
                        <div class="form_inner">
                            <h2 class="form_title">@if(session()->get('lang')=='bangla') আপনার শিপিং ঠিকানা আপডেট করুন @elseif(session()->get('lang')=='english') Add Shipping Address @else আপনার শিপিং ঠিকানা আপডেট করুন @endif</h2>
                             <form class="form-my-account" method="POST" action="{{url('user/add-edit-shipping-address/'.$shipping['id'])}}">
                               @csrf
                                <p class="clearfix box-col2">
                                    <input type="text" placeholder="@if(session()->get('lang')=='bangla') আপনার পুরো নাম লিখুন  @elseif(session()->get('lang')=='english') Write Your Full Name @else আপনার পুরো নাম লিখুন @endif"  name="name" @if(isset($shipping['name'])) value="{{$shipping['name']}}"@else value="{{old('name')}}"@endif required/>
                                    <input type="text" placeholder="@if(session()->get('lang')=='bangla') ফোন নম্বর *
 @elseif(session()->get('lang')=='english') Phone Number*@else ফোন নম্বর *
 @endif"" name="phone"  @if(isset($shipping['phone'])) value="{{$shipping['phone']}}" @else value="{{old('phone')}}"@endif required/>
                               </p>
                               <p class="clearfix box-col2">
                                    <p>
                                       <textarea id="address" name="address" rows="4" cols="50" placeholder="@if(session()->get('lang')=='bangla') {{__("heading.address_bn")}} * @elseif(session()->get('lang')=='english') {{__("heading.address_en")}} * @else {{__("heading.address_bn")}} * @endif ">
                                        {{$shipping['address']}}
                                       </textarea>
                                    </p>
                                    
                                    <input type="text" placeholder="@if(session()->get('lang')=='bangla') আপনার এলাকা টাইপ করুন (গুরুত্বপূর্ণ নয়) @elseif(session()->get('lang')=='english') Type Your Area(not important) @else আপনার এলাকা টাইপ করুন (গুরুত্বপূর্ণ নয়) @endif" name="area" @if(isset($shipping['area'])) value="{{$shipping['area']}}"@else value="{{old('area')}}"@endif/>
                                    <input type="text" placeholder="@if(session()->get('lang')=='bangla') @elseif(session()->get('lang')=='bangla')Type Your Postal Code @else আপনার পোস্টাল কোড টাইপ করুন (গুরুত্বপূর্ণ নয়) @endif" name="zip_code" @if(isset($shipping['zip_code'])) value="{{$shipping['zip_code']}}"@else value="{{old('zip_code')}}"@endif/>
                                </p>
                                
                                 <p>
                                    <select name="country" data-live-search="true" class="selectpicker">
                                       <option>@if(session()->get('lang')=='bangla') স্থান নির্বাচন করুন @elseif(session()->get('lang')=='english') Select Location @else স্থান নির্বাচন করুন @endif</option>
                                       <option value="inside_dhaka" <?php if($shipping['country']=="inside_dhaka"){echo "selected";}?>>@if(session()->get('lang')=='bangla') {{__(("heading.inside_dhaka_bn"))}} @elseif(session()->get('lang')=='english') {{__(("heading.inside_dhaka_en"))}} @else {{__(("heading.inside_dhaka_bn"))}} @endif</option>
                                       <option value="outside_dhaka" <?php if($shipping['country']=="outside_dhaka"){echo "selected";}?>>@if(session()->get('lang')=='bangla') {{__(("heading.outside_dhaka_bn"))}} @elseif(session()->get('lang')=='english') {{__(("heading.outside_dhaka_en"))}} @else {{__(("heading.outside_dhaka_bn"))}} @endif</option>
                                    </select>
                                </p> 
                                <p>
                                    <button type="submit" class="btn btn-primary">@if(session()->get('lang')=='bangla') জমা দিন @elseif(session()->get('lang')=='english') Submit @else জমা দিন @endif "</button>
                                </p>
                        </form>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- End Content Page -->
	  </main>
      @endsection



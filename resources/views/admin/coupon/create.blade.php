@extends('layouts.admin.main')
    @section('title',$title)
    @section('admin_content')
    
        <main class="ContentBody">
            <div class="row">
                <div class="col-md-12">
                    <div class="orderListArea">
                        <div class="canvas_header">
                            <h2>{{$title}}</h2>
                            <a href="{{url('admin/coupon-lists')}}" class="btn btn-default btn-primary">Back
                            </a>
                        </div>  

                        <!-- orders -->
                        <div data-simplebar data-simplebar-auto-hide="false" style="min-width: 5rem;" class="pb_25">
                             <form  @if(empty($coupon['id'])) action="{{url('admin/coupon-store-update')}}" @elseaction="{{url('admin/coupon-store-update/'.$coupon['id'])}}" @endif method="post" enctype="multipart/form-data">
                                @csrf     
                                <div class="row">
                                    @if(empty($coupon['coupon_code']))
                                   <div class="col-lg-12">
                                     <div class="row">
                                    <div class="form-group col-lg-6 d-lg-flex gap-lg-4 align-items-center">
                                      <label class="form-control-label" style="margin: 10px 0;"> Coupon Type: <span class="tx-danger">*</span></label>
                                        <div class=" d-lg-flex gap-lg-4">
                                        <div>
                                            <input type="radio" id="AutomaticCoupon"  value="Automatic" name="coupon_option">
                                            <label for="AutomaticCoupon" style="font-size: 1.4rem !important;cursor:pointer;font-weight: 400 !important;">Automatic</label>
                                        </div>
                                        <div>
                                            <input type="radio" id="ManualCoupon"  value="Manual" name="coupon_option">
                                            <label for="ManualCoupon" style="font-size: 1.4rem !important;cursor:pointer;font-weight: 400 !important;">Manual</label>
                                        </div>
                                        </div>
                                    </div>
                                     <div class="form-group col-lg-6" style="display:none" id="couponField">
                                       <label for="coupon_code">Coupon Code</label>
                                       <input type="text" class="form-control" id="coupon_code" aria-describedby="emailHelp"  name="coupon_code" placeholder="type coupon code">
                                      </div>
                                    </div>
                                    </div>
                                    @else
                                    <div class="col-lg-12">
                                      <div class="form-group">
                                          <input type="hidden" name="coupon_option" value="{{$coupon['coupon_option']}}">
                                          <input type="hidden" name="coupon_code" value="{{$coupon['coupon_code']}}">
                                           <label for="coupon_code">Coupon Code:  <span style="color:red">{{$coupon['coupon_code']}}</span></label>
                                      </div>
                                    </div>
                                    @endif
                                    
                                  
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" style="margin: 10px 0;"> Coupon Allow: <span class="tx-danger">*</span></label>
                                           <input type="radio" value="Multiple Times" name="coupon_type" @if(isset($coupon['coupon_type']) &&$coupon['coupon_type']=="Multiple Times") checked @elseif(!isset($coupon['coupon_type']) &&$coupon['coupon_type']=="Multiple Times") checked @endif id="MultipleCoupon">
                                           <label for="MultipleCoupon" style="font-size: 1.4rem !important;cursor:pointer;font-weight: 400 !important;"> Multiple Times </label>
                                           <input type="radio"  value="Single Times" id="SingleCoupon" name="coupon_type" @if(isset($coupon['coupon_type']) &&$coupon['coupon_type']=="Single Times") checked @endif>
                                           <label for="SingleCoupon" style="font-size: 1.4rem !important;cursor:pointer;font-weight: 400 !important;"> Single Times </label>
                                        </div>
                                    </div>
                                      
                                   <div class="col-lg-6">
                                        <div class="form-group">
                                            <label class="form-control-label" style="margin: 10px 0;"> Coupon Procedure: <span class="tx-danger">*</span></label>
                                            <input id="ProcedurePercentage" type="radio" value="Percentage" name="amount_type" @if(isset($coupon['amount_type']) &&$coupon['amount_type']=="Percentage") checked @elseif(!isset($coupon['amount_type']) &&$coupon['amount_type']=="Percentage") checked @endif>
                                            <label for="ProcedurePercentage" style="font-size: 1.4rem !important;cursor:pointer;font-weight: 400 !important;"> Percentage&nbsp;(%) </label>
                                            <input id="ProcedureFixed" type="radio" value="Fixed" name="amount_type" @if(isset($coupon['amount_type']) &&$coupon['amount_type']=="Fixed") checked @endif>
                                            <label for="ProcedureFixed" style="font-size: 1.4rem !important;cursor:pointer;font-weight: 400 !important;"> Fixed(in Taka)&nbsp</label>&nbsp; 
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                         <label class="form-control-label" style="margin: 10px 0;" for="amount">Amount Or Percentage</label></br>
                                         <input type="number" name="amount" placeholder="Enter Amount or Percentage just put number"  class="form-control" @if(isset($coupon['amount'])) value="{{$coupon['amount']}}" @endif>
                                           
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label style="margin: 10px 0;" class="form-control-label">Category Discount<span class="tx-danger">*</span></label>
                                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="category discount" name="category_discount" @if(!empty($categorydata['category_discount'])) value="{{$categorydata['category_discount']}}" @else value="{{old('category_discount')}}" @endif>
                                           
                                        </div>
                                    </div> 
                                    
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                          <label class="form-control-label" style="margin: 10px 0;">User Select:</label><br>
                                              <select class="form-control select2" name="users[]" multiple>
                                                @foreach($users as  $user)
                                                <option value="{{$user['email']}}" @if(in_array($user['email'],$selUsers)) selected @endif >{{$user['email']}}</option>
                                                @endforeach
                                             </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-lg-6">
                                         <div class="form-group">
                                            <label class="form-control-label" style="margin: 10px 0;">Expiry Date</label>
                                            <input type="date" class="form-control"  name="expiry_date" @if(isset($coupon['expiry_date'])) value="{{$coupon['expiry_date']}}" @endif>
                                        </div>
                                    </div>
                                </div> 
                                                
                                <div class="row justify-content-end">
                                        <div class="col-sm-12">
                                            <div style="margin: 24px 0;">
                                                <button type="submit" class="btn btn-primary w-md"> 
                                               @if(empty($categorydata->id)) Submit @else Update @endif
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>  
         <main>
            <!-- Modal for Eligible-->
            
    <script>
          $(function(){
        'use strict';
          //Show /Hide Function
          $("#ManualCoupon").click(function(){
              $("#couponField").show();
          });
           $("#AutomaticCoupon").click(function(){
              $("#couponField").hide();
          });
          });
    </script>
    
    @endsection
    
    
   
    
   



@extends('layouts.app')
@section('title', 'Customer Account')
@section('content')
<section id="content">
        <div class="content-page woocommerce">
            <div class="container">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12 col-md-offset-1">
                        <h4 class="title-shop-page">Review Our Products Accoroding to Your Satisfaction</h4>
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-ms-12">
                                <div class="check-address">
                                    <form class="form-my-account" method="post" action="{{url('check-user-review-post/'.$review->id)}}">
                                        @csrf
                                      <li class="payment_method_cod" style="margin-bottom: 10px">
                                        <input type="radio" data-order_button_text="" value="yes" name="review" class="input-radio" id="payment_method_cod">&nbsp;HAPPY&nbsp;&nbsp;&nbsp;
                                        <input type="radio" data-order_button_text="" value="no" name="review" class="input-radio" id="payment_method_cod">&nbsp;UNHAPPY&nbsp;
                                       </li>
                                        <p>
                                            <textarea cols="40" rows="10" name="comment" onblur="if (this.value=='') this.value = this.defaultValue" onfocus="if (this.value==this.defaultValue) this.value = ''">Write Your Comments</textarea>
                                        </p>
                                        <input type="submit" value="Submit">
                                    </form>
                                </div>      
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Content Page -->
    </section>
    <!-- End Content -->

@endsection

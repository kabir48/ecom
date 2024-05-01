    @extends('layouts.app')
    @section('content')
    <?php
        $basicinfo = DB::table('sitesettings')->where('status',1)->first();
    ?>
         <main>
    		<div class="form_area" style="margin-bottom: 28px !important;
        margin-top: 122px !important;">
    			<div class="container">
    					<div class="row">
    					<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                            <div class="jumbotron text-center">
                                <h1 class="display-3">SUCCESS ORDER!</h1>
                                <hr>
                                <p style="color:#0B7CBB">
                                    Your Order Has Been Placed Successfully!
                                </p>
                                
                                </br>
                                </br>
                                
                                <p style="color:#0B7CBB">
                                    Your Order Number is : {{Session::get('order_id')}}, That Cost Around {{Session::get('grand_total')}}
                                </p>
                                
                                </br>
                                </br>
                                
                                 <p style="color:ornage;font-size:20px">
                                    Thanks For Your Shopping with {{$basicinfo->company_name}}
                                </p>
                                
                                <p class="lead">
                                    <a class="btn btn-primary btn-sm" href="{{url('/store-product/view')}}" role="button"> Retun Shop Page </a>
                                </p>
                                OR/
                                </br>
                                <p class="lead">
                                    <a class="btn btn-primary btn-sm" href="{{url('/customer/dashboard')}}" role="button"> Retun To Your Dashboard </a>
                                </p>
                            </div>
                        </div>
                    </div>
    			</div>
    		</div>
    		<!-- End Content Page -->
    	  </main>
	 
    @endsection
    <?php
        Session::forget('grand_total');
        Session::forget('order_id');
        Session::forget('couponAmount');
        Session::forget('couponCode');
    ?>
   
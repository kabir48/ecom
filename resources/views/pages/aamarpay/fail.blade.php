    @extends('layouts.app')
    @section('content')
    $basicinfo=Sitesetting::where('status',1)->first();

         <main>
    		<div class="form_area" style="margin-bottom: 28px !important;
        margin-top: 122px !important;">
    			<div class="container">
    					<div class="row">
    					<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                            <div class="jumbotron text-center">
                                <h1 class="display-3">FAIL ORDER!</h1>
                                <hr>
                                <p style="color:#0B7CBB">
                                    Your Order Has Been Failed!
                                </p>
                                
                                </br>
                                </br>
                                <p style="color:#0B7CBB">
                                    Please Try Again After Sometimes Or Contact us {{$basicinfo->phone}}  or Email Us {{$basicinfo->email}}
                                </p>
                                </br>
                                </br>
                                
                                <p class="lead">
                                    <a class="btn btn-primary btn-sm" href="{{url('/store-product/view')}}" role="button"> Retun Shop Page </a>
                                </p>
                                
                            </div>
                        </div>
                    </div>
    			</div>
    		</div>
    		<!-- End Content Page -->
    	  </main>
	 
    @endsection
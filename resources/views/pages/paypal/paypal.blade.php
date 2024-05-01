@extends('layouts.app')
@section('content')
     <main>
		<div class="form_area" style="margin-bottom: 28px !important;
    margin-top: 122px !important; ">
			<div class="container">
					<div class="row">
					<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                        <div class="jumbotron text-center">
                            <h1 class="display-3">Please Make Payment By Paypal</h1>
                            <hr>
                            <p style="color:#0B7CBB; margin-top:50px">
                               <form action="{{route('payment')}}" method="post">
                                   @csrf
                                   <input type="hidden" name="amount" value="{{round(Session::get('grand_total'),2)}}">
                                   <input type="image" src="https://www.paypalobjects.com/digitalassets/c/website/marketing/apac/C2/logos-buttons/44_Yellow_CheckOut_Pill_Button.png">
                               </form>
                            </p>
                        </div>
                    </div>
                </div>
			</div>
		</div>
		<!-- End Content Page -->
	  </main>
	 
@endsection
 
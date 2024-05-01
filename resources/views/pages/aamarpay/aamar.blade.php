@extends('layouts.app')
@section('content')
     <main>
		<div class="form_area" style="margin-bottom: 28px !important;
    margin-top: 122px !important; ">
			<div class="container">
					<div class="row">
					<div class="col-md-10 col-sm-12 col-xs-12 col-md-offset-1">
                        <div class="jumbotron text-center">
                            <h1 class="display-3">Please Make Payment With Aaamar Pay ({{round(Session::get('grand_total'),2)}})</h1>
                            <hr>
                            <p style="color:#0B7CBB; margin-top:50px">
                               <form action="{{route('aamrpay.payment')}}" method="post">
                                   @csrf
                                   <input type="hidden" name="amount" value="{{round(Session::get('grand_total'),2)}}">
                                   <button type="submit" class="btn btn-success">Submit</button>
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
 
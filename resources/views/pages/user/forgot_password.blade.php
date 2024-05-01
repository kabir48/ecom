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
                            <h2 class="form_title">SIGN IN</h2>
                            <form class="form-my-account" method="POST" action="{{ url('user/forgot-password') }}" id="loginForm">
                                        @csrf
										<h2 class="title">Forgot Password</h2>
										<p>
                                            <input type="email" placeholder="Email*" name="email" id="email" required/></p>
										  @if ($errors->has('email'))
                                                <span class="invalid-feedback" role="alert">
                                                <strong>{{$errors->first('email')}}</strong>
                                              </span>
                                           @endif
										 </p>
										<p><input type="submit" value="Submit"/></p>
									</form>
                               <a  href="{{url('user/login-registers')}}" class="forgotpass">Back To Login</a>
                        </div>
                    </div>
				</div>
			</div>
		</div>
		<!-- End Content Page -->
	  </main>
      @endsection

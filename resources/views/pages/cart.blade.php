@extends('layouts.app')

@section('content')
<link href="{{asset('public/frontend/assets/css/cart.css')}}" rel="stylesheet" type="text/css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 <style>
     .row{
        margin-top: 0 !important;
        margin-right:0px !important; 
        margin-left: 0 !important; 
    }
    a{
        text-decoration: none;
    }
.footer .footer-top .h4 {
    font-weight: 600;
}
.footer-links a {
    font-size: 14px;
}
.display-table-cell p{
    font-size: 14px;
}
.btn {
    -moz-user-select: none;
    -ms-user-select: none;
    -webkit-user-select: none;
    user-select: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    display: inline-block;
    width: auto;
    height: auto;
    text-decoration: none;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    border: 1px solid transparent;
    border-radius: 0;
    padding: 8px 15px 8px;
    background-color: #000;
    color: #fff;
    font-family: 'Poppins', sans-serif;
    font-weight: 400;
    text-transform: uppercase;
    letter-spacing: 1px;
    line-height: normal;
    white-space: normal;
    font-size: 13px;
    -ms-transition: all 0.3s ease-in-out;
    -webkit-transition: all 0.3s ease-in-out;
    transition: all 0.3s ease-in-out;
}
.btn-primary:hover {
    color: #fff;
    background-color: #5e5e5e;
    border-color: #0a58ca;
}
.btn:hover {
    color: #fff;
}
     
 </style>
  <!-- Breadcrumb Section Start -->
    <section class="breadscrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadscrumb-contain">
                        <h2>@if(session()->get('lang')=='bangla') {{__('heading.cart_page_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.cart_page_en')}} @else {{__('heading.cart_page_bn')}} @endif</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{url('/')}}">
                                       <i class="fas fa-home"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active" aria-current="page">@if(session()->get('lang')=='bangla') {{__('heading.cart_page_bn')}} @elseif(session()->get('lang')=='english') {{__('heading.cart_page_en')}} @else {{__('heading.cart_page_bn')}} @endif</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container" >
            <div class="row g-sm-5 g-3" id="appendCartItem">
                @include('pages.cart_iteams')
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
   
  @endsection










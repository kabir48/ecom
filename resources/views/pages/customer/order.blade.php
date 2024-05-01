@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')

    <div id="page-content">
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="index.html" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>My Account</span></div>
            </div>
        </div>
        <!--End Breadcrumbs-->
        <div class="container">
        	<div class="page-title"><h1>My Account</h1></div>
            <div class="dashboard-upper-info">
            	<div class="row align-items-center no-gutters">
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="d-single-info">
                        <p class="user-name">Hello <span class="font-weight-600">{{ Auth::user()->name }}</span></p>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12">
                    <div class="d-single-info">
                        <p>My Email.</p>
                        <p>{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-12">
                    <div class="d-single-info">
                        <p>Contact Us </p>
                        <p>{{ $setting->email }}</p>
                    </div>
                </div>

            </div>
	        </div>
            <div class="row mb-5">
                <div class="col-xl-2 col-lg-2 col-md-12 md-margin-20px-bottom">
                    @include('pages.customer.sidebar')
                </div>
                <div class="col-xs-10 col-lg-10 col-md-12">
                    <!-- Tab panes -->
                    <div class="tab-content dashboard-content" style="">
                        <!-- Orders -->
                        <div id="orders" class="product-order">
                            <h3>Order details</h3>
                            <div class="table-responsive">
                                <table class="bg-white table table-bordered table-hover text-center">
                                    <thead class="alt-font">
                                        <tr>
                                            <th>Product Code</th>
                                            <th>Product Image</th>
                                            <th>Product name</th>
                                            <th>Product Size</th>
                                            <th>Product Color</th>
                                            <th>Total</th>
                                            <th>Review</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($orderDetails['products'] as $order)
                                        <tr>
                                            <td>{{$order['product_code']}}</td>
                                            <td>
                                                <?php $getProductImage=App\Product::getProductImage($order['product_id']);  ?>
                                                <img  src="{{asset($getProductImage)}}" alt="" height="60">
                                            </td>
                                            <td>{{$order['product_name']}}</td>
                                            <td>{{$order['product_size']}}</td>
                                            <td>{{$order['product_color']??"No Color for this Items"}}</td>
                                            <td>Tk.{{ $orderDetails['total'] }}</td>
                                            @if($orderDetails['status']==3)
                                                @if($order['comment']==Null)
                                                <td><a class="view" href="{{url('check-user-review-post/'.$order['id'])}}">Give FeedBack</a></td>
                                                @else
                                                <p style="color:#7D0552;font-weight800">You Have Already Placed Your Review Thanks</p>
                                                @endif
                                            @else
                                            <td><a class="view">Waiting</a></td>
                                            @endif
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- End Orders -->
                    </div>
                    <!-- End Tab panes -->
                </div>
            </div>
        </div><!--End Body Container-->
    </div><!--End Page Wrapper-->

@endsection




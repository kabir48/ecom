@extends('layouts.app')
@section('title', 'Customer Account')
@section('content')
    <div id="page-content">
        <!--Body Container-->
        <!--Breadcrumbs-->
        <div class="breadcrumbs-wrapper">
        	<div class="container">
            	<div class="breadcrumbs"><a href="{{ url('/') }}" title="Back to the home page">Home</a> <span aria-hidden="true">|</span> <span>Return Order page</span></div>
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
                            <h3> My Orders</h3>
                            <div class="table-responsive">
                                <table class="bg-white table table-bordered table-hover text-center">
                                    <thead class="alt-font">
                                        <tr>
                                            <tr>
                                                <th>PaymentMethod</th>
                                                <th>Return</th>
                                                <th>Amount</th>
                                                <th>Date</th>
                                                <th>Status </th>
                                                <th>Action</th>
                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                       @foreach($orders as $row)
                                       <tr>
                                        <td>{{$row->payment_method }}</td>
                                        <td>
                                            @if($row->return_order == 0)
                                            <span class="badge btn-warning">No Request</span>
                                            @elseif($row->return_order == 1)
                                            <span class="badge btn-info">Pending</span>
                                            @elseif($row->return_order == 2)
                                            <span class="badge btn-info">Success </span>
                                            @endif
                                        </td>
                                        <td>TK.{{ $row->total }}</td>
                                        <td>TK.{{$row->date}}</td>
                                        <td>
                                            @if($row->status == 0)
                                            <span class="badge btn-warning">Pending</span>
                                            @elseif($row->status == 1)
                                            <span class="badge btn-info">Payment Accept</span>
                                            @elseif($row->status == 2)
                                            <span class="badge btn-info">Progress </span>
                                            @elseif($row->status == 3)
                                            <span class="badge btn-success">Delevered </span>
                                            @else
                                            <span class="badge btn-danger">Cancel </span>
                                            @endif
                                        </td>

                                         <td>
                                            <?php
                                            $comming_day=date('d-m-y',strtotime("+3 day"));//return reason table
                                            //echo "<pre>";print_r($last_month);die;
                                            ?>
                                          @if($row->date<$comming_day)
                                           <p class="badge btn-primary">Your return Time Expiired</p>
                                            @else
                                            @if($row->return_order == 0)
                                            <a href="{{ url('user/request-return/'.$row->id) }}" class="btn btn-sm btn-danger" id="return">Return</a>
                                            @elseif($row->return_order == 1)
                                            <span class="badge btn-info">Pending</span>
                                            @elseif($row->return_order == 2)
                                            <span class="badge btn-info">Success </span>
                                            @endif

                                            @endif
                                        </td>
                                    </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <p>* For returing your products You should Show the Valid and Authenticate Reasons and <strong>After 2 Days of Delevery No Return will be Applicable</strong></p>
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







@extends('layouts.app')
@section('title','Tracking')
@section('content')
<link rel="stylesheet" href="{{asset('public/frontend/assets/css/orderlist.css')}}">
<link rel="stylesheet" href="{{asset('public/frontend/assets/css/main.css')}}">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<style type="text/css">
	p{padding-top: 11px};
	
	a{
       text-decoration:none;
    }
</style>

<section class="orderlist-part" style="margin-bottom: 45px;
    margin-top: 131px;">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="orderlist-filter">
						<h3>My Orders<span> Tracking</span></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="orderlist">
						<div class="orderlist-head">
							<h3>Orders No:#{{$track->order_no}}</h3>
							@if($track->status == 1)
							<h4><a href="" target="_blank">orders</a> Recieved</h4>
							@elseif($track->status == 2)
							<h4><a href="" target="_blank">orders</a> Processing</h4>
							@elseif($track->status == 3)
							<h4><a href="" target="_blank">orders</a> Shipped</h4>
							@elseif($track->status == 4)
							<h4><a href="" target="_blank">orders</a> Delivered</h4>
							@elseif($track->status == 6)
							<h4><a href="" target="_blank">orders</a> Cancelled</h4>
							@endif
						</div>
						<div class="orderlist-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="order-track">
										<ul class="order-track-list">
											@if($track->status == 1)
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Recieved</span>
											</li>
											<li class="order-track-item"><i class="fa fa-times" aria-hidden="true"></i><span>orders Processing</span>
											</li>
											<li class="order-track-item"><i class="fa fa-times" aria-hidden="true"></i><span>orders Shipped</span>
											</li>
											<li class="order-track-item"><i class="fa fa-times" aria-hidden="true"></i><span>orders delivered</span>
											</li>
											@elseif($track->status==2)
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>orders recieved</span>
											</li>
											</li>
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>orders Processing</span>
											</li>
											<li class="order-track-item"><i class="fa fa-times" aria-hidden="true"></i><span>orders shipped</span>
											</li>
											<li class="order-track-item"><i class="fa fa-times" aria-hidden="true"></i><span>orders delivered</span>
											</li>
											@elseif($track->status==3)
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Recieved</span>
											</li>
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Processing</span>
											</li>
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Shipped</span>
											</li>
											<li class="order-track-item"><i class="fa fa-times" aria-hidden="true"></i><span>Orders Delivered</span>
											</li>
											@elseif($track->status==4)
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Recieved</span>
											</li>
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Processed</span>
											</li>
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Shipped</span>
											</li>
											<li class="order-track-item active"><i class="fa fa-check" aria-hidden="true"></i><span>Orders Delivered</span>
											</li>
											@elseif($track->status==6)
											<li class="order-track-item active"><i class="fa fa-times" aria-hidden="true"></i><span>Orders Cancelled</span>
											</li>
											@endif
										</ul>
									</div>
								</div>
								<div class="col-lg-5">
									<ul class="orderlist-details">
										@if($track->status==1 || $track->status==2)
										<li>
											<h5>Delivered By:</h5>
											<p style="">{{$track->delivery_man}}</p>
										</li>
									
										@else
										<li>
											<h5>Payment Method:</h5>
											<p>{{$track->payment_gateway}}</p>
										</li>
										@endif
										@if($track->Expected_date==NULL ||$track->Expected_date==NULL)
										<li>
											<h5>Orders Created:</h5>
											<p>{!! date('d-M-y', strtotime($track->created_at)) !!}</p>
										</li>
										@else
										<li>
											<h5>Expected Delivery Date:</h5>
											<p>{{$track->Expected_date}}</p>
										</li>
										
										<li>
											<h5>Courier Name:</h5>
											<p>{{$track->delivery_man}}</p>
										</li>
										@endif
										<li>
											<h5>Total Item:</h5>
											<p>{{count($details)}} Items</p>
										</li>
									</ul>
								</div>
								<div class="col-lg-4">
									<ul class="orderlist-details">
										<li>
											<h5>Subtotal:</h5>
											<p>$.{{$track->subtotal}}</p>
										</li>
										<li>
											<h5>Delivery Fee:</h5>
											<p>$.{{$track->shipping_cost}}</p>
										</li>
										@if($track->coupon_amount !=Null)
										<li>
											<h5>Discount:</h5>
											<p>TK.{{$track->coupon_amount}}</p>
										</li>
										@endif
										<li>
											<h5>Total:</h5>
											<p>TK.{{$track->total}}</p>
										</li>
										@if($track->payment_type)
										<li>
											<h5>Payment Type:</h5>
											<p>{{$track->payment_type}} Items</p>
										</li>
										@endif
									</ul>
								</div>
								<div class="col-lg-3">
									<div class="orderlist-deliver">
										<h5>Delivery location</h5>
										<p>{{$shipping->area}}/ {{$shipping->address}}/ {{$shipping->country}}</p>
									</div>
								</div>
								<div class="col-lg-12">
									<div class="table-scroll">
										<table class="table-list">
											<thead>
												<tr>
													<th scope="col">SL No</th>
													<th scope="col">Product</th>
													<th scope="col">Name</th>
													<th scope="col">Price</th>
													<th scope="col">Quantity</th>
													<th scope="col">Total</th>
												</tr>
											</thead>
											<tbody>@foreach($details as $key=>$detail)
												<tr>
													<td>
														<h5>{{$key+1}}</h5>
													</td>
													<td>
														<img src="{{asset($detail->image_one)}}" alt="product">
													</td>
													<td>
														<h5>{{$detail->product_name}}</h5>
													</td>
													<td>
														<h5>TK.{{$detail->singleprice}}</h5>
													</td>
													<td>
														<h5>{{$detail->product_quantity}}</h5>
													</td>
													<td>
														<h5>Tk.{{$detail->totalprice}}</h5>
													</td>
												</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
    </section>


@endsection















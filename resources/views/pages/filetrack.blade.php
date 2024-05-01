
@extends('layouts.app')
@section('content')
<link rel="stylesheet" href="{{asset('public/website/css/orderlist.css')}}">
<link rel="stylesheet" href="{{asset('public/website/css/main.css')}}">
<section class="orderlist-part">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="orderlist-filter">
						<h3>My Orders<span>Tracking</span></h3>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12">
					<div class="orderlist">
						<div class="orderlist-head">
							<h4>order#02</h4>
							<h4>order processed</h4>
						</div>
						<div class="orderlist-body">
							<div class="row">
								<div class="col-lg-12">
									<div class="order-track">
											<ul class="order-track-list">
											<li class="order-track-item active"><i class="icofont-check"></i><span>order recieved</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order processed</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order shipped</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order delivered</span>
											</li>
										</ul>


										<ul class="order-track-list">
											<li class="order-track-item active"><i class="icofont-check"></i><span>order recieved</span>
											</li>
											<li class="order-track-item active"><i class="icofont-check"></i><span>order processed</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order shipped</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order delivered</span>
											</li>
										</ul>



											<ul class="order-track-list">
											<li class="order-track-item active"><i class="icofont-check"></i><span>order recieved</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order processed</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order shipped</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order delivered</span>
											</li>
										</ul>


										<ul class="order-track-list">
											<li class="order-track-item active"><i class="icofont-check"></i><span>order recieved</span>
											</li>
											<li class="order-track-item active"><i class="icofont-check"></i><span>order processed</span>
											</li>
											<li class="order-track-item active"><i class="icofont-check"></i><span>order shipped</span>
											</li>
											<li class="order-track-item"><i class="icofont-close"></i><span>order delivered</span>
											</li>
										</ul>


										<ul class="order-track-list">
											<li class="order-track-item active"><i class="icofont-check"></i><span>order recieved</span>
											</li>
											<li class="order-track-item active"><i class="icofont-check"></i><span>order processed</span>
											</li>
											<li class="order-track-item active"><i class="icofont-check"></i><span>order shipped</span>
											</li>
											<li class="order-track-item active"><i class="icofont-check"></i><span>order delivered</span>
											</li>
										</ul>
									</div>
								</div>
								<div class="col-lg-5">
									<ul class="orderlist-details">
										<li>
											<h5>order id</h5>
											<p>14667</p>
										</li>
										<li>
											<h5>Total Item</h5>
											<p>6 Items</p>
										</li>
										<li>
											<h5>Order Time</h5>
											<p>7th February 2021</p>
										</li>
										<li>
											<h5>Delivery Time</h5>
											<p>12th February 2021</p>
										</li>
									</ul>
								</div>
								<div class="col-lg-4">
									<ul class="orderlist-details">
										<li>
											<h5>Sub Total</h5>
											<p>$10,864.00</p>
										</li>
										<li>
											<h5>discount</h5>
											<p>$20.00</p>
										</li>
										<li>
											<h5>delivery fee</h5>
											<p>$49.00</p>
										</li>
										<li>
											<h5>Total<small>(Incl. VAT)</small></h5>
											<p>$10,874.00</p>
										</li>
									</ul>
								</div>
								<div class="col-lg-3">
									<div class="orderlist-deliver">
										<h5>Delivery location</h5>
										<p>jalkuri, fatullah, narayanganj-1420. word no-09, road no-17/A</p>
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
											<tbody>
												<tr>
													<td>
														<h5>01</h5>
													</td>
													<td>
														<img src="../../images/shop/product/grocery/04.jpg" alt="product">
													</td>
													<td>
														<h5>Heriloom Quinoa</h5>
													</td>
													<td>
														<h5>$18<small>/per kilo</small></h5>
													</td>
													<td>
														<h5>2</h5>
													</td>
													<td>
														<h5>$32.00</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>02</h5>
													</td>
													<td>
														<img src="../../images/shop/product/grocery/05.jpg" alt="product">
													</td>
													<td>
														<h5>Red Bulgur</h5>
													</td>
													<td>
														<h5>$25<small>/4 packet</small></h5>
													</td>
													<td>
														<h5>3</h5>
													</td>
													<td>
														<h5>$75.00</h5>
													</td>
												</tr>
												<tr>
													<td>
														<h5>03</h5>
													</td>
													<td>
														<img src="../../images/shop/product/grocery/06.jpg" alt="product">
													</td>
													<td>
														<h5>Silken Tofu</h5>
													</td>
													<td>
														<h5>$32<small>/12 pices</small></h5>
													</td>
													<td>
														<h5>5</h5>
													</td>
													<td>
														<h5>$160.00</h5>
													</td>
												</tr>
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

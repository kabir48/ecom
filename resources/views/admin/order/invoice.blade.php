
<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
                <h2 class="text-center" style="font-weight: bold"><img src="{{asset('public/media/logo/'.$sitesetting->logo)}}" alt=""></h2>
                <p class="text-center"> <strong>Phone Number:</strong> {{$sitesetting->phone_one}}</p>
                <p class="text-center"> <strong>Email Us:</strong> {{$sitesetting->email}}</p>
    			<h2 style="font-weight: bold">Invoice</h2><h3 class="pull-right"><span style="color:#0B7CBB">Customer Order Count:</span>{{$total_order}} Invoice N0: #{{$orderInvoice->order_no}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
    					{{$userDetails->name }}<br>
    					{{$userDetails->address??"Not Given"}}<br>
    					{{$userDetails->country??"not given"}}<br>
    					{{$userDetails->phone}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped To:</strong><br>
    					{{$shipping->name}}<br>
    					{{$shipping->address}}<br>
    					{{$shipping->country}}<br>
                        {{$shipping->phone}}

    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
                       <address>
    					<strong>Payment Method:</strong><br>
    					{{$orderInvoice->payment_gateway}}method<br>
                        {{$userDetails->email}}
                        </address>
    			</div>
    			<div class="col-xs-6 text-right">
    					<strong><span style="color:#0B7CBB">Customer Order</span> Date:</strong><br>
    					{!! date('d-M-y', strtotime($orderInvoice->created_at)) !!}<br><br>
    			</div>
    		</div>
    	</div>
    </div>

    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong><span style="color:#0B7CBB">Customer Order</span> summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td class="text-left" style="font-size:14px"><strong> Product Code</strong></td>
        							<td class="text-center" style="font-size:14px"><strong>Poduct Name</strong></td>
        							<td class="text-center" style="font-size:14px"><strong>Poduct Weight/Size</strong></td>
        							<td class="text-center" style="font-size:14px"><strong>Poduct Color</strong></td>
        							<td class="text-center" style="font-size:14px"><strong>Product Quantity</strong></td>
        							<td class="text-center" style="font-size:14px"><strong> Unit Price</strong></td>
        							<td class="text-right" style="font-size:14px"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							@foreach($orderInvoice->products as $row)
    							<tr>
    								<td class="text-left">{{$row->product_code}}</td>
    								<td class="text-center">{{$row->product_name}}</td>
    								<td class="text-center">{{$row->product_size }}</td>
    								<td class="text-center">{{$row->product_color??"No Color For this Item"}}</td>
    								<td class="text-center">{{ $row->product_quantity}}</td>
    								<td class="text-center">TK.{{$row->singleprice}}</td>
    								<td class="text-right">TK.{{$row->totalprice}}</td>
    							</tr>
                                @endforeach

    							<tr>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line"></td>
    								<td class="thick-line text-center"><strong>Subtotal:</strong></td>
    								<td class="thick-line text-right">TK.{{$orderInvoice->subtotal}}</td>
    							</tr>
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Shipping(+):</strong></td>
    								<td class="no-line text-right">TK.{{$orderInvoice->shipping_cost}}</td>
    							</tr>
                                @if($orderInvoice->coupon_amount !=NULL)
                                <tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Coupon Discount(-):</strong></td>
    								<td class="no-line text-right">TK.{{$orderInvoice->coupon_amount}}</td>
    							</tr>
                                @endif
    							<tr>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line"></td>
    								<td class="no-line text-center"><strong>Total:</strong></td>
    								<td class="no-line text-right">TK.{{$orderInvoice->total}}</td>
    							</tr>
    						</tbody>
    					</table>
                          @php
                         use Carbon\Carbon;
						 $now = Carbon::now();
                         @endphp
                        <p>Printed Date:{{date('d/M/Y'.'@'.'h:i a', strtotime($now))}}</p>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>

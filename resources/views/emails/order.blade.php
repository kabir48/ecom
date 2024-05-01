<html>
<body>
	<table width='700px'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('public/media/logo/'.$sitesetting->logo)}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Hello {{ $name }},</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you for shopping with us. Your order details are as below :-</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Order No: {{ $order_id }}</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table width='95%' cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
				<tr bgcolor="#cccccc">
					<td>Product Name</td>
					<td>Product Code</td>
					<td>Size/Weight</td>
					<td>Color</td>
					<td>Quantity</td>
					<td>Unit Price</td>
				</tr>
				@foreach($productDetails['products'] as $product)
					<tr>
						<td>{{ $product['product_name'] }}</td>
						<td>{{ $product['product_code'] }}</td>
						<td>{{ $product['product_size'] }}</td>
						<td>{{ $product['product_color']??"No color for this Item" }}</td>
						<td>{{ $product['product_quantity'] }}</td>
						<td>TK.{{$product['singleprice'] }}</td>
					</tr>
				@endforeach
                <tr>
					<td colspan="5" align="right">Order_No:</td><td>{{ $productDetails['order_no'] }}</td>
				</tr>
                	<tr>
					<td colspan="5" align="right">payment_gateway:</td><td>{{ $productDetails['payment_gateway'] }}</td>
				</tr>
                <tr>
					<td colspan="5" align="right">Tracking Code:</td><td>{{ $productDetails['status_code']}}</td>
				</tr>
                @if(Session::has('couponAmount'))
				<tr>
					<td colspan="5" align="right">Coupon Discount:</td><td>TK. {{ $productDetails['coupon_amount'] }}</td>
				</tr>
                @endif
                <tr>
					<td colspan="5" align="right">Shipping Charge:</td><td>TK.{{ $productDetails['shipping_cost'] }}</td>
				</tr>
				<tr>
					<td colspan="5" align="right">Grand Total:</td><td>TK.{{ $productDetails['total']}}</td>
				</tr>
			</table>
		</td></tr>
		<tr><td>
			<table width="100%">
				<tr>
					<td width="50%">
						<table>
							<tr>
								<td><strong>Billing To :-</strong></td>
							</tr>
							<tr>
								<td>{{ $userDetails['name'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['address'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['country'] }}</td>
							<tr>
								<td>{{ $userDetails['pincode'] }}</td>
							</tr>
							<tr>
								<td>{{ $userDetails['phone'] }}</td>
							</tr>
						</table>
					</td>
					<td width="50%">
						<table>
							<tr>
								<td><strong>Shipping To :-</strong></td>
							</tr>
							<tr>
								<td>{{ $shippinAddress->name}}</td>
							</tr>
							<tr>
								<td>{{ $shippinAddress->address}}</td>
							</tr>
							<tr>
								<td>{{ $shippinAddress->country}}</td>
							</tr>
							<tr>
								<td>{{ $shippinAddress->area}}</td>
							</tr>
							<tr>
								<td>{{ $shippinAddress->phone}}</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td></tr>
	<tr><td><strong>Further Information</strong></td></tr>
        <tr><td>For any enquiries, You can contact us at Our Phone:<strong> {{$sitesetting->phone_one}}</strong></a></td></tr>
		<tr><td>For any enquiries, You can also come to our Address at :<strong> {{$sitesetting->company_address}}</strong></a></td></tr>
        <tr><td>For any enquiries, You can Mail us at:<a href="mailto:{{ $sitesetting->email }}">{{ $sitesetting->email }}</a></td></tr>

		<tr><td>&nbsp;</td></tr>
		<tr><td>Regards,<br> Team Bigben</td></tr>
		<tr><td>Very Soon We Will Notify You</td></tr>
		<tr><td>Save The Environment...Be safe</td></tr>
	</table>
</body>
</html>

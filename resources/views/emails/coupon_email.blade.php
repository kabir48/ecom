<html>
<body>
	<table width='700px'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('public/media/logo/'.$sitesetting->logo)}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you for shopping with us.Your Coupon Code:<strong> {{$coupon_code}}</strong> to get <strong>{{$amount}}</strong>@if($amount_type == 'Fixed')TK @else % @endif discount</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Your Coupon Code Will Expired at: <strong>{{$expiry_date}}</strong> So,Please Do Quickly Shopping</td></tr>
		</td></tr>
		<tr><td><strong>Further Information</strong></td></tr>
        <tr><td>For any enquiries, you can contact us at Our Phone: <strong>{{$sitesetting->phone_one}}</strong></a></td></tr>
		<tr><td>For any enquiries, you can also come to our Address at : <strong>{{$sitesetting->company_address}}</strong></a></td></tr>
         <tr><td>For any enquiries, you can Mail us at:<a href="mailto:{{ $sitesetting->email }}">{{ $sitesetting->email }}</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Regards,<br>Team Quickee</td></tr>
		<tr><td>Save The Environment...Be safe</td></tr>
	</table>
</body>
</html>

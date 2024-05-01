<html>
<body>
	<table width='700px'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('public/media/logo/'.$sitesetting->logo)}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Dear {{$name}}</td></tr>
		<tr><td>Thank you for Your Query.Your Information  we will notify You by Phone
            <br>
            <br>
            <strong>Phone Number:{{$phone}}</strong><br>
            <strong>Your Car:{{$car_name}}</strong><br>
            <strong>Model name:{{$model_no}}</strong><br>
            <strong>Brand name:{{$brand_name}}</strong></td></tr>
		<tr><td>&nbsp;</td></tr>
		</td></tr>
		<tr><td>Further Information</td></tr>
        <tr><td>For any enquiries, you can contact us at Our Phone:<strong>{{$sitesetting->phone_one}}</strong></a></td></tr>
		<tr><td>For any enquiries, you can also come to our Address at :<strong>{{$sitesetting->company_address}}</strong></a></td></tr>
        <tr><td>For any enquiries, you can Mail us at:<a href="mailto:{{ $sitesetting->email }}">{{ $sitesetting->email }}</a></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Regards,<br> Team Quickee</td></tr>
		<tr><td>Very Soon We Will Notify You</td></tr>
		<tr><td>Save The Environment...Be safe</td></tr>
	</table>
</body>
</html>

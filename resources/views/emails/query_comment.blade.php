<html>
<body>
	<table width='700px'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('public/media/logo/'.$sitesetting->logo)}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Dear {{$productEmail->name}}</td></tr>
		<tr><td>Thank you for Your Query.Your Information:
            <strong>{{$productEmail->phone}}</strong> Type of Trip:
            <strong>{{$productEmail->departure}}</strong>Your Departure date:
            <strong>{{$productEmail->departure_date}}</strong></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>{!!$comment!!}</td></tr>
		<tr><td>&nbsp;</td></tr>o
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

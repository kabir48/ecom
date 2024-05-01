<html>
<body>
	<table width='700px'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('public/media/logo/'.$sitesetting->logo)}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Hello {{ $name }},</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td> {{$status}})</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thanks</td></tr>
		<tr><td><strong>Further Information</strong></td></tr>
        <tr><td>Phone: <strong>{{$sitesetting->phone_one}}</strong></a></td></tr>
        <tr><td>Mail us at:<a href="mailto:{{ $sitesetting->email }}">{{ $sitesetting->email }}</a></td></tr>

	
		<tr><td>Regards,<br> Team {{$sitesetting->company_name}}</td></tr>
		<tr><td>Happy Shopping</td></tr>
	</table>
</body>
</html>
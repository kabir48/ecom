<html>
    <head>
    <title>Forget Password</title>
    </head>
<body>
	<table width='700px'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="{{asset('public/media/logo/'.$sitesetting->logo)}}"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Hello {{ $name }},</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td> Your New Password as Below:-</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table width='95%' cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                <tr>
					<td>PASSWORD: <strong>{{$password}}</strong>
					</td>
				</tr>
				 <tr>
                   <td>Email:({{$email}})</td>
                 </tr>
          
			</table>
		</td></tr>
	
	<tr><td><strong>Further Information</strong></td></tr>
        <tr><td>For any enquiries, You can contact us at Our Phone:<strong> {{$sitesetting->phone_one}}</strong></a></td></tr>
		<tr><td>For any enquiries, You can also come to our Address at :<strong> {{$sitesetting->company_address}}</strong></a></td></tr>
        <tr><td>For any enquiries, You can Mail us at:<a href="mailto:{{ $sitesetting->email }}">{{ $sitesetting->email }}</a></td>
        </tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Save The Environment...Be safe</td>
		</tr>
	</table>
</body>
</html>

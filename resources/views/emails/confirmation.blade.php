<html>
    <head>
    <title>Activition Code</title>
    </head>
<body>
	<table width='700px'>
		<tr><td>&nbsp;</td></tr>
		<tr><td><img src="https://bigbenbd.com/public/media/logo/93639.png"></td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Hello {{ $name }},</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>Thank you for Login. Please Change it, and use it to your dashboard::-</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>&nbsp;</td></tr>
		<tr><td>
			<table width='95%' cellpadding="5" cellspacing="5" bgcolor="#f7f4f4">
                <tr>
					<td> Your Password: {{$code}} </td>
				</tr>
          
			</table>
		</td></tr>
	
	<tr><td><strong>Further Information</strong></td></tr>
        <tr><td>For any enquiries, You can contact us at Our Phone:<strong> {{$sitesetting->phone_one}}</strong></a></td></tr>
		<tr><td>For any enquiries, You can also come to our Address at :<strong> {{$sitesetting->company_address}}</strong></a></td></tr>
        <tr><td>For any enquiries, You can Mail us at:<a href="mailto:{{ $sitesetting->email }}">{{ $sitesetting->email }}</a></td></tr>

		<tr><td>&nbsp;</td></tr>
		<tr><td>Regards,<br> Team Bigben BD</td></tr>
		<tr><td>Very Soon We Will Notify You</td></tr>
		<tr><td>Save The Environment...Be safe</td></tr>
	</table>
</body>
</html>


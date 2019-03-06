
<div style='width: 100%; background-color: #88bdbf; margin: 0; padding: 50px 0;'>
	<div style='width: 50%; background-color: #f3f3f3; margin: 0 auto; padding: 50px 50px 15px; box-shadow: 8px 8px 5px #7eafb1;'>
		<table style="background-color: #5a378c" cellpadding='0' cellspacing='0'>
			
		</table>
		<div style='width: 100%; background-color: #FFF; margin: 10px 0 30px; border-radius: 5px; box-shadow: 0 4px 2px -2px #dedede;'>
			<table cellpadding='0' cellspacing='0'>
				
				<tr>
					<td>
						<h1 style="text-align: center; margin: 20px 0; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-weight: normal;">Reset Password</h1>
					</td>
				</tr>
				<tr>
					<td>
						<p style="text-align: center; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-weight: normal; margin-left: 10px;">Please click the below reset link to reset your password.</p>
						
					</td>
				</tr>
				<tr>
					<td>
						<div style='width: 180px; height: 50px; border-radius: 5px; margin: 30px auto 50px; background-color: #224e7d; '>
							<p style="text-align: center; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-weight: normal; line-height: 50px; color: #FFF; letter-spacing: 2px;"><a style="color: #ffffff" href="{{ url('reset-password') }}/{{ $enc_email }}">Reset Link</a></p>
						</div>
					</td>
				</tr>
			</table>
		</div>
		<div style='width: 100%; text-align: center;'>
			
			<p style="text-align: center; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-weight: normal; font-size: 13px; margin: 30px 0 5px; padding: 0; color: #878787;">Email sent by http://leskoranen.no/</p>
			<p style="text-align: center; font-family: Segoe, 'Segoe UI', 'DejaVu Sans', 'Trebuchet MS', Verdana, 'sans-serif'; font-weight: normal; font-size: 13px; margin: 0; padding: 0; color: #878787;">Copyrights &copy; {{ date('Y') }}   <a href="{{url('/')}}" target='_blank'>leskoranen.no/</a>, All rights reserved.</p>
		</div>
	</div>
</div>
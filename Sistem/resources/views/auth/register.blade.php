<!DOCTYPE html>
<html lang="en">
<head>
	<title>M A N T O U</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="/asset/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/asset/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/asset/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--====================================================v===========================================-->
	<link rel="stylesheet" type="text/css" href="/asset/fonts/Linearicons-Free-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/asset/vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/asset/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/asset/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/asset/vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="/asset/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="/asset/css/util.css">
	<link rel="stylesheet" type="text/css" href="/asset/css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
					@csrf
					<span class="login100-form-title p-b-34">
						Account Register
					</span>
					
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100 @error('name') is-invalid @enderror" type="text" name="name" placeholder="Nama" value="{{ old('name') }}" required autocomplete="name" autofocus>
						
						@error('name')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					</div>
					<div class="wrap-input100 rs1-wrap-input100 validate-input m-b-20" data-validate="Type user name">
						<input id="first-name" class="input100  @error('email') is-invalid @enderror" type="text" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						
						@error('email')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20">
						<input class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password"  required autocomplete="new-password">
						@error('password')
						<span class="invalid-feedback" role="alert">
							<strong>{{ $message }}</strong>
						</span>
					@enderror
					</div>
					<div class="wrap-input100 rs2-wrap-input100 validate-input m-b-20">
						<input class="input100" type="password" name="password_confirmation" placeholder="Konfirmasi"  required autocomplete="new-password">

					</div>
					
					<div class="container-login100-form-btn">
						<button type="submit" class="login100-form-btn">
							Sign Up
						</button>
					</div>

					<div class="w-full text-center p-t-27 p-b-239">

					</div>

					<div class="w-full text-center">

					</div>
				</form>

				<div class="login100-more" style="background-image: url('images/bg-01.jpg');"></div>
			</div>
		</div>
	</div>
	
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="/asset/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="/asset/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="/asset/vendor/bootstrap/js/popper.js"></script>
	<script src="/asset/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="/asset/vendor/select2/select2.min.js"></script>
	<script>
		$(".selection-2").select2({
			minimumResultsForSearch: 20,
			dropdownParent: $('#dropDownSelect1')
		});
	</script>
<!--===============================================================================================-->
	<script src="/asset/vendor/daterangepicker/moment.min.js"></script>
	<script src="/asset/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="/asset/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="/asset/js/main.js"></script>

</body>
</html>
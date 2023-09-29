<!DOCTYPE html>
<html lang="en">
<head>
	<title>Penerimaan Peserta Didik Baru Kabupaten Ogan Ilir</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="{{ asset ('assets_umum/images/logo-oi.png') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assetLogin/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assetLogin/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assetLogin/fonts/iconic/css/material-design-iconic-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/animate/animate.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('assetLogin/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset ('assetLogin/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset ('assetLogin/css/main.css') }}">
<!--===============================================================================================-->
</head>
<body>

	<div class="limiter">
      	<div class="icon align-items-center">
			<a href="/"><i class="fa fa-home me-2" style="font-size: 24px;"></i> Beranda</a>
		</div>

		<div class="container-login100" style="background-image: url('{{ asset ('assetLogin/images/bg-01.svg') }}');">

            {{ $slot }}

		</div>
	</div>

    @livewireScripts

	{{-- <div id="dropDownSelect1"></div> --}}

<!--===============================================================================================-->
	<script src="{{ asset('assetLogin/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assetLogin/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assetLogin/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('assetLogin/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assetLogin/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assetLogin/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('assetLogin/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('assetLogin/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset ('assetLogin/js/main.js') }}"></script>

    @stack('scripts')
</body>
</html>

<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ $data->name }}</title>

	<!-- Styles -->
	@vite('resources/sass/app.scss')
	<link rel="stylesheet" href="{{ asset('css/all.min.css') }}">
	<link rel="stylesheet" href="{{ asset('css/css-tooltip.min.css') }}">
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.css" />


	<style>
		html {
			font-size: 14px !important;
			font-family: 'Sarabun', sans-serif;
		}
	</style>
</head>

<body>
	{!! $data->content !!}

	<!-- Scripts -->
	<script src="{{ asset('js/jquery-3.6.1.min.js') }}"></script>
	@vite('resources/js/app.js')
	<script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs5/dt-1.12.1/datatables.min.js"></script>


	<script>
		$(document).ready(function() {
			$('#dataTable').dataTable({
				//ordering: false,
				"order": [],
				paging: false,
				info: false,
				searching: false,
			});
		});
	</script>
</body>

</html>

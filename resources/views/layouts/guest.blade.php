<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>{{ config('app.name', 'Laravel') }}</title>
	<!-- Styles -->
	@vite(['resources/sass/app.scss'])
	<style>
		a.nav-link {
			color: white !important;
		}

		a.nav-link:hover {
			color: pink !important;
		}

		.btn-web,
		.btn-danger {
			color: var(--bs-light) !important;
		}

		.dropdown-item {
			color: var(--bs-web);
		}

		.dropdown-item:hover {
			background-color: var(--bs-web);
			color: var(--bs-light);
		}
	</style>
</head>

<body class="min-vh-100">
	@include('layouts.navbar')
	@yield('content')
	<!-- Scripts -->
	@vite(['resources/js/app.js'])
</body>

</html>

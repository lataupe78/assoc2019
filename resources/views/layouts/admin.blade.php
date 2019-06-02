<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title', 'Admin')</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link href="{{ asset('css/admin.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	@yield('css')

	<!-- Scripts -->
	<!--<script src="{{ asset('js/app.js') }}"></script>-->
	@yield('scripts')

</head>
<body>
	<div id="app">

		@include('layouts.admin._navbar')

		<div id="site-wrapper" class="site-wrapper">
			<div id="site-pusher" class="site-pusher">

				@include('layouts.admin._sidebar')


				<div id="site-page-content-wrapper" class="site-page-content-wrapper">
					<!-- -->
					@include('layouts.admin._top-content')



					<main class="container py-4">
						@include('layouts.partials._alerts')
						@include('layouts.partials._breadcrumbs')

						@yield('top-content')

						@yield('content')

						<example-component>Test component Vue.js</example-component>
					</main>

					<footer class="footer">
						<p class="text-center">
							<strong>Interface d'administration</strong>
						</p>
						<p class="text-center">
							©2015 - {{ date('Y') }} Assoc 2019
						</p>
					</footer>
					<!-- -->
				</div>


				<div id="site-cache" class="site-cache"></div>

			</div>
		</div>
		<!-- -->
	</div>

	<script src="{{ asset('js/app.js') }}"></script>
	@yield('scripts_bottom')

</body>
</html>

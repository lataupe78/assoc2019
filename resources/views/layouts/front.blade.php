<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title> @yield('title', config('app.name'))</title>

	<!-- Fonts -->
	<link rel="dns-prefetch" href="//fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

	<!-- Styles -->
	<link href="{{ asset('css/app.css') }}" rel="stylesheet">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	@yield('css')

	<!-- Scripts -->
	@yield('scripts')

</head>
<body>
	<div id="app">
		@include('layouts.front._navbar', ['list_sections' => $list_sections])

		@yield('top-content')

		<main class="container py-4">
			@include('layouts.partials._alerts')
			@include('layouts.partials._breadcrumbs')

			@yield('content')
		</main>
	</div>

	<footer class="bg-dark text-white py-5">
		@yield('top-footer')
		<div class="container">
			@yield('bottom-footer-top')
			<div class="row">

				<div class="col-sm-6">
					<p class="h5">{{ config('app.name') }}</p>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Placeat blanditiis necessitatibus repudiandae, voluptates maiores veritatis libero temporibus nam, odit dolores quidem esse nostrum officiis delectus eos sunt ducimus quas. Provident!</p>
				</div>

				<div class="col-sm-6">
					<?php /*
					@include('front.contacts._form', [
					'contact' => new App\Contact,
					'section' => $section ?? new App\Section
					])
					*/ ?>

				</div>

			</div>
			@yield('footer-bottom')
		</div>
	</footer>

	<script src="{{ asset('js/app.js') }}"></script>
	@yield('scripts_bottom')

</body>
</html>

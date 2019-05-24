<?php
// Ces données sont récupérées depuis ViewComposerServiceProvider et disponible dans les vues layouts.front et layouts.admin
/*
{{ dump(Route::currentRouteAction()) }}
{{-- dump(Route::getCurrentRequest()) --}}
{{ dump(Route::currentRouteNamed()) }}
{{ dump($controller) }}
{{ dump($action) }}
{{-- dump($current_section->slug) --}}
<pre>{{-- print_r($parameters, true) --}}</pre>
*/

$main_section_id = null;
if(isset($section)){
	$main_section_id = ($section->parent_id != null)
			?	$section->parent_id
			:	$section->id;
}

//dump($main_section_id);

//$main_section_slug = ($current_section->parent_id)
?>

<nav class="navbar navbar-expand-md navbar-dark bg-dark">
	<div class="container d-flex flex-wrap align-items-start">
		<a class="mr-auto text-center" href="{{ url('/') }}">
			<div class="logo mx-auto d-none d-md-block">
				<img src="{{ url('img/home.png') }}" alt="Logo AOBuc">
			</div>
			<p class="h5 text-white text-uppercase mx-auto">{{ config('app.name', 'Laravel') }}</p>
		</a>


		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target=".navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
			<span class="navbar-toggler-icon"></span>
		</button>

		<div class="collapse navbar-collapse navbarSupportedContent">

			<!-- Right Side Of Navbar -->
			<ul class="navbar-nav ml-auto">

				@if (Route::has('refresh-datas'))
				<li class="nav-item">
					<a class="nav-link" href="{{ route('refresh-datas') }}" title="refresh database">
						<i class="fas fa-trash-alt"></i>
					</a>
				</li>
				@endif


				<?php /*
				<!-- Authentication Links -->
				@guest
				<li class="nav-item {{ Route::is('login') ? ' active' : '' }}">
					<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
				</li>
				@if (Route::has('register'))
				<li class="nav-item {{ Route::is('register') ? ' active' : '' }}">
					<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
				@endif
				@else
				<li class="nav-item dropdown">
					<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
						<img src="{{ url(auth()->user()->avatar_picture) }}" alt="avatar de {{ auth()->user()->name }}" style="max-height:40px" class="avatar-sm img-fluid mr-1 rounded-circle">
						{{ Auth::user()->name }}
						<span class="caret"></span>
					</a>

					<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

						<a class="dropdown-item{{ Route::is('users.profile.show')? ' active' :'' }}" href="{{ route('users.profile.show', ['name' => auth()->user()->name ]) }}">
							Profil
						</a>

						@if(auth()->user()->isAdmin())
						<a class="dropdown-item" href="{{ route('admin.sections.index' ) }}">
							Administration
						</a>
						@endif
						 <div class="dropdown-divider"></div>
						<a class="dropdown-item" href="{{ route('logout') }}"
						onclick="event.preventDefault();
						document.getElementById('logout-form').submit();">
						{{ __('Logout') }}
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
			@endguest
			*/ ?>
		</ul>
	</div>
</div>
</nav>


<nav class="navbar navbar-expand-md navbar-dark bg-primary">
	<div class="collapse navbar-collapse navbarSupportedContent">
		<ul class="navbar-nav w-100 nav-justified align-items-center">
			@foreach($list_sections as $section)
			<li class="nav-item{{ ($main_section_id == $section->id ) ? ' active' : '' }}">
				<a class="nav-link" href="{{ route('sections.show', ['section' => $section ]) }}">{{ $section->title }}</a>

			</li>
			@endforeach
		</ul>
	</div>
</nav>

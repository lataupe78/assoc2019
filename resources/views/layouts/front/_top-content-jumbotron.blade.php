<?php
$section = (isset($section)) ? $section : new App\Section;
?>
<div class="top-content">

	<div class="jumbotron bg-grey py-4 mb-3">
		<div class="container">
			<div class="row d-flex align-items-center">
				<div class="col-sm-4 d-none d-sm-block px-2">
					@if(isset($section))
					<img src="{{ asset($section->cover_picture) }}" alt="Image" class="img-fluid px-5 py-2">
					@endif
				</div>

				<div class="col-sm-8">

					@if (!empty($__env->yieldContent('top-content-title')))
					<h1 class="display-5 d-flex">

						@yield('top-content-title')
						@can('update', $section)
						<div class="actions ml-auto">
							<a class="btn btn-primary" href="{{ route('admin.sections.show', $section) }}">Gérer la section</a>
						</div>
						@endcan

					</h1>
					@endif
					@if (!empty($__env->yieldContent('top-content-lead')))
					<p class="lead">@yield('top-content-lead')</p>
					@endif


				</div>
			</div>
		</div>
	</div>
</div>

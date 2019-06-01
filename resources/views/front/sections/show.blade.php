@extends('layouts.front')

@section('content')




<div class="row">

	<div class="col-md-8">

		<div class="card">
			<h1>{{ $section->title }}</h1>

			{{ $section->description }}
		</div>
	</div>


	<div class="col-md-4">

		<div class="card">
			<div class="card-header">Posts</div>
			<div class="card-body">

				@foreach($section->recent_posts as $post)
				<div class="list-group-item">
					{{ $post->title }}
				</div>
				@endforeach
			</div>
		</div>

	</div>
</div>
@endsection

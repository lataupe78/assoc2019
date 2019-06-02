@extends('layouts.front')

@section('content')


@section('title', "Section {$section->title}")

@section('top-content-title', $section->title)



@section('top-content')

	@include('layouts.front._top-content-jumbotron', [ 'section' => $section ])

@endsection



<div class="row">

	<div class="col-md-8">

		<div class="card">
			<div class="card-body">
			<h1>{{ $section->title }}</h1>

			{{ $section->description }}
			</div>
		</div>
	</div>


	<div class="col-md-4">

		<div class="card">
			<div class="card-header">
				<a href="{{ route('posts.index', ['section' => $section ]) }}">Posts</a>
			</div>
			<div class="list-group list-group-flush">

				@foreach($section->recent_posts as $post)
				<div class="list-group-item">
					<a href="{{ route('posts.show', ['section' => $section, 'post' => $post ]) }}">{{ $post->title }}</a>
				</div>
				@endforeach
			</div>
		</div>

	</div>
</div>
@endsection

@extends('layouts.front')



@section('title', "Posts for {$section->title}")

@section('top-content-title', "Posts for {$section->title}")
@section('top-content')

	@include('layouts.front._top-content-jumbotron', [ 'section' => $section ])

@endsection


@section('content')

<div class="row">

	<div class="col-md-8">

		<div class="card">
			<div class="card-header">Posts</div>
			<div class="card-body list-group-flush">

				@foreach($posts as $post)
				<div class="list-group-item">
					<h5>
						<a href="{{ route('posts.show', [
						'post' => $post,
						'section' => $section
						]) }}">{{ $post->title }}</a>
					</h5>
					<p class="text-muted">{{ $post->published_at->diffForHumans() }}</p>
					<p>{{ $post->excerpt }}</p>
				</div>
				@endforeach
			</div>

			<div class="card-footer">
				{{ $posts->links('vendor.pagination.bootstrap-4') }}
			</div>
		</div>

	</div>


	<div class="col-md-4">

	</div>
</div>
@endsection

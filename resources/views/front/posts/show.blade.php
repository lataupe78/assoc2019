@extends('layouts.front')

@section('title', "Article $section->title : $post->title")

@section('top-content-title', "Article $section->title : $post->title")

@section('top-content')
@include('layouts.front._top-content-jumbotron', [
'section' => $section
])
@endsection


@section('content')
<?php /*
<div class="card mb-4">
	<h3 class="card-header">Medias</h3>
	<div class="card-body">
		<div class="row">

			@foreach($mediaItems as $media)
			<div class="col-sm-6">

				<pre>{{ print_r($media, true) }}</pre>
				<h3>{{ $media->getUrl() }}</h3>
				<h3>{{ $media->getFullUrl() }}</h3>
				<img src="{{ $media->getFullUrl() }}" class="img-fluid">

			</div>
			@endforeach
		</div>
	</div>
</div>

*/ ?>
<div class="card mb-4">
	<div class="card-body">
		<p class="text-muted text-small">Publié {{ $post->published_at->format('d/m/Y H:i') }} par <a href="{{ route('users.profile.show', ['username' => $post->author->name ]) }}">{{ $post->author->name }}</a>
		</p>

		<p>{{ $post->content }}</p>
	</div>
</div>

<div class="card mb-4">
	<div class="card-body row">
		<div class="col-sm-6 text-center">
			@if(isset($previous))
			<a href="{{ route('posts.show', [
			'section' => $section,
			'post' => $previous
			]) }}">Précédente<br>{{ $previous->title }}</a>
			@endif

		</div>
		<div class="col-sm-6 text-center">


			@if(isset($next))
			<a href="{{ route('posts.show', [
			'section' => $section,
			'post' => $next
			]) }}">Suivante<br>{{ $next->title }}</a>
			@endif

		</div>
	</div>
</div>
@endsection

@extends('layouts.front')

@section('content')

	<h1>{{ $section->title }}</h1>


	<div class="card">
		{{ $section->description }}
	</div>
@endsection

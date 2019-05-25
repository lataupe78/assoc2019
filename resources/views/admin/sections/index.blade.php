@extends('layouts.admin');

@section('content')
@foreach($sections as $section )
	<div class="card">
		<p>{{ $section->title }}</p>
	</div>
@endforeach
@endsection

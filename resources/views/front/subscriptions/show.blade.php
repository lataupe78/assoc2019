<?php
$title = "Souscription {$subscription->title} for {$section->title}";
?>

@extends('layouts.front')



@section('title', $title)

@section('top-content-title', $title)
@section('top-content')

@include('layouts.front._top-content-jumbotron', [ 'section' => $section ])

@endsection


@section('content')

<div class="row">

	<div class="col-md-8">

		<div class="card">
			<div class="card-header">{{ $subscription->title }}</div>
			<div class="card-body">
				{{ $subscription->description }}

			</div>

		</div>

	</div>

	<div class="col-md-4">

	</div>
</div>
@endsection

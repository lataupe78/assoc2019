@extends('layouts.front')

@section('title')
Profil de {{ $user->name }}
@endsection


@section('content')
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-4 text-center">
				<?php
				/*
				<img src="{{ url($user->avatar_picture) }}" alt="avatar de {{ $user->name }}" class="img-fluid mx-auto mb-2">
				*/
				?>
			</div>

			<div class="col-sm-8">
				<div class="card-text">
				<h1 class="card-title">{{ $user->name }}</h1>
				<p class="text-muted">Membre depuis {{ ($user->email_verified_at)
					? $user->email_verified_at->diffForHumans()
				: '' }}</p>


				<?php /*
				@can('update', $user)
					<a href="{{ route('users.profile.edit', ['username' => $user->name]) }}" class="btn btn-primary">Editer le profil</a>
				@endcan
				*/ ?>


				@include('front.profile._details', ['user' => $user])
			</div>
			</div>
		</div>
	</div>
</div>

@endsection

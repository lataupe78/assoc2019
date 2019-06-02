@extends('layouts.front')

@section('title')
Profil de {{ $user->name }}
@endsection


@section('content')
<div class="card">
	<div class="card-body">
		<div class="row">
			<div class="col-sm-4 text-center">
				@if($user->avatar_picture)
				<img src="{{ url($user->avatar_picture) }}" alt="avatar de {{ $user->name }}" class="img-fluid mx-auto mb-2">
				@endif
			</div>

			<div class="col-sm-8">
				<div class="card-text">
					<h1 class="card-title">{{ $user->name }}</h1>
					@if($user->isAdmin())
					<p>
						@forelse($user->managed_sections as $section)
						<span class="badge badge-info">{{ $section->title }}</span>
						@empty
						@endforelse
					</p>
					@endif

					<p class="text-muted">Membre depuis {{ ($user->email_verified_at)
						? $user->email_verified_at->diffForHumans()
					: '' }}</p>


					@can('update', $user)
					<a href="{{ route('users.profile.edit', $user) }}" class="btn btn-primary my-4">Editer le profil</a>
					@endcan

					@include('front.profile._details', ['user' => $user])
				</div>
			</div>
		</div>
		<div class="card-footer">
			@include('layouts.partials._list_admins')
		</div>
	</div>
</div>

@endsection

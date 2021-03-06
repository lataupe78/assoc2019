@extends('layouts.front')

@section('title')
Edition Profil de {{ $user->name }}
@endsection


@section('content')


<form action="{{ route('users.profile.update', $user) }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('PATCH')

	<div class="card">
		<div class="card-body">
			<div class="row">
				<div class="col-sm-4 text-center">

					<img src="{{ url($user->avatar_picture) }}" alt="avatar de {{ $user->name }}" class="img-fluid mx-auto rounded-circle">

					<div class="form-group row">
						<input type="file" id="avatar_file" name="avatar_file"
						class="form-control{{ $errors->has('avatar_file') ? ' is-invalid' : '' }}"
						placeholder="{{ __('avatar') }}"
						value="{{ old('avatar_file', $user->avatar_file) }}">
						@if ($errors->has('avatar_file'))
						<div class="invalid-feedback">{{ $errors->first('avatar_file') }}</div>
						@endif
					</div>
				</div>

				<div class="col-sm-8">
					<div class="card-text">
						<h1 class="card-title">{{ $user->name }}</h1>

						<p class="text-muted">Membre depuis {{ ($user->email_verified_at)
							? $user->email_verified_at->diffForHumans()
						: '' }}</p>


						@include('front.profile._form', ['user' => $user])
					</div>
				</div>
			</div>
		</div>


		<div class="card-footer d-flex justify-content-between">

			<a href="{{ route('users.profile.show', ['username' => $user->name]) }}" class="btn btn-default">Annuler</a>

			<button type="submit" class="btn btn-primary">{{ $buttonText ?? "Enregister "}}</button>

		</div>
	</div>


</form>

@endsection

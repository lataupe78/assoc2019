<?php
$list_admins = $list_admins ?? [];
?>
<div class="row">
	<div class="col-md-8 offset-md-2">

		<div class="card my-5">
			<div class="card-header d-flex flex-wrap align-items-center">
				<span class="mr-auto">{{ __("Admins list") }}</span>
				<span class="badge badge-pill badge-info">{{ count($list_admins) }}</span>
			</div>
			<div class="card-body">

				<div class="list-group list-group-flush">
					@forelse($list_admins as $admin)
					<div class="list-group-item d-sm-flex flex-wrap align-items-center pt-0 pb-1">
						<p class="my-0">
							@if($admin->avatar_thumb)
						<img src="{{ url($admin->avatar_thumb) }}" alt="avatar de {{ $admin->name }}" style="max-height:40px" class="avatar-sm img-fluid mr-1 rounded-circle">
						@endif

							<a href="{{ route('users.profile.show', $admin->name) }}">{{ $admin->email }}</a>
						</p>
						<div class="d-block ml-sm-auto">
							@if($admin->role === 'superadmin')
							<span class="badge badge-success">SuperAdmin</span>
							@else
							@foreach($admin->managed_sections as $section)
							<span class="badge badge-primary">{{ $section->title }}</span>
							@endforeach
							@endif

							<button class="btn btn-success btn-sm ml-1 js-btn-login" data-email="{{ $admin->email }}">Login</button>
						</div>
					</div>
					@empty
					<div class="alert alert-warning">
						{{ __("No admins defined") }}
					</div>
					@endforelse
				</div>
			</div>
		</div>

	</div>
</div>

@section('scripts_bottom')

<script>
	let btns_login = document.querySelectorAll('.js-btn-login')
	let inputEmail = document.querySelector('#email')
	let inputPassword = document.querySelector('#password')
	if(inputPassword && inputEmail){
		btns_login.forEach(function (btn, index) {
			btn.addEventListener('click', function(event){
			//event.preventDefault();
			event.target.style = 'border:4px solid red'
			//alert(event.target.dataset.email)
			inputEmail.value = event.target.dataset.email
			inputPassword.value = 'password'

		})
		});

	}
</script>
@endsection

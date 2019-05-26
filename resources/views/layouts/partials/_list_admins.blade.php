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
						<p class="my-0">{{ $admin->email }}</p>
						<div class="d-block ml-sm-auto">
							@if($admin->role === 'superadmin')
							<span class="badge badge-success">SuperAdmin</span>
							@else
							@foreach($admin->managed_sections as $section)
							<span class="badge badge-primary">{{ $section->title }}</span>
							@endforeach
							@endif
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

<?php
$list_admins = $list_admins ?? [];
?>
<div class="row">
	<div class="col-md-8 offset-md-2">

		<div class="card my-5">
			<div class="card-header">{{ __("Admins list") }}</div>
			<div class="card-body">
				<div class="list-group">
					@forelse($list_admins as $admin)
					<div class="list-group-item d-flex">
						<p>{{ $admin->email }}</p>
						<div class="ml-auto">
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

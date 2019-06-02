@extends('layouts.front')



@section('title', "Souscriptions for {$section->title}")

@section('top-content-title', "Souscriptions for {$section->title}")
@section('top-content')

	@include('layouts.front._top-content-jumbotron', [ 'section' => $section ])

@endsection


@section('content')

<div class="row">

	<div class="col-md-8">

		<div class="card">
			<div class="card-header">Souscriptions</div>
			<div class="card-body list-group-flush">

				@forelse($subscriptions as $subscription)
				<div class="list-group-item">
					<h5>
						<a href="{{ route('subscriptions.show', [
						'subscription' => $subscription,
						'section' => $section
						]) }}">{{ $subscription->title }}</a>
					</h5>

					<dl class="row">
						<dt class="col-sm-4">{{ __('starts_at') }}</dt>
						<dd class="col-sm-8 text-muted">
							{{ $subscription->starts_at->format('d/m/Y') }}
						</dd>
						<dt class="col-sm-4">{{ __('expires_at') }}</dt>
						<dd class="col-sm-8 text-muted">
							{{ $subscription->expires_at->format('d/m/Y') }}
						</dd>
						<dt class="col-sm-4">{{ __('annual_price') }}</dt>
						<dd class="col-sm-8 text-muted">
							{{ $subscription->annual_price }}
						</dd>
					</dl>

				</div>
				@empty

				<div class="alert alert-danger">
					<p>{{ __("No active subscriptions") }}</p>
				</div>
				@endforelse
			</div>
		</div>

	</div>


	<div class="col-md-4">

	</div>
</div>
@endsection

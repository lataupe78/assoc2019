@extends('layouts.admin');

@section('title', $section->title)
@section('top-content')
<div class="card">
	<div class="card-body">
		<a href="{{ route('admin.sections.index') }}" class="btn btn-default">Retour</a>

		@can('update', $section)
		<a href="{{ route('admin.sections.edit', $section->id) }}" class="btn btn-default">Editer</a>
		@endcan
	</div>
</div>

@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<h1>{{ $section->title }}</h1>
	</div>
	<div class="card-body">
		<dl class="row">
			<dt class="col-sm-4">
				{{ __('description') }}
			</dt>
			<dd class="col-sm-8">
				{{ $section->description }}
			</dd>
		</dl>
	</div>
</div>

@endsection



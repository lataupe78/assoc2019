@extends('layouts.admin');

@section('title', "Editer la section $section->title")
@section('top-content')
<div class="card">
	<div class="card-body">

		<a href="{{ route('admin.sections.index') }}" class="btn btn-default">Retour</a>

		@can('update', $section)
		<a href="{{ route('admin.sections.show', $section->id) }}" class="btn btn-default">Voir</a>
		@endcan

	</div>
</div>
@endsection

@section('content')
<div class="card">
	<div class="card-header">
		<h1>Editer {{ $section->title }}</h1>
	</div>
	<div class="card-body">
		<form action="{{ route('admin.sections.update', ['section' => $section ]) }}" method="post" enctype="multipart/form-data">
			@csrf
			@method('PATCH')

			@include('admin.sections._form', [
			'section' => $section,
			'buttonText' => "Enregistrer les modifications"
			])

		</form>
	</div>
</div>

@endsection



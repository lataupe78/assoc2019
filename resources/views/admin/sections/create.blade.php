@extends('layouts.admin')

@section('title', "Créer une Section")


@section('top-content')
<div class="card">
	<div class="card-body">

		<a href="{{ route('admin.sections.index') }}" class="btn btn-default">Retour</a>
	</div>
</div>
@endsection

@section('content')
<form action="{{ route('admin.sections.store') }}" method="post" enctype="multipart/form-data">
	@csrf
	@method('POST')

	@include('admin.sections._form', [
	'section' => $section,
	'buttonText' => "Enregistrer"
	])

</form>

@endsection

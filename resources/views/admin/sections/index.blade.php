@extends('layouts.admin');

@section('title', __("Liste des sections"))

@section('top-content')
<div class="card">
	<div class="card-body">
		<a href="{{ route('admin.sections.create') }}" class="btn btn-primary">Ajouter</a>
	</div>
</div>
@endsection


@section('content')
@foreach($sections as $k => $section )
<div class="card">
	<p>{{ $section->title }}</p>

	<div class="dropdown">
		<a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink_{{ $k }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			Actions
		</a>

		<div class="dropdown-menu" aria-labelledby="dropdownMenuLink_{{ $k }}">
			@can('update', $section)

			<a class="dropdown-item" href="{{ route('admin.sections.show', $section->id) }}">Voir</a>

			<a class="dropdown-item" href="{{ route('admin.sections.edit', $section->id) }}">Editer</a>
			@endcan

			@can('delete', $section)
			<form action="{{ route('admin.sections.destroy', $section->id) }}" method="POST" class="form-delete">
				@method('DELETE')
				@csrf
				<button type="submit" class="dropdown-item btn-delete">{{ __('delete') }}</button>
			</form>

			@endcan

		</div>
	</div>

</div>
@endforeach
@endsection


@section('scripts_bottom')
<script>
	let forms_delete = document.querySelectorAll('.form-delete');

	forms_delete.forEach(function(form){
		form.addEventListener('submit', function(e){
			e.preventDefault();
			if(confirm('Voulez vous vraiment supprimer ?')){
				e.target.submit();
			}
		})
	})

</script>
@endsection

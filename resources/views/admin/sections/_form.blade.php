<div class="card p-5">

	<div class="row">

		<div class="col-sm-3">

			<div class="card px-2">
				@if($section->cover_picture)
				<img src="{{ asset($section->cover_picture) }}" alt="Image" class="img-fluid">
				@endif

				<div class="form-group">
					<label for="cover_file">Image</label>
					<input type="file" id="cover_file" name="cover_file"
					class="form-control{{ $errors->has('cover_file') ? ' is-invalid' : '' }}"
					value="{{ old('cover_file', $section->cover_file) }}">
					@if ($errors->has('cover_file'))
					<div class="invalid-feedback">{{ $errors->first('cover_file') }}</div>
					@endif
				</div>
			</div>

		</div>

		<div class="col-sm-9">

			<div class="card card-info p-5">
				<div class="form-group">
					<label for="title">Titre</label>
					<input type="text" id="title" name="title"
					class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
					value="{{ old('title', $section->title) }}">
					@if ($errors->has('title'))
					<div class="invalid-feedback">{{ $errors->first('title') }}</div>
					@endif
				</div>
				<div class="form-group">
					<label for="slug">Slug</label>
					<input type="text" id="slug" name="slug"
					class="form-control{{ $errors->has('slug') ? ' is-invalid' : '' }}"
					value="{{ old('slug', $section->slug) }}">
					@if ($errors->has('slug'))
					<div class="invalid-feedback">{{ $errors->first('slug') }}</div>
					@endif
				</div>

				<div class="form-group">
					<label for="is_active">Publié</label>
					<div class="form-check">
						<label class="form-check-label">
							<input class="form-check-input" type="checkbox" name="is_active" id="is_active" value="1" {{ ($section->is_active) ? ' checked="checked"' :'' }}>
						</label>
					</div>
					@if ($errors->has('is_active'))
					<div class="invalid-feedback">{{ $errors->first('is_active') }}</div>
					@endif
				</div>

				<div class="form-group">
					<label for="description">Contenu</label>
					<textarea name="description"
					class="form-control {{ $errors->has('description') ? ' is-invalid' : '' }}"> {{ old('description', $section->description) }}</textarea>
					@if ($errors->has('description'))
					<div class="invalid-feedback">{{ $errors->first('description') }}</div>
					@endif
				</div>

			</div>
		</div>

	</div>

	<div class="card-footer mt-3 d-flex justify-content-between">

		<a href="{{ route('admin.sections.index') }}" class="btn btn-default">Annuler</a>

		<button type="submit" class="btn btn-primary">{{ $buttonText ?? "Enregister "}}</button>

	</div>
</div>

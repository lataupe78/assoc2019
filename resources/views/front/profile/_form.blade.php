
<div class="form-group row">
	<label for="phone" class="col-sm-3 col-form-label">{{ __('user.birth') }}</label>
	<div class="col-sm-9">
		<input type="text" id="birth" name="birth"
		class="form-control{{ $errors->has('birth') ? ' is-invalid' : '' }}"
		value="{{ old('birth', $user->birth) }}"
		placeholder="{{ __('jj/m/aaaa') }}"
		>
		@if ($errors->has('birth'))
		<div class="invalid-feedback">{{ $errors->first('birth') }}</div>
		@endif
	</div>
</div>


<div class="form-group row">
	<label for="phone" class="col-sm-3 col-form-label">{{ __('user.phone') }}</label>
	<div class="col-sm-9">
		<input type="text" id="phone" name="phone"
		class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}"
		value="{{ old('phone', $user->phone) }}"
		>
		@if ($errors->has('phone'))
		<div class="invalid-feedback">{{ $errors->first('phone') }}</div>
		@endif
	</div>
</div>


<div class="form-group row">
	<label for="city" class="col-sm-3 col-form-label">{{ __('user.city') }}</label>
	<div class="col-sm-9">
		<input type="text" id="city" name="city"
		class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}"
		value="{{ old('city', $user->city) }}"
		>
		@if ($errors->has('city'))
		<div class="invalid-feedback">{{ $errors->first('city') }}</div>
		@endif
	</div>
</div>


<div class="form-group row">
	<label for="postcode" class="col-sm-3 col-form-label">{{ __('user.postcode') }}</label>
	<div class="col-sm-9">
		<input type="text" id="postcode" name="postcode"
		class="form-control{{ $errors->has('postcode') ? ' is-invalid' : '' }}"
		value="{{ old('postcode', $user->postcode) }}"
		>
		@if ($errors->has('postcode'))
		<div class="invalid-feedback">{{ $errors->first('postcode') }}</div>
		@endif
	</div>
</div>


<div class="form-group row">
	<label for="street_address" class="col-sm-3 col-form-label">{{ __('user.street_address') }}</label>
	<div class="col-sm-9">
		<textarea id="street_address" name="street_address"
		class="form-control{{ $errors->has('street_address') ? ' is-invalid' : '' }}"
		>{{ old('street_address', $user->street_address) }}</textarea>
		@if ($errors->has('street_address'))
		<div class="invalid-feedback">{{ $errors->first('street_address') }}</div>
		@endif
	</div>
</div>


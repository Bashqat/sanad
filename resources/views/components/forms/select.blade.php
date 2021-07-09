<select
name="{{  strtolower( $name ) }}"
class="form-control select2 {{ $class }} @error(strtolower( $name )) is-invalid @enderror" style="width: 100%;"
@if ($required == "true" || $required == "1") required @endif
>
    <option value="">Select {{ $placeholder ?? $label }}</option>
    @foreach ($options as $optvalue => $option )
        <option value="{{ $optvalue }}" {{ ($value != " " && html_entity_decode($value) == $optvalue ) ? "selected":"" }}>{{ $option }}</option>
    @endforeach
</select>
@error(strtolower( $name ))
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

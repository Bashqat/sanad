<div class="form-group row">
    <label for="{{  strtolower( $name ) }}" class="col-lg-3 col-md-3 col-sm-3 col-form-label">{{ $label }} @if ($required == "true" || $required == "1")<span style="color:red;">*</span> @endif</label>
    <div class="col-lg-9 col-md-9 col-sm-9">
        <select
        name="{{  strtolower( $name ) }}"
        class="form-control select2 @error(strtolower( $name )) is-invalid @enderror" style="width: 100%;"
        @if ($required == "true" || $required == "1") required @endif
        >
            <option value="">Select {{ $label }}</option>
            @foreach ($options as $optionGroupLabel => $optionGroup )
                <optgroup label="{{ $optionGroupLabel }}">
                    @foreach ($optionGroup as $optvalue => $option )
                        <option value="{{ $optvalue }}" {{ ($value != " " && html_entity_decode($value) == $optvalue ) ? "selected":"" }}>{{ html_entity_decode($option,ENT_HTML5,'UTF-8') }}</option>
                    @endforeach
            @endforeach
        </select>
        @error(strtolower( $name ))
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
</div>


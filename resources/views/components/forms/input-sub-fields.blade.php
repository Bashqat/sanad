<div class="form-group row">
    <label for="{{  strtolower( $name ) }}" class="col-lg-3 col-md-3 col-sm-3 col-form-label">{{ ucfirst( $label ) }} @if ($required == "true" || $required == "1")<span style="color:red;">*</span> @endif</label>
    <div class="{{ $class }}">
        @foreach ($fields as $key => $field)
            @switch($field['type'])
                @case('text')
                    <input
                    type="{{ $field['type'] }}"
                    name="{{  strtolower( $name ) }}[]"
                    class="form-control {{ isset($field['class'])?$field['class']:"" }}"
                    id="{{ isset($field['id'])?$field['id']:"" }}"
                    placeholder="{{ ucfirst( $field['placeholder'] ) }}"
                    @if (!empty($value) && isset($value[$key]) ) value="{{ $value[$key] }}" @endif
                    @if ($required == "true" || $required == "1") required @endif
                    @if ($disabled == true || $disabled == "1")
                        disabled
                    @endif/>
                    @error(strtolower( $name ))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @break
                @case('tel')
                    <input
                    type="{{ $field['type'] }}"
                    name="{{  strtolower( $name ) }}[]"
                    class="form-control {{ isset($field['class'])?$field['class']:"" }}"
                    id="{{ isset($field['id'])?$field['id']:"" }}"
                    placeholder="{{ ucfirst( $field['placeholder'] ) }}"
                    @if (!empty($value) && isset($value[$key]) ) value="{{ $value[$key] }}" @endif
                    @if ($required == "true" || $required == "1") required @endif
                    @if ($disabled == true || $disabled == "1")
                        disabled
                    @endif/>
                    @error(strtolower( $name ))
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                @break
                @case('select')
                    <x-forms.select
                    name="{{ $name }}"
                    label="{{ $label }}"
                    placeholder="{{ $field['placeholder'] ?? '' }}"
                    :options="$field['options']"
                    required="{{ $required }}"
                    disabled="{{ $disabled }}"
                    value="{{ $value }}"
                    class="{{ $field['class'] }}"
                    />
                @break
            @endswitch
        @endforeach
    </div>
</div>

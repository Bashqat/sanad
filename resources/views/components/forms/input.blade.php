<!-- An unexamined life is not worth living. - Socrates -->
@switch($type)
    @case('text')
        <div class="form-group row">
            <label for="{{  strtolower( $name ) }}" class="col-lg-3 col-md-3 col-sm-3 col-form-label">{{ ucfirst( $label ) }} @if ($required == "true" || $required == "1")<span style="color:red;">*</span> @endif</label>
            <div class="col-lg-9 col-md-9 col-sm-9">
                <input
                type="{{ $type }}"
                name="{{  strtolower( $name ) }}"
                class="form-control {{ $class }}
                @error(strtolower( $name )) is-invalid @enderror"
                id="{{ strtolower( $name ) }} {{ $id }}"
                placeholder="Enter {{ ucfirst( $label ) }}"
                @if ($required == "true" || $required == "1") required @endif
                @if ($value != " ")
                    value="{{ $value }}"
                @else
                    value="{{ old(strtolower( $name ), '') }}"
                @endif
                @if ($disabled == true || $disabled == "1")
                    disabled
                @endif/>
                @error(strtolower( $name ))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @break

    @case('email')
        <div class="form-group row">
            <label for="{{  strtolower( $name ) }}" class="col-lg-3 col-md-3 col-sm-3 col-form-label">{{ ucfirst( $label ) }} @if ($required == "true" || $required == "1")<span style="color:red;">*</span> @endif</label>
            <div class="col-lg-9 col-md-9 col-sm-9">
                <input
                type="email"
                name="{{  strtolower( $name ) }}"
                class="form-control {{ $class }}
                @error('{{  strtolower( $name ) }}') is-invalid @enderror"
                id="{{ strtolower( $name ) }} {{ $id }}"
                placeholder="Enter {{ ucfirst( $label ) }}"
                @if ($required == "true" || $required == "1") required @endif
                @if ($value != " ")
                    value="{{ $value }}"
                @else
                    value="{{ old(strtolower( $name ), '') }}"
                @endif
                @if ($disabled == true || $disabled == "1")
                    disabled
                @endif/>
                @error('{{  strtolower( $name ) }}')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
        </div>
        @break

    @case('file')
    {{-- {{dd($file_ext)}} --}}
        <div class="form-group row">
            <label for="{{  strtolower( $name ) }}" class="col-lg-3 col-md-3 col-sm-3 col-form-label">{{ ucfirst( $label ) }} @if ($required == "true" || $required == "1")<span style="color:red;">*</span> @endif</label>
            <div class="col-lg-9 col-md-9 col-sm-9 input-group">
                @if ($value != "")
                <div class="thumb_img">
                    <img src="{{url('images/organization')}}/{{ $value }}" class="img-thumbnail">
                </div>
                @endif
                <div class="custom-file">
                    <input
                    type="file"
                    name="{{  strtolower( $name ) }}"
                    class="form-control custom-file-input @error('{{  strtolower( $name ) }}') is-invalid @enderror {{ $class }}"
                    id="{{ $name }}File"
                    accept="{{ $fileExt }}"
                    @if ($required == "true" || $required == "1") required @endif
                    @if ($disabled == true || $disabled == "1")
                    disabled
                    @endif/>
                    <label class="custom-file-label" for="{{ $name }}File">Choose file</label>
                </div>
                @error('{{  strtolower( $name ) }}')
                <span class="invalid-feedback" role="alert" style="display:block">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
        </div>
        @break
    @default
@endswitch

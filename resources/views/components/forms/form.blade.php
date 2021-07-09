@if ( strtolower($method) == "put")
    @php
        $methodForm = "POST"
    @endphp
@else
    @php
        $methodForm = $method
    @endphp
@endif

<form class="form-horizontal" method="{{ strtoupper($methodForm) }}" action="{{ $action }}" enctype="multipart/form-data">
    @csrf
    @if ( strtolower($method) == "put")
        @method('put')
    @endif

    @foreach ( $inputs as $input )

        {{ $value = "" }}
        @if ( !empty($values) && isset( $values->{$input['name']} ) )
            @php
                $value = $values->{$input['name']}
            @endphp
        @endif

        @switch( $input['type'] )
            @case('text')
                <x-forms.input
                type="text"
                name="{{ $input['name'] }}"
                label="{{ $input['label'] }}"
                required="{{ $input['required'] }}"
                disabled="{{ $input['disabled'] }}"
                value="{{ $value }}"
                />
                @break
            @case('file')
                <x-forms.input
                type="file"
                name="{{ $input['name'] }}"
                label="{{ $input['label'] }}"
                required="{{ $input['required'] }}"
                disabled="{{ $input['disabled'] }}"
                fileExt="{{ $input['fileExt'] }}"
                value="{{ $value }}"
                />
                @break
            @case('select')
                <div class="form-group row">
                    <label for="{{  strtolower( $input['name'] ) }}" class="col-lg-3 col-md-3 col-sm-3 col-form-label">{{ $input['label'] }} @if ($input['required'] == "true" || $input['required'] == "1")<span style="color:red;">*</span> @endif</label>
                    <div class="col-lg-9 col-md-9  col-sm-9">
                        <x-forms.select
                        name="{{ $input['name'] }}"
                        label="{{ $input['label'] }}"
                        {{-- placeholder="{{ $input['placeholder'] ?? "" }}" --}}
                        :options="$input['options']"
                        required="{{ $input['required'] }}"
                        disabled="{{ $input['disabled'] }}"
                        value="{{ $value }}"
                        />
                    </div>
                </div>
                @break
            @case('group-select')
                <x-forms.group-select
                name="{{ $input['name'] }}"
                label="{{ $input['label'] }}"
                :options="$input['options']"
                required="{{ $input['required'] }}"
                disabled="{{ $input['disabled'] }}"
                value="{{ $value }}"
                />
                @break
            @case('sub-fields')
                <x-forms.input-sub-fields
                name="{{ $input['name'] }}"
                label="{{ $input['label'] }}"
                :fields="$input['fields']"
                required="{{ $input['required'] }}"
                disabled="{{ $input['disabled'] }}"
                class="{{ $input['class'] }}"
                :value="$value"
                />
                @break
        @endswitch
    @endforeach
    <div class="form-group row">
        <div class="offset-sm-2 col-sm-10 text-right">
            <button type="submit" class="btn btn-primary">{{ ucfirst($type) }}</button>
            @if ($page == 'page')
                <a href="{{ URL::previous() }}" class="btn btn-danger">Cancel</a>
            @else
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            @endif
        </div>
    </div>
</form>


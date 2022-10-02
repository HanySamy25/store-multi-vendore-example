@props([
    'type'=>'text','name','value'=>'','id'=>'','label'=>false
])
@if ($label)
<label for="category_name">{{ $label }}</label>

@endif
<input
        type="{{ $type }}"
        name="{{ $name }}"
        value="{{ old( $name, $value)  }}"
        id="{{ $id }}"

        {{ $attributes->class(['form-control', 'is-invalid' => $errors->has($name)]) }}
        >
        @error( $name)
            <div class="invalid-feedback">
                {{ $message }}
            </div>
        @enderror



        {{-- $attribute variable will not print any attribute defined in @props --}}

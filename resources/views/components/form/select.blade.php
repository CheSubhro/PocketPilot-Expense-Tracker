
@props([
    'name',
    'label',
    'options' => [],
    'value' => '',
    'placeholder' => 'Select an option',
    'required' => false,
    'help' => null,
])

<div class="mb-3">

    <label
        for="{{ $name }}"
        class="form-label fw-semibold"
    >

        {{ $label }}

        @if($required)
            <span class="text-danger">*</span>
        @endif

    </label>


    <select
        id="{{ $name }}"
        name="{{ $name }}"
        @if($required) required @endif
        {{ $attributes->merge([
            'class' => 'form-select' . ($errors->has($name) ? ' is-invalid' : '')
        ]) }}
    >

        {{-- Placeholder --}}
        <option value="">
            {{ $placeholder }}
        </option>


        {{-- Options --}}
        @foreach($options as $option)

            <option
                value="{{ $option }}"
                @selected(old($name, $value) == $option)
            >
                {{ $option }}
            </option>

        @endforeach

    </select>


    @if($help && !$errors->has($name))

        <div class="form-text">
            {{ $help }}
        </div>

    @endif


    @error($name)

        <div class="invalid-feedback">
            {{ $message }}
        </div>

    @enderror

</div>


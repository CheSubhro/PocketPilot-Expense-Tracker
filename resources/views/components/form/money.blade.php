@props([
    'name',
    'label' => 'Amount',
    'value' => '',
    'placeholder' => '0.00',
    'required' => false,
])

<div class="mb-3">

    <label for="{{ $name }}" class="form-label fw-semibold">

        {{ $label }}

        @if($required)
            <span class="text-danger">*</span>
        @endif

    </label>

    <div class="input-group">

        <span class="input-group-text">
            ₹
        </span>

        <input
            type="number"
            id="{{ $name }}"
            name="{{ $name }}"
            value="{{ old($name, $value) }}"
            placeholder="{{ $placeholder }}"
            min="0"
            step="0.01"
            @if($required) required @endif
            {{ $attributes->merge([
                'class' => 'form-control' . ($errors->has($name) ? ' is-invalid' : '')
            ]) }}
        >

    </div>

    @error($name)
        <div class="text-danger small mt-1">
            {{ $message }}
        </div>
    @enderror

</div>
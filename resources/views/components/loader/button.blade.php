
@props([
    'text' => 'Loading...',
    'loadingText' => 'Please wait...',
    'type' => 'submit',
])

<button
    type="{{ $type }}"
    {{ $attributes->merge([
        'class' => 'btn pp-loader-btn'
    ]) }}
    data-loader-button
    data-loading-text="{{ $loadingText }}"
>
    <span class="pp-loader-btn-content">
        {{ $text }}
    </span>

    <span
        class="pp-loader-spinner d-none"
        aria-hidden="true"
    ></span>
</button>


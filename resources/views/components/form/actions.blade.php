@props([
    'cancelUrl',
    'submitText' => 'Save',
])

<div class="d-flex justify-content-between align-items-center pt-3 border-top mt-4">

    <a href="{{ $cancelUrl }}"
       class="btn btn-light px-4">
        Cancel
    </a>

    <button type="submit"
            class="btn btn-primary px-4">
        {{ $submitText }}
    </button>

</div>
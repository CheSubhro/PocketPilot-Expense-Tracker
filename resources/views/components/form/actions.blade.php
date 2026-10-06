@props([
    'cancelUrl',
    'submitText' => 'Save',
])

<div class="d-flex justify-content-end gap-2">

    <a
        href="{{ $cancelUrl }}"
        class="btn btn-light px-4"
    >
        Cancel
    </a>

    <button
        type="submit"
        class="btn btn-primary pp-loader-btn px-4"
        data-loader-button
        data-loading-text="{{ $submitText === 'Update Expense'
            ? 'Updating...'
            : 'Saving...' }}"
    >

        <span class="pp-loader-btn-content">
            {{ $submitText }}
        </span>

        <span
            class="pp-loader-spinner d-none"
            aria-hidden="true"
        ></span>

    </button>

</div>


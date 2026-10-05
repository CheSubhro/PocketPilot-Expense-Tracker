@props([
    'title',
    'description' => null,
    'backUrl' => null,
    'backText' => 'Back',
])

<div class="mb-4">

    @if($backUrl)
        <a href="{{ $backUrl }}"
           class="text-decoration-none text-muted small d-inline-flex align-items-center mb-3">
            <span class="me-1">←</span>
            {{ $backText }}
        </a>
    @endif

    <h3 class="fw-bold mb-1">
        {{ $title }}
    </h3>

    @if($description)
        <p class="text-muted mb-0">
            {{ $description }}
        </p>
    @endif

</div>
@props([
    'type' => 'success',
])

@if(session($type))

    <div class="alert alert-{{ $type }} border-0 shadow-sm">
        {{ session($type) }}
    </div>

@endif
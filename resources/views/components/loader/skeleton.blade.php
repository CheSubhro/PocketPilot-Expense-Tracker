
@props([
    'lines' => 3,
])

<div
    class="pp-skeleton-wrapper"
    aria-hidden="true"
>

    @for($i = 0; $i < $lines; $i++)

        <div
            class="pp-skeleton-line
            {{ $i === 0 ? 'pp-skeleton-lg' : '' }}"
        ></div>

    @endfor

</div>


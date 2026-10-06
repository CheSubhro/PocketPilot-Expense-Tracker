
@props([
    'rows' => 5,
])

<div
    class="pp-table-skeleton"
    aria-hidden="true"
>

    @for($i = 0; $i < $rows; $i++)

        <div class="pp-table-skeleton-row">

            <div class="pp-table-skeleton-avatar"></div>

            <div class="pp-table-skeleton-content">

                <div class="pp-skeleton-line pp-skeleton-lg"></div>

                <div class="pp-skeleton-line"></div>

            </div>

            <div class="pp-table-skeleton-amount"></div>

        </div>

    @endfor

</div>

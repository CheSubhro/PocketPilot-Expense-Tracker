<div {{ $attributes->merge([
    'class' => 'card border-0 shadow-sm'
]) }}>

    <div class="card-body p-4">

        {{ $slot }}

    </div>

</div>
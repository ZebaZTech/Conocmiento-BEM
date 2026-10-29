@props([
    'name',
    'show' => false,
    'maxWidth' => '2xl'
])

@php
$modalSize = match ($maxWidth) {
    'sm' => 'modal-sm',
    'lg' => 'modal-lg',
    'xl' => 'modal-xl',
    default => '',
};
@endphp

<div class="modal fade" id="{{ $name }}" tabindex="-1" aria-labelledby="{{ $name }}Label" aria-hidden="true">
    <div class="modal-dialog {{ $modalSize }} modal-dialog-centered">
        <div class="modal-content">
            {{ $slot }}
        </div>
    </div>
</div>

@if ($show)
    <script>
        window.addEventListener('load', function () {
            var element = document.getElementById(@js($name));

            if (element && window.bootstrap) {
                window.bootstrap.Modal.getOrCreateInstance(element).show();
            }
        });
    </script>
@endif

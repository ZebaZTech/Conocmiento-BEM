<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Ver testimonio') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $testimonial->name }}</p>
            <p><strong>Rol:</strong> {{ $testimonial->role }}</p>
            <p><strong>Texto:</strong> {{ $testimonial->text }}</p>
            <p><strong>Iniciales:</strong> {{ $testimonial->initials }}</p>
            <p><strong>Variante:</strong> {{ $testimonial->variant }}</p>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</x-app-layout>

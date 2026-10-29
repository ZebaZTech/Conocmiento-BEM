<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Plan') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $plan->name }}</p>
            <p><strong>Precio:</strong> ${{ number_format($plan->price, 2) }}</p>
            <p><strong>Destacado:</strong> {{ $plan->featured ? 'Sí' : 'No' }}</p>
            <p class="mb-1"><strong>Características:</strong></p>
            <ul class="mb-3">
                @foreach((array)$plan->features as $f)
                    <li>{{ $f }}</li>
                @endforeach
            </ul>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.plans.edit', $plan) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</x-app-layout>

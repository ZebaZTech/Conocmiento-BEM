<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Categoría') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $category->name }}</p>
            <p><strong>Color:</strong> {{ $category->color ?? '—' }}</p>

            <p class="mb-1"><strong>Tareas:</strong></p>
            <ul class="mb-3">
                @forelse($category->tasks as $task)
                    <li>{{ $task->title }}</li>
                @empty
                    <li class="text-secondary">Sin tareas.</li>
                @endforelse
            </ul>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-primary">Editar</a>
                <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>
</x-app-layout>

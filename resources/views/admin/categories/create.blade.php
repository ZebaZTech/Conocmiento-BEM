<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Crear categoría') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="color">Color</label>
                    <input type="text" id="color" name="color" class="form-control @error('color') is-invalid @enderror" value="{{ old('color') }}" placeholder="#0d6efd">
                    <x-input-error :messages="$errors->get('color')" />
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Guardar</button>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

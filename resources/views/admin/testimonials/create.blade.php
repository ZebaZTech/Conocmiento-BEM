<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Crear testimonio') }}
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

            <form action="{{ route('admin.testimonials.store') }}" method="POST">
                @csrf

                <div class="mb-3">
                    <label class="form-label" for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="role">Rol</label>
                    <input type="text" id="role" name="role" class="form-control @error('role') is-invalid @enderror" value="{{ old('role') }}" required>
                    <x-input-error :messages="$errors->get('role')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="text">Texto</label>
                    <textarea id="text" name="text" class="form-control @error('text') is-invalid @enderror" required>{{ old('text') }}</textarea>
                    <x-input-error :messages="$errors->get('text')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="initials">Iniciales (opcional)</label>
                    <input type="text" id="initials" name="initials" class="form-control @error('initials') is-invalid @enderror" value="{{ old('initials') }}">
                    <x-input-error :messages="$errors->get('initials')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="variant">Variante</label>
                    <select id="variant" name="variant" class="form-select @error('variant') is-invalid @enderror" required>
                        <option value="normal" {{ old('variant') == 'normal' ? 'selected' : '' }}>normal</option>
                        <option value="highlight" {{ old('variant') == 'highlight' ? 'selected' : '' }}>highlight</option>
                        <option value="compact" {{ old('variant') == 'compact' ? 'selected' : '' }}>compact</option>
                    </select>
                    <x-input-error :messages="$errors->get('variant')" />
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Guardar</button>
                    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Editar plan') }}
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

            <form action="{{ route('admin.plans.update', $plan) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="name">Nombre</label>
                    <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $plan->name) }}" required>
                    <x-input-error :messages="$errors->get('name')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="price">Precio</label>
                    <input type="number" step="0.01" id="price" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $plan->price) }}" required>
                    <x-input-error :messages="$errors->get('price')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="period">Periodo</label>
                    <input type="text" id="period" name="period" class="form-control @error('period') is-invalid @enderror" value="{{ old('period', $plan->period) }}" required>
                    <x-input-error :messages="$errors->get('period')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="description">Descripción</label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror">{{ old('description', $plan->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="features_text">Características incluidas (una por línea)</label>
                    <textarea id="features_text" name="features_text" class="form-control @error('features') is-invalid @enderror" rows="6">{{ old('features_text', implode("\n", is_array($plan->features) ? $plan->features : [])) }}</textarea>
                    <x-input-error :messages="$errors->get('features')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="excluded_features_text">No incluidas (una por línea)</label>
                    <textarea id="excluded_features_text" name="excluded_features_text" class="form-control @error('excluded_features') is-invalid @enderror" rows="4">{{ old('excluded_features_text', implode("\n", is_array($plan->excluded_features) ? $plan->excluded_features : [])) }}</textarea>
                    <x-input-error :messages="$errors->get('excluded_features')" />
                </div>

                <div class="form-check mb-3">
                    <input type="checkbox" id="featured" name="featured" value="1" class="form-check-input" {{ old('featured', $plan->featured) ? 'checked' : '' }}>
                    <label class="form-check-label" for="featured">Destacado</label>
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('admin.plans.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

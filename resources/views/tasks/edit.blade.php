<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Editar tarea') }}
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

            <form action="{{ route('tasks.update', $task) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label" for="title">Título</label>
                    <input type="text" id="title" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $task->title) }}" required>
                    <x-input-error :messages="$errors->get('title')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="category_id">Categoría</label>
                    <select id="category_id" name="category_id" class="form-select @error('category_id') is-invalid @enderror">
                        <option value="">Sin categoría</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected((string) old('category_id', $task->category_id) === (string) $category->id)>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="notes">Notas</label>
                    <textarea id="notes" name="notes" rows="4" class="form-control @error('notes') is-invalid @enderror">{{ old('notes', $task->notes) }}</textarea>
                    <x-input-error :messages="$errors->get('notes')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="status">Estado</label>
                    <select id="status" name="status" class="form-select @error('status') is-invalid @enderror" required>
                        <option value="pendiente" @selected(old('status', $task->status) === 'pendiente')>Pendiente</option>
                        <option value="en_progreso" @selected(old('status', $task->status) === 'en_progreso')>En progreso</option>
                        <option value="hecha" @selected(old('status', $task->status) === 'hecha')>Hecha</option>
                    </select>
                    <x-input-error :messages="$errors->get('status')" />
                </div>

                <div class="mb-3">
                    <label class="form-label" for="estimated_cycles">Ciclos estimados</label>
                    <input type="number" id="estimated_cycles" name="estimated_cycles" min="1" max="20" class="form-control @error('estimated_cycles') is-invalid @enderror" value="{{ old('estimated_cycles', $task->estimated_cycles) }}" required>
                    <x-input-error :messages="$errors->get('estimated_cycles')" />
                </div>

                <div class="d-flex gap-2">
                    <button class="btn btn-primary">Actualizar</button>
                    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancelar</a>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar testimonio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if ($errors->any())
                        <div class="mb-4 text-red-600">
                            <ul class="list-disc ml-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="mb-4">
                            <label class="block">Nombre</label>
                            <input type="text" name="name" class="w-full border" value="{{ old('name', $testimonial->name) }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block">Rol</label>
                            <input type="text" name="role" class="w-full border" value="{{ old('role', $testimonial->role) }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block">Texto</label>
                            <textarea name="text" class="w-full border" required>{{ old('text', $testimonial->text) }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block">Iniciales (opcional)</label>
                            <input type="text" name="initials" class="w-full border" value="{{ old('initials', $testimonial->initials) }}">
                        </div>
                        <div class="mb-4">
                            <label class="block">Variante</label>
                            <select name="variant" class="w-full border" required>
                                <option value="normal" {{ old('variant', $testimonial->variant) == 'normal' ? 'selected' : '' }}>normal</option>
                                <option value="highlight" {{ old('variant', $testimonial->variant) == 'highlight' ? 'selected' : '' }}>highlight</option>
                                <option value="compact" {{ old('variant', $testimonial->variant) == 'compact' ? 'selected' : '' }}>compact</option>
                            </select>
                        </div>
                        <button class="px-4 py-2 bg-gray-800 text-white rounded">Actualizar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

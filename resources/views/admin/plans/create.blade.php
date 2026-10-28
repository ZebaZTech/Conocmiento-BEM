<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Crear plan') }}
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
                    <form action="{{ route('admin.plans.store') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <label class="block">Nombre</label>
                            <input type="text" name="name" class="w-full border" value="{{ old('name') }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block">Precio</label>
                            <input type="number" step="0.01" name="price" class="w-full border" value="{{ old('price') }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block">Periodo</label>
                            <input type="text" name="period" class="w-full border" value="{{ old('period', 'mes') }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block">Descripción</label>
                            <textarea name="description" class="w-full border">{{ old('description') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block">Características incluidas (una por línea)</label>
                            <textarea name="features_text" class="w-full border" rows="6">{{ old('features_text') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block">No incluidas (una por línea)</label>
                            <textarea name="excluded_features_text" class="w-full border" rows="4">{{ old('excluded_features_text') }}</textarea>
                        </div>
                        <div class="mb-4">
                            <label><input type="checkbox" name="featured" value="1" {{ old('featured') ? 'checked' : '' }}> Destacado</label>
                        </div>
                        <button class="px-4 py-2 bg-gray-800 text-white rounded">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

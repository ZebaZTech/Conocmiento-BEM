<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver testimonio') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p><strong>Nombre:</strong> {{ $testimonial->name }}</p>
                    <p><strong>Rol:</strong> {{ $testimonial->role }}</p>
                    <p><strong>Texto:</strong> {{ $testimonial->text }}</p>
                    <p><strong>Iniciales:</strong> {{ $testimonial->initials }}</p>
                    <p><strong>Variante:</strong> {{ $testimonial->variant }}</p>
                    <div class="mt-4">
                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-yellow-600">Editar</a>
                        <a href="{{ route('admin.testimonials.index') }}" class="text-blue-600 ml-2">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Plan') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p><strong>Nombre:</strong> {{ $plan->name }}</p>
                    <p><strong>Precio:</strong> ${{ number_format($plan->price, 2) }}</p>
                    <p><strong>Destacado:</strong> {{ $plan->featured ? 'Sí' : 'No' }}</p>
                    <p><strong>Características:</strong></p>
                    <ul class="list-disc ml-6">
                        @foreach((array)$plan->features as $f)
                            <li>{{ $f }}</li>
                        @endforeach
                    </ul>
                    <div class="mt-4">
                        <a href="{{ route('admin.plans.edit', $plan) }}" class="text-yellow-600">Editar</a>
                        <a href="{{ route('admin.plans.index') }}" class="text-blue-600 ml-2">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

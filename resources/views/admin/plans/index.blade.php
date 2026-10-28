<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Planes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="mb-4">
                        <a href="{{ route('admin.plans.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded">Crear plan</a>
                    </div>
                    @if(session('status'))
                        <div class="mb-4 text-green-600">{{ session('status') }}</div>
                    @endif
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Precio</th>
                                <th class="text-left">Destacado</th>
                                <th class="text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($plans as $plan)
                                <tr>
                                    <td class="py-2">{{ $plan->name }}</td>
                                    <td class="py-2">${{ number_format($plan->price, 2) }}</td>
                                    <td class="py-2">{{ $plan->featured ? 'Sí' : 'No' }}</td>
                                    <td class="py-2 flex gap-2">
                                        <a href="{{ route('admin.plans.show', $plan) }}" class="text-blue-600">Ver</a>
                                        <a href="{{ route('admin.plans.edit', $plan) }}" class="text-yellow-600">Editar</a>
                                        <form action="{{ route('admin.plans.destroy', $plan) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Testimonios') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                        <div class="mb-4 text-green-600">{{ session('status') }}</div>
                    @endif
                    <div class="mb-4">
                        <a href="{{ route('admin.testimonials.create') }}" class="px-4 py-2 bg-gray-800 text-white rounded">Crear testimonio</a>
                    </div>
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Rol</th>
                                <th class="text-left">Variante</th>
                                <th class="text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($testimonials as $testimonial)
                                <tr>
                                    <td class="py-2">{{ $testimonial->name }}</td>
                                    <td class="py-2">{{ $testimonial->role }}</td>
                                    <td class="py-2">{{ $testimonial->variant }}</td>
                                    <td class="py-2 flex gap-2">
                                        <a href="{{ route('admin.testimonials.show', $testimonial) }}" class="text-blue-600">Ver</a>
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}" class="text-yellow-600">Editar</a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}" method="POST">
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

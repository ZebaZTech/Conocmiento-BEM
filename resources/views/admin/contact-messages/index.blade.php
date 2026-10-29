<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Mensajes') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if(session('status'))
                        <div class="mb-4 text-green-600">{{ session('status') }}</div>
                    @endif
                    <table class="min-w-full">
                        <thead>
                            <tr>
                                <th class="text-left">Nombre</th>
                                <th class="text-left">Correo</th>
                                <th class="text-left">Mensaje</th>
                                <th class="text-left">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($contactMessages as $contactMessage)
                                <tr>
                                    <td class="py-2">{{ $contactMessage->name }}</td>
                                    <td class="py-2">{{ $contactMessage->email }}</td>
                                    <td class="py-2">{{ \Illuminate\Support\Str::limit($contactMessage->message, 60) }}</td>
                                    <td class="py-2 flex gap-2">
                                        <a href="{{ route('admin.contact-messages.show', $contactMessage) }}" class="text-blue-600">Ver</a>
                                        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-600">Borrar</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-gray-500">No hay mensajes.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

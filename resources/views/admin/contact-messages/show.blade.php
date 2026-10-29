<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Ver mensaje') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <p><strong>Nombre:</strong> {{ $contactMessage->name }}</p>
                    <p><strong>Correo:</strong> {{ $contactMessage->email }}</p>
                    <p><strong>Mensaje:</strong></p>
                    <p class="whitespace-pre-line">{{ $contactMessage->message }}</p>
                    <div class="mt-4 flex items-center gap-4">
                        <a href="{{ route('admin.contact-messages.index') }}" class="text-blue-600">Volver</a>
                        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600">Borrar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

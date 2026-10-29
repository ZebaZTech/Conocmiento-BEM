<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Ver mensaje') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            <p><strong>Nombre:</strong> {{ $contactMessage->name }}</p>
            <p><strong>Correo:</strong> {{ $contactMessage->email }}</p>
            <p class="mb-1"><strong>Mensaje:</strong></p>
            <p style="white-space: pre-line;">{{ $contactMessage->message }}</p>
            <div class="d-flex align-items-center gap-2">
                <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Volver</a>
                <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Borrar</button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>

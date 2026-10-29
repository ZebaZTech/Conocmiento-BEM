<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Mensajes') }}
        </h2>
    </x-slot>

    <div class="card">
        <div class="card-body">
            @if(session('status'))
                <div class="alert alert-success" role="status">{{ session('status') }}</div>
            @endif

            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Correo</th>
                            <th>Mensaje</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contactMessages as $contactMessage)
                            <tr>
                                <td>{{ $contactMessage->name }}</td>
                                <td>{{ $contactMessage->email }}</td>
                                <td>{{ \Illuminate\Support\Str::limit($contactMessage->message, 60) }}</td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('admin.contact-messages.show', $contactMessage) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <form action="{{ route('admin.contact-messages.destroy', $contactMessage) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="text-center text-secondary py-4">No hay mensajes.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

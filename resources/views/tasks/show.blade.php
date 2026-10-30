<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Detalle de la tarea') }}
        </h2>
    </x-slot>

    @php
        $statusLabels = [
            'pendiente' => 'Pendiente',
            'en_progreso' => 'En progreso',
            'hecha' => 'Hecha',
        ];
        $statusClasses = [
            'pendiente' => 'bg-secondary',
            'en_progreso' => 'bg-warning text-dark',
            'hecha' => 'bg-success',
        ];
        $completedCycles = (int) $task->completed_cycles_count;
        $progress = $task->estimated_cycles > 0
            ? min(100, round($completedCycles / $task->estimated_cycles * 100))
            : 0;
    @endphp

    <div class="card mb-4">
        <div class="card-body">
            <p><strong>Título:</strong> {{ $task->title }}</p>
            <p>
                <strong>Categoría:</strong>
                @if ($task->category)
                    <span class="badge" style="background-color: {{ $task->category->color ?? '#6c757d' }};">{{ $task->category->name }}</span>
                @else
                    <span class="badge bg-light text-secondary">Sin categoría</span>
                @endif
            </p>
            <p><strong>Estado:</strong> <span class="badge {{ $statusClasses[$task->status] ?? 'bg-secondary' }}">{{ $statusLabels[$task->status] ?? $task->status }}</span></p>
            <p><strong>Notas:</strong> {{ $task->notes ?: 'Sin notas' }}</p>

            <div class="mb-3" style="max-width: 360px;">
                <div class="d-flex justify-content-between mb-1">
                    <span>Ciclos completados</span>
                    <span>{{ $completedCycles }}/{{ $task->estimated_cycles }}</span>
                </div>
                <div class="progress" style="height: 10px;">
                    <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
            </div>

            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-primary">Editar</a>
                @if ($task->status !== 'hecha')
                    <form action="{{ route('tasks.complete', $task) }}" method="POST" class="d-inline">
                        @csrf
                        @method('PATCH')
                        <button type="submit" class="btn btn-success">Marcar como hecha</button>
                    </form>
                @endif
                <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Volver</a>
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <h3 class="h5 mb-3">Últimas sesiones de esta tarea</h3>
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Fecha</th>
                            <th>Minutos</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($sessions as $session)
                            <tr>
                                <td>{{ $session->started_at->format('d/m/Y H:i') }}</td>
                                <td>{{ $session->minutes }}</td>
                                <td>
                                    @if ($session->completed)
                                        <span class="badge bg-success">Completada</span>
                                    @else
                                        <span class="badge bg-secondary">Incompleta</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="text-center text-secondary py-4">Sin sesiones registradas.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

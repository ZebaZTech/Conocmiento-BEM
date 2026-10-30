<x-app-layout>
    <x-slot name="header">
        <div class="d-flex justify-content-between align-items-center">
            <h2 class="fw-semibold fs-4 mb-0">
                {{ __('Mis tareas') }}
            </h2>
            <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nueva tarea</a>
        </div>
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
    @endphp

    <ul class="nav nav-pills mb-3">
        <li class="nav-item">
            <a class="nav-link {{ $activeStatus === null ? 'active' : '' }}" href="{{ route('tasks.index') }}">Todas</a>
        </li>
        @foreach ($statusLabels as $status => $label)
            <li class="nav-item">
                <a class="nav-link {{ $activeStatus === $status ? 'active' : '' }}" href="{{ route('tasks.index', ['status' => $status]) }}">{{ $label }}</a>
            </li>
        @endforeach
    </ul>

    @if (session('status'))
        <div class="alert alert-success" role="status">{{ session('status') }}</div>
    @endif

    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-striped align-middle mb-0">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Estado</th>
                            <th>Ciclos</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            @php
                                $completedCycles = (int) $task->completed_cycles_count;
                                $progress = $task->estimated_cycles > 0
                                    ? min(100, round($completedCycles / $task->estimated_cycles * 100))
                                    : 0;
                            @endphp
                            <tr>
                                <td>{{ $task->title }}</td>
                                <td>
                                    @if ($task->category)
                                        <span class="badge" style="background-color: {{ $task->category->color ?? '#6c757d' }};">{{ $task->category->name }}</span>
                                    @else
                                        <span class="badge bg-light text-secondary">Sin categoría</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge {{ $statusClasses[$task->status] ?? 'bg-secondary' }}">{{ $statusLabels[$task->status] ?? $task->status }}</span>
                                </td>
                                <td style="min-width: 140px;">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="progress flex-grow-1" style="height: 8px;">
                                            <div class="progress-bar" role="progressbar" style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100"></div>
                                        </div>
                                        <small class="text-secondary">{{ $completedCycles }}/{{ $task->estimated_cycles }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="d-flex flex-wrap gap-2">
                                        <a href="{{ route('tasks.show', $task) }}" class="btn btn-sm btn-outline-primary">Ver</a>
                                        <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-secondary">Editar</a>
                                        @if ($task->status !== 'hecha')
                                            <form action="{{ route('tasks.complete', $task) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="btn btn-sm btn-outline-success">Completar</button>
                                            </form>
                                        @endif
                                        <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger">Borrar</button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center text-secondary py-4">No hay tareas para este filtro.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>

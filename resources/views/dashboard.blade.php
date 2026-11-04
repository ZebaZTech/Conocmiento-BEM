<x-app-layout>
    <x-slot name="header">
        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2">
            <h2 class="fw-semibold fs-4 mb-0">
                {{ __('Dashboard') }}
            </h2>
            <div class="d-flex flex-wrap gap-2">
                <a href="{{ route('tasks.create') }}" class="btn btn-primary">Nueva tarea</a>
                <a href="{{ route('focus.index') }}" class="btn btn-outline-primary">Iniciar enfoque</a>
            </div>
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
            'en_progreso' => 'text-bg-warning',
            'hecha' => 'bg-success',
        ];
    @endphp

    <div class="row row-cols-1 row-cols-sm-2 row-cols-xl-4 g-3 mb-4">
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex align-items-start gap-3">
                    <span class="kpi-icon"><x-icon name="timer" size="22" /></span>
                    <div>
                        <p class="text-secondary mb-1">Sesiones completadas hoy</p>
                        <p class="display-6 fw-semibold mb-0 kpi-value">{{ $completedSessionsToday }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex align-items-start gap-3">
                    <span class="kpi-icon"><x-icon name="clock" size="22" /></span>
                    <div>
                        <p class="text-secondary mb-1">Minutos de enfoque esta semana</p>
                        <p class="display-6 fw-semibold mb-0 kpi-value">{{ $minutesThisWeek }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex align-items-start gap-3">
                    <span class="kpi-icon"><x-icon name="list" size="22" /></span>
                    <div>
                        <p class="text-secondary mb-1">Tareas pendientes</p>
                        <p class="display-6 fw-semibold mb-0 kpi-value">{{ $taskStatusCounts['pendiente'] }}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card h-100">
                <div class="card-body d-flex align-items-start gap-3">
                    <span class="kpi-icon"><x-icon name="check" size="22" /></span>
                    <div>
                        <p class="text-secondary mb-1">Tareas hechas</p>
                        <p class="display-6 fw-semibold mb-0 kpi-value">{{ $taskStatusCounts['hecha'] }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4 mb-4">
        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5 mb-3 d-flex align-items-center gap-2"><x-icon name="chart" size="20" /> Tareas por estado</h3>
                    @foreach ($statusLabels as $status => $label)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>
                                    <span class="badge {{ $statusClasses[$status] }}">{{ $label }}</span>
                                </span>
                                <span>{{ $taskStatusCounts[$status] }} de {{ $totalTasks }}</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar {{ $statusClasses[$status] }}" role="progressbar" style="width: {{ $taskStatusPercentages[$status] }}%;" aria-valuenow="{{ $taskStatusPercentages[$status] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5 mb-3 d-flex align-items-center gap-2"><x-icon name="clock" size="20" /> Minutos de enfoque de los últimos 7 días</h3>
                    @foreach ($dailyFocus as $day)
                        <div class="mb-3">
                            <div class="d-flex justify-content-between mb-1">
                                <span>{{ $day['label'] }}</span>
                                <span>{{ $day['minutes'] }} min</span>
                            </div>
                            <div class="progress" style="height: 10px;">
                                <div class="progress-bar bg-primary" role="progressbar" style="width: {{ $day['percent'] }}%;" aria-valuenow="{{ $day['percent'] }}" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5 mb-3 d-flex align-items-center gap-2"><x-icon name="tag" size="20" /> Minutos por categoría</h3>
                    @forelse ($minutesByCategory as $category)
                        <div class="d-flex justify-content-between align-items-center border-bottom py-2">
                            <span>
                                <span class="badge me-2" style="background-color: {{ $category->color ?? '#6c757d' }};">&nbsp;</span>
                                {{ $category->name }}
                            </span>
                            <strong>{{ (int) $category->minutes }} min</strong>
                        </div>
                    @empty
                        <p class="text-secondary mb-0 d-flex align-items-center gap-2"><x-icon name="tag" size="20" /> Sin sesiones completadas.</p>
                    @endforelse
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5 mb-3 d-flex align-items-center gap-2"><x-icon name="calendar" size="20" /> Últimas 5 sesiones</h3>
                    <div class="table-responsive">
                        <table class="table table-striped align-middle mb-0">
                            <thead>
                                <tr>
                                    <th>Fecha</th>
                                    <th>Tarea</th>
                                    <th>Min.</th>
                                    <th>Estado</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($recentSessions as $session)
                                    <tr>
                                        <td>{{ $session->started_at->format('d/m/Y H:i') }}</td>
                                        <td>{{ $session->task?->title ?? 'Sin tarea' }}</td>
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
                                        <td colspan="4" class="text-center text-secondary py-4">
                                            <span class="d-inline-flex align-items-center gap-2"><x-icon name="calendar" size="20" /> Sin sesiones registradas.</span>
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

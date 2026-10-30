<x-app-layout>
    <x-slot name="header">
        <h2 class="fw-semibold fs-4 mb-0">
            {{ __('Enfoque') }}
        </h2>
    </x-slot>

    @if (session('status'))
        <div class="alert alert-success" role="status">{{ session('status') }}</div>
    @endif

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card h-100">
                <div class="card-body text-center">
                    <h3 class="h5 mb-4">Temporizador de enfoque</h3>

                    <div id="timer" class="display-1 fw-bold mb-4">25:00</div>

                    <div class="row g-3 text-start mb-4">
                        <div class="col-md-6">
                            <label class="form-label" for="task_id">Tarea (opcional)</label>
                            <select id="task_id" name="task_id" class="form-select">
                                <option value="">Sin tarea</option>
                                @foreach ($tasks as $task)
                                    <option value="{{ $task->id }}">{{ $task->title }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label" for="duration">Duración</label>
                            <select id="duration" name="duration" class="form-select">
                                <option value="15">15 minutos</option>
                                <option value="25" selected>25 minutos</option>
                                <option value="50">50 minutos</option>
                            </select>
                        </div>
                    </div>

                    <div class="d-flex justify-content-center flex-wrap gap-2">
                        <button id="start-button" type="button" class="btn btn-primary">Iniciar</button>
                        <button id="pause-button" type="button" class="btn btn-warning" disabled>Pausar</button>
                        <button id="stop-button" type="button" class="btn btn-danger" disabled>Detener</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card h-100">
                <div class="card-body">
                    <h3 class="h5 mb-3">Últimas 10 sesiones</h3>
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
                                @forelse ($sessions as $session)
                                    <tr>
                                        <td>{{ $session->started_at->format('d/m H:i') }}</td>
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
                                        <td colspan="4" class="text-center text-secondary py-4">Aún no hay sesiones.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const timerElement = document.getElementById('timer');
            const taskSelect = document.getElementById('task_id');
            const durationSelect = document.getElementById('duration');
            const startButton = document.getElementById('start-button');
            const pauseButton = document.getElementById('pause-button');
            const stopButton = document.getElementById('stop-button');
            const storeUrl = @json(route('focus-sessions.store'));
            const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

            let totalSeconds = parseInt(durationSelect.value, 10) * 60;
            let remainingSeconds = totalSeconds;
            let intervalId = null;
            let isRunning = false;
            let hasStarted = false;

            function renderTimer() {
                const minutes = Math.floor(remainingSeconds / 60).toString().padStart(2, '0');
                const seconds = (remainingSeconds % 60).toString().padStart(2, '0');
                timerElement.textContent = minutes + ':' + seconds;
            }

            function updateButtons() {
                startButton.disabled = isRunning;
                pauseButton.disabled = !isRunning;
                stopButton.disabled = !hasStarted;
                durationSelect.disabled = hasStarted;
                taskSelect.disabled = hasStarted;
            }

            function stopInterval() {
                if (intervalId !== null) {
                    clearInterval(intervalId);
                    intervalId = null;
                }
            }

            function resetTimer() {
                stopInterval();
                isRunning = false;
                hasStarted = false;
                totalSeconds = parseInt(durationSelect.value, 10) * 60;
                remainingSeconds = totalSeconds;
                renderTimer();
                updateButtons();
            }

            async function saveSession(completed, minutes) {
                const response = await fetch(storeUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json',
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: JSON.stringify({
                        task_id: taskSelect.value ? Number(taskSelect.value) : null,
                        minutes: minutes,
                        completed: completed,
                    }),
                });

                if (!response.ok) {
                    let message = 'No se pudo guardar la sesión de enfoque.';
                    try {
                        const data = await response.json();
                        if (data.message) {
                            message = data.message;
                        }
                    } catch (error) {
                        message = message || 'No se pudo guardar la sesión de enfoque.';
                    }
                    throw new Error(message);
                }

                return response.json();
            }

            async function finishSession(completed, minutes, message) {
                stopInterval();
                isRunning = false;
                hasStarted = false;
                updateButtons();

                try {
                    await saveSession(completed, minutes);
                    window.alert(message);
                    window.location.reload();
                } catch (error) {
                    window.alert(error.message);
                    resetTimer();
                }
            }

            startButton.addEventListener('click', function () {
                if (isRunning) {
                    return;
                }

                if (!hasStarted) {
                    totalSeconds = parseInt(durationSelect.value, 10) * 60;
                    remainingSeconds = totalSeconds;
                    hasStarted = true;
                }

                isRunning = true;
                updateButtons();

                intervalId = setInterval(function () {
                    remainingSeconds--;

                    if (remainingSeconds <= 0) {
                        remainingSeconds = 0;
                        renderTimer();
                        finishSession(true, Math.round(totalSeconds / 60), '¡Sesión completada!');
                        return;
                    }

                    renderTimer();
                }, 1000);
            });

            pauseButton.addEventListener('click', function () {
                stopInterval();
                isRunning = false;
                updateButtons();
            });

            stopButton.addEventListener('click', function () {
                const elapsedSeconds = totalSeconds - remainingSeconds;
                const minutes = Math.max(1, Math.ceil(elapsedSeconds / 60));

                finishSession(false, minutes, 'Sesión guardada como incompleta.');
            });

            durationSelect.addEventListener('change', function () {
                if (!hasStarted) {
                    totalSeconds = parseInt(durationSelect.value, 10) * 60;
                    remainingSeconds = totalSeconds;
                    renderTimer();
                }
            });

            renderTimer();
            updateButtons();
        });
    </script>
</x-app-layout>

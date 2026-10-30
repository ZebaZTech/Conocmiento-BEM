<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\View\View;

class TaskController extends Controller
{
    public function index(Request $request): View
    {
        $allowedStatuses = ['pendiente', 'en_progreso', 'hecha'];
        $activeStatus = in_array($request->query('status'), $allowedStatuses, true)
            ? $request->query('status')
            : null;

        $tasks = $request->user()
            ->tasks()
            ->with('category')
            ->withCount([
                'focusSessions as completed_cycles_count' => fn ($query) => $query->where('completed', true),
            ])
            ->when($activeStatus, fn ($query) => $query->where('status', $activeStatus))
            ->latest()
            ->get();

        return view('tasks.index', compact('tasks', 'activeStatus'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();

        return view('tasks.create', compact('categories'));
    }

    public function store(StoreTaskRequest $request): RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;

        Task::create($data);

        return redirect()->route('tasks.index')->with('status', 'Tarea creada');
    }

    public function show(Task $task): View
    {
        Gate::authorize('view', $task);

        $task->load('category')->loadCount([
            'focusSessions as completed_cycles_count' => fn ($query) => $query->where('completed', true),
        ]);
        $sessions = $task->focusSessions()->latest('started_at')->take(10)->get();

        return view('tasks.show', compact('task', 'sessions'));
    }

    public function edit(Task $task): View
    {
        Gate::authorize('update', $task);

        $categories = Category::orderBy('name')->get();

        return view('tasks.edit', compact('task', 'categories'));
    }

    public function update(UpdateTaskRequest $request, Task $task): RedirectResponse
    {
        Gate::authorize('update', $task);

        $task->update($request->validated());

        return redirect()->route('tasks.index')->with('status', 'Tarea actualizada');
    }

    public function destroy(Task $task): RedirectResponse
    {
        Gate::authorize('delete', $task);

        $task->delete();

        return redirect()->route('tasks.index')->with('status', 'Tarea eliminada');
    }

    public function complete(Task $task): RedirectResponse
    {
        Gate::authorize('update', $task);

        $task->update(['status' => 'hecha']);

        return redirect()->route('tasks.index')->with('status', 'Tarea marcada como hecha');
    }
}

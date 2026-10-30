<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreFocusSessionRequest;
use App\Models\FocusSession;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FocusSessionController extends Controller
{
    public function index(Request $request): View
    {
        $tasks = $request->user()
            ->tasks()
            ->where('status', '!=', 'hecha')
            ->orderBy('title')
            ->get();

        $sessions = $request->user()
            ->focusSessions()
            ->with('task')
            ->latest('started_at')
            ->take(10)
            ->get();

        return view('focus.index', compact('tasks', 'sessions'));
    }

    public function store(StoreFocusSessionRequest $request): JsonResponse|RedirectResponse
    {
        $data = $request->validated();
        $data['user_id'] = $request->user()->id;
        $data['minutes'] = (int) $data['minutes'];
        $data['completed'] = $request->boolean('completed');
        $data['started_at'] = now();

        $session = FocusSession::create($data);

        if ($session->completed && $session->task && $session->task->status === 'pendiente') {
            $session->task->update(['status' => 'en_progreso']);
        }

        if ($request->expectsJson()) {
            return response()->json([
                'message' => 'Sesión de enfoque guardada',
                'session' => $session->load('task'),
            ], 201);
        }

        return redirect()->route('focus.index')->with('status', 'Sesión de enfoque guardada');
    }
}

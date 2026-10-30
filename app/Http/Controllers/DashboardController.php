<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function __invoke(Request $request): View
    {
        $user = $request->user();

        $taskCounts = $user->tasks()
            ->selectRaw('status, COUNT(*) as total')
            ->groupBy('status')
            ->pluck('total', 'status');

        $statuses = ['pendiente', 'en_progreso', 'hecha'];
        $taskStatusCounts = collect($statuses)
            ->mapWithKeys(fn (string $status) => [$status => (int) ($taskCounts[$status] ?? 0)]);
        $totalTasks = $taskStatusCounts->sum();

        $taskStatusPercentages = $taskStatusCounts->map(
            fn (int $count) => $totalTasks > 0 ? round($count / $totalTasks * 100, 1) : 0
        );

        $completedSessionsToday = $user->focusSessions()
            ->where('completed', true)
            ->whereDate('started_at', now()->toDateString())
            ->count();

        $minutesThisWeek = (int) $user->focusSessions()
            ->where('completed', true)
            ->where('started_at', '>=', now()->startOfWeek())
            ->sum('minutes');

        $dailyTotals = $user->focusSessions()
            ->where('completed', true)
            ->where('started_at', '>=', now()->subDays(6)->startOfDay())
            ->selectRaw('DATE(started_at) as day, SUM(minutes) as minutes')
            ->groupBy('day')
            ->pluck('minutes', 'day');

        $dailyFocus = collect(range(6, 0))->map(function (int $daysAgo) use ($dailyTotals) {
            $date = now()->subDays($daysAgo);

            return [
                'label' => $date->format('d/m'),
                'minutes' => (int) ($dailyTotals[$date->toDateString()] ?? 0),
            ];
        });

        $maxDailyMinutes = max(1, $dailyFocus->max('minutes'));
        $dailyFocus = $dailyFocus->map(fn (array $day) => [
            ...$day,
            'percent' => round($day['minutes'] / $maxDailyMinutes * 100, 1),
        ]);

        $minutesByCategory = $user->focusSessions()
            ->leftJoin('tasks', 'tasks.id', '=', 'focus_sessions.task_id')
            ->leftJoin('categories', 'categories.id', '=', 'tasks.category_id')
            ->where('focus_sessions.completed', true)
            ->selectRaw("COALESCE(categories.name, 'Sin categoría') as name, categories.color as color, SUM(focus_sessions.minutes) as minutes")
            ->groupBy('categories.id', 'categories.name', 'categories.color')
            ->orderByDesc('minutes')
            ->get();

        $recentSessions = $user->focusSessions()
            ->with('task')
            ->latest('started_at')
            ->take(5)
            ->get();

        return view('dashboard', compact(
            'completedSessionsToday',
            'minutesThisWeek',
            'taskStatusCounts',
            'taskStatusPercentages',
            'totalTasks',
            'dailyFocus',
            'minutesByCategory',
            'recentSessions',
        ));
    }
}

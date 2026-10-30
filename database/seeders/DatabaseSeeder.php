<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FocusSession;
use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        $this->call([
            PlanSeeder::class,
            TestimonialSeeder::class,
        ]);

        $freePlan = Plan::where('name', 'Gratis')->first();
        $proPlan = Plan::where('name', 'Pro')->first();

        User::updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test User',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'plan_id' => $freePlan?->id,
                'is_admin' => true,
            ]
        );

        $demo = User::updateOrCreate(
            ['email' => 'demo@example.com'],
            [
                'name' => 'Demo User',
                'email_verified_at' => now(),
                'password' => bcrypt('password'),
                'plan_id' => $proPlan?->id,
                'is_admin' => false,
            ]
        );

        $categories = [
            'Estudio' => Category::updateOrCreate(
                ['name' => 'Estudio'],
                ['color' => '#0d6efd']
            ),
            'Trabajo' => Category::updateOrCreate(
                ['name' => 'Trabajo'],
                ['color' => '#198754']
            ),
            'Personal' => Category::updateOrCreate(
                ['name' => 'Personal'],
                ['color' => '#fd7e14']
            ),
        ];

        $tasks = [
            [
                'title' => 'Preparar examen de matemáticas',
                'category' => 'Estudio',
                'notes' => 'Repasar los capítulos 1 y 2.',
                'status' => 'pendiente',
                'estimated_cycles' => 3,
            ],
            [
                'title' => 'Terminar informe del proyecto',
                'category' => 'Trabajo',
                'notes' => 'Incluir resultados y conclusiones.',
                'status' => 'en_progreso',
                'estimated_cycles' => 4,
            ],
            [
                'title' => 'Organizar el escritorio',
                'category' => 'Personal',
                'notes' => null,
                'status' => 'hecha',
                'estimated_cycles' => 1,
            ],
            [
                'title' => 'Leer un capítulo del libro',
                'category' => 'Estudio',
                'notes' => 'Capítulo sobre hábitos de estudio.',
                'status' => 'pendiente',
                'estimated_cycles' => 2,
            ],
            [
                'title' => 'Planificar la semana',
                'category' => 'Trabajo',
                'notes' => null,
                'status' => 'hecha',
                'estimated_cycles' => 1,
            ],
        ];

        foreach ($tasks as $data) {
            Task::updateOrCreate(
                [
                    'user_id' => $demo->id,
                    'title' => $data['title'],
                ],
                [
                    'category_id' => $categories[$data['category']]->id,
                    'notes' => $data['notes'],
                    'status' => $data['status'],
                    'estimated_cycles' => $data['estimated_cycles'],
                ]
            );
        }

        FocusSession::where('user_id', $demo->id)->delete();

        $demoTasks = Task::where('user_id', $demo->id)->orderBy('id')->get()->values();

        $sessionPlan = [
            ['days_ago' => 6, 'task' => 0, 'minutes' => 25, 'completed' => true],
            ['days_ago' => 5, 'task' => 1, 'minutes' => 50, 'completed' => true],
            ['days_ago' => 4, 'task' => 2, 'minutes' => 25, 'completed' => true],
            ['days_ago' => 3, 'task' => 3, 'minutes' => 25, 'completed' => false],
            ['days_ago' => 2, 'task' => 4, 'minutes' => 15, 'completed' => true],
            ['days_ago' => 1, 'task' => 0, 'minutes' => 50, 'completed' => true],
            ['days_ago' => 0, 'task' => 1, 'minutes' => 25, 'completed' => true],
            ['days_ago' => 0, 'task' => 2, 'minutes' => 15, 'completed' => true],
            ['days_ago' => 2, 'task' => 3, 'minutes' => 25, 'completed' => true],
            ['days_ago' => 1, 'task' => 4, 'minutes' => 25, 'completed' => false],
        ];

        foreach ($sessionPlan as $index => $session) {
            $task = $demoTasks[$session['task'] % $demoTasks->count()];

            FocusSession::create([
                'user_id' => $demo->id,
                'task_id' => $task->id,
                'minutes' => $session['minutes'],
                'completed' => $session['completed'],
                'started_at' => now()->subDays($session['days_ago'])->setTime(8 + ($index % 8), 0),
            ]);
        }
    }
}

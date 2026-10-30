<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\FocusSession;
use App\Models\Plan;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
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

        $sessionStart = Carbon::parse('2026-10-20 08:00:00');

        Task::where('user_id', $demo->id)
            ->orderBy('id')
            ->get()
            ->each(function (Task $task, int $index) use ($demo, $sessionStart) {
                foreach ([0, 1] as $offset) {
                    FocusSession::updateOrCreate(
                        [
                            'user_id' => $demo->id,
                            'task_id' => $task->id,
                            'started_at' => $sessionStart->copy()->addDays($index)->addHours($offset * 2),
                        ],
                        [
                            'minutes' => 25,
                            'completed' => true,
                        ]
                    );
                }
            });
    }
}

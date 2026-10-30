<?php

namespace Database\Factories;

use App\Models\FocusSession;
use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FocusSession>
 */
class FocusSessionFactory extends Factory
{
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'task_id' => Task::factory(),
            'minutes' => 25,
            'completed' => true,
            'started_at' => now(),
        ];
    }
}

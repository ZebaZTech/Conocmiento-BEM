<?php

use App\Models\Category;
use App\Models\FocusSession;
use App\Models\Task;
use App\Models\User;

test('guests are redirected from the dashboard', function () {
    $this->get(route('dashboard'))->assertRedirect(route('login'));
});

test('dashboard shows the correct statistics for a user', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create(['name' => 'Estudio']);

    $pending = Task::factory()->for($user)->create([
        'category_id' => $category->id,
        'status' => 'pendiente',
    ]);
    $inProgress = Task::factory()->for($user)->create([
        'category_id' => $category->id,
        'status' => 'en_progreso',
    ]);
    $done = Task::factory()->for($user)->create([
        'category_id' => $category->id,
        'status' => 'hecha',
    ]);

    FocusSession::factory()->for($user)->for($pending)->create([
        'minutes' => 25,
        'completed' => true,
        'started_at' => now(),
    ]);
    FocusSession::factory()->for($user)->for($inProgress)->create([
        'minutes' => 15,
        'completed' => true,
        'started_at' => now(),
    ]);
    FocusSession::factory()->for($user)->for($done)->create([
        'minutes' => 50,
        'completed' => false,
        'started_at' => now(),
    ]);

    $response = $this->actingAs($user)->get(route('dashboard'));

    $response->assertOk();
    $response->assertSeeInOrder([
        'Sesiones completadas hoy',
        '2',
        'Minutos de enfoque esta semana',
        '40',
        'Tareas pendientes',
        '1',
        'Tareas hechas',
        '1',
    ]);
    $response->assertSee('1 de 3');
    $response->assertSee('40 min');
    $response->assertSee('Estudio');
    $response->assertSee('Últimas 5 sesiones');
});

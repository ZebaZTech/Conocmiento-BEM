<?php

use App\Models\Category;
use App\Models\Task;
use App\Models\User;

test('guests are redirected from tasks', function () {
    $this->get(route('tasks.index'))->assertRedirect(route('login'));
});

test('users only see their own tasks', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();

    Task::factory()->for($user)->create(['title' => 'Mi tarea privada']);
    Task::factory()->for($other)->create(['title' => 'Tarea de otra persona']);

    $response = $this->actingAs($user)->get(route('tasks.index'));

    $response->assertOk();
    $response->assertSee('Mi tarea privada');
    $response->assertDontSee('Tarea de otra persona');
});

test('users cannot edit or delete another user task', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();
    $task = Task::factory()->for($other)->create();

    $this->actingAs($user)->get(route('tasks.edit', $task))->assertForbidden();

    $this->actingAs($user)->put(route('tasks.update', $task), [
        'title' => 'Intento de cambio',
        'status' => 'pendiente',
        'estimated_cycles' => 1,
    ])->assertForbidden();

    $this->actingAs($user)->delete(route('tasks.destroy', $task))->assertForbidden();

    $this->assertDatabaseHas('tasks', ['id' => $task->id]);
});

test('users can create a task', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();

    $response = $this->actingAs($user)->post(route('tasks.store'), [
        'title' => 'Nueva tarea',
        'category_id' => $category->id,
        'notes' => 'Notas de la tarea',
        'status' => 'pendiente',
        'estimated_cycles' => 4,
    ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'user_id' => $user->id,
        'category_id' => $category->id,
        'title' => 'Nueva tarea',
        'estimated_cycles' => 4,
    ]);
});

test('users can update a task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create(['status' => 'pendiente']);

    $response = $this->actingAs($user)->put(route('tasks.update', $task), [
        'title' => 'Tarea actualizada',
        'notes' => 'Notas nuevas',
        'status' => 'en_progreso',
        'estimated_cycles' => 6,
    ]);

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'title' => 'Tarea actualizada',
        'status' => 'en_progreso',
        'estimated_cycles' => 6,
    ]);
});

test('users can complete a task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create(['status' => 'pendiente']);

    $response = $this->actingAs($user)->patch(route('tasks.complete', $task));

    $response->assertRedirect(route('tasks.index'));
    $this->assertDatabaseHas('tasks', [
        'id' => $task->id,
        'status' => 'hecha',
    ]);
});

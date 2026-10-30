<?php

use App\Models\Task;
use App\Models\User;

test('guests are redirected from focus', function () {
    $this->get(route('focus.index'))->assertRedirect(route('login'));
});

test('users can store a completed focus session and update a pending task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create(['status' => 'pendiente']);

    $response = $this->actingAs($user)->postJson(route('focus-sessions.store'), [
        'task_id' => $task->id,
        'minutes' => 25,
        'completed' => true,
    ]);

    $response->assertCreated();
    $this->assertDatabaseHas('focus_sessions', [
        'user_id' => $user->id,
        'task_id' => $task->id,
        'minutes' => 25,
        'completed' => true,
    ]);
    expect($task->fresh()->status)->toBe('en_progreso');
});

test('users can store an incomplete focus session', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create(['status' => 'pendiente']);

    $response = $this->actingAs($user)->postJson(route('focus-sessions.store'), [
        'task_id' => $task->id,
        'minutes' => 7,
        'completed' => false,
    ]);

    $response->assertCreated();
    $this->assertDatabaseHas('focus_sessions', [
        'user_id' => $user->id,
        'task_id' => $task->id,
        'minutes' => 7,
        'completed' => false,
    ]);
    expect($task->fresh()->status)->toBe('pendiente');
});

test('users cannot store a focus session for another user task', function () {
    $user = User::factory()->create();
    $other = User::factory()->create();
    $task = Task::factory()->for($other)->create();

    $response = $this->actingAs($user)->postJson(route('focus-sessions.store'), [
        'task_id' => $task->id,
        'minutes' => 25,
        'completed' => true,
    ]);

    $response->assertUnprocessable();
    $response->assertJsonValidationErrors(['task_id']);
    $this->assertDatabaseCount('focus_sessions', 0);
});

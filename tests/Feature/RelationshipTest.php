<?php

use App\Models\Category;
use App\Models\ContactMessage;
use App\Models\FocusSession;
use App\Models\Plan;
use App\Models\Task;
use App\Models\Testimonial;
use App\Models\User;

test('user has plan and related records', function () {
    $plan = Plan::factory()->create();
    $user = User::factory()->create(['plan_id' => $plan->id]);
    $task = Task::factory()->for($user)->create();
    $focusSession = FocusSession::factory()->for($user)->for($task)->create();
    $testimonial = Testimonial::factory()->for($user)->create();
    $contactMessage = ContactMessage::factory()->for($user)->create();

    expect($user->plan->is($plan))->toBeTrue()
        ->and($user->tasks->contains($task))->toBeTrue()
        ->and($user->focusSessions->contains($focusSession))->toBeTrue()
        ->and($user->testimonials->contains($testimonial))->toBeTrue()
        ->and($user->contactMessages->contains($contactMessage))->toBeTrue();
});

test('plan has many users', function () {
    $plan = Plan::factory()->create();
    User::factory()->count(2)->create(['plan_id' => $plan->id]);

    expect($plan->users)->toHaveCount(2);
});

test('category has many tasks', function () {
    $category = Category::factory()->create();
    Task::factory()->count(2)->create(['category_id' => $category->id]);

    expect($category->tasks)->toHaveCount(2);
});

test('task belongs to user and category and has focus sessions', function () {
    $user = User::factory()->create();
    $category = Category::factory()->create();
    $task = Task::factory()->for($user)->for($category)->create();
    $focusSession = FocusSession::factory()->for($user)->for($task)->create();

    expect($task->user->is($user))->toBeTrue()
        ->and($task->category->is($category))->toBeTrue()
        ->and($task->focusSessions->contains($focusSession))->toBeTrue();
});

test('focus session belongs to user and task', function () {
    $user = User::factory()->create();
    $task = Task::factory()->for($user)->create();
    $focusSession = FocusSession::factory()->for($user)->for($task)->create();

    expect($focusSession->user->is($user))->toBeTrue()
        ->and($focusSession->task->is($task))->toBeTrue();
});

test('testimonial and contact message belong to user', function () {
    $user = User::factory()->create();
    $testimonial = Testimonial::factory()->for($user)->create();
    $contactMessage = ContactMessage::factory()->for($user)->create();

    expect($testimonial->user->is($user))->toBeTrue()
        ->and($contactMessage->user->is($user))->toBeTrue();
});

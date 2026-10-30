<?php

use App\Models\Plan;
use App\Models\User;

test('guests are redirected from admin plans', function () {
    $this->get(route('admin.plans.index'))->assertRedirect(route('login'));
});

test('normal users receive a forbidden response from admin plans', function () {
    $user = User::factory()->create(['is_admin' => false]);

    $this->actingAs($user)->get(route('admin.plans.index'))->assertForbidden();
});

test('auth user can create a plan', function () {
    $user = User::factory()->admin()->create();
    $response = $this->actingAs($user)->post(route('admin.plans.store'), [
        'name' => 'Test Plan',
        'price' => 9.99,
        'period' => 'mes',
        'features_text' => "Feature 1\nFeature 2",
        'excluded_features_text' => '',
        'featured' => false,
    ]);
    $response->assertRedirect(route('admin.plans.index'));
    $this->assertDatabaseHas('plans', ['name' => 'Test Plan']);
});

test('auth user can update a plan', function () {
    $user = User::factory()->admin()->create();
    $plan = Plan::factory()->create();
    $response = $this->actingAs($user)->put(route('admin.plans.update', $plan), [
        'name' => 'Updated Plan',
        'price' => 5.00,
        'period' => 'mes',
        'features_text' => 'Feature X',
        'excluded_features_text' => '',
        'featured' => true,
    ]);
    $response->assertRedirect(route('admin.plans.index'));
    $this->assertDatabaseHas('plans', ['name' => 'Updated Plan']);
});

test('auth user can delete a plan', function () {
    $user = User::factory()->admin()->create();
    $plan = Plan::factory()->create();
    $response = $this->actingAs($user)->delete(route('admin.plans.destroy', $plan));
    $response->assertRedirect(route('admin.plans.index'));
    $this->assertDatabaseMissing('plans', ['id' => $plan->id]);
});

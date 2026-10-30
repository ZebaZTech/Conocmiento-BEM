<?php

use App\Models\Testimonial;
use App\Models\User;

test('guests are redirected from admin testimonials', function () {
    $this->get(route('admin.testimonials.index'))->assertRedirect(route('login'));
});

test('initials are calculated with multibyte characters', function () {
    $user = User::factory()->admin()->create();

    $response = $this->actingAs($user)->post(route('admin.testimonials.store'), [
        'name' => 'Ángela Pérez',
        'role' => 'Diseñadora',
        'text' => 'Excelente herramienta',
        'initials' => '',
        'variant' => 'normal',
    ]);

    $response->assertRedirect(route('admin.testimonials.index'));
    $this->assertDatabaseHas('testimonials', [
        'name' => 'Ángela Pérez',
        'initials' => 'ÁP',
    ]);
});

test('auth user can create a testimonial', function () {
    $user = User::factory()->admin()->create();
    $response = $this->actingAs($user)->post(route('admin.testimonials.store'), [
        'name' => 'Test User',
        'role' => 'Tester',
        'text' => 'Great tool',
        'initials' => '',
        'variant' => 'normal',
    ]);
    $response->assertRedirect(route('admin.testimonials.index'));
    $this->assertDatabaseHas('testimonials', ['name' => 'Test User']);
});

test('auth user can update a testimonial', function () {
    $user = User::factory()->admin()->create();
    $testimonial = Testimonial::factory()->create();
    $response = $this->actingAs($user)->put(route('admin.testimonials.update', $testimonial), [
        'name' => 'Updated Name',
        'role' => 'Updated Role',
        'text' => 'Updated text',
        'initials' => '',
        'variant' => 'highlight',
    ]);
    $response->assertRedirect(route('admin.testimonials.index'));
    $this->assertDatabaseHas('testimonials', ['name' => 'Updated Name']);
});

test('auth user can delete a testimonial', function () {
    $user = User::factory()->admin()->create();
    $testimonial = Testimonial::factory()->create();
    $response = $this->actingAs($user)->delete(route('admin.testimonials.destroy', $testimonial));
    $response->assertRedirect(route('admin.testimonials.index'));
    $this->assertDatabaseMissing('testimonials', ['id' => $testimonial->id]);
});

test('opiniones page shows testimonials from db', function () {
    Testimonial::factory()->create(['name' => 'Test Person', 'variant' => 'normal']);
    $response = $this->get(route('opiniones'));
    $response->assertStatus(200);
    $response->assertSee('Test Person');
});

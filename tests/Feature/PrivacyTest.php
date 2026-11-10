<?php

use App\Models\ContactMessage;
use App\Models\FocusSession;
use App\Models\Task;
use App\Models\Testimonial;
use App\Models\User;

test('privacy policy page responds and shows the responsible name', function () {
    $response = $this->get('/politica-de-privacidad');

    $response->assertOk();
    $response->assertSee('Sebastián Muñoz Bermúdez');
});

test('registration fails without accepting the privacy policy', function () {
    $response = $this->from('/register')->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
    ]);

    $response
        ->assertRedirect('/register')
        ->assertSessionHasErrors('privacy');

    $this->assertGuest();
    $this->assertDatabaseMissing('users', ['email' => 'test@example.com']);
});

test('registration stores the privacy acceptance when it is accepted', function () {
    $response = $this->post('/register', [
        'name' => 'Test User',
        'email' => 'test@example.com',
        'password' => 'password',
        'password_confirmation' => 'password',
        'privacy' => true,
    ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect(route('dashboard', absolute: false));

    $user = User::where('email', 'test@example.com')->first();

    $this->assertNotNull($user->privacy_accepted_at);
    $this->assertSame(config('app.privacy_policy_version', '1.0'), $user->privacy_policy_version);
});

test('contact form fails without accepting the privacy policy', function () {
    $response = $this->from(route('contacto'))->post(route('contacto.store'), [
        'name' => 'Carlos Ruiz',
        'email' => 'carlos@example.com',
        'message' => 'Quiero saber más sobre Focus Work.',
    ]);

    $response
        ->assertRedirect(route('contacto'))
        ->assertSessionHasErrors('privacy');

    $this->assertDatabaseCount('contact_messages', 0);
});

test('contact form stores the privacy acceptance when it is accepted', function () {
    $response = $this->post(route('contacto.store'), [
        'name' => 'Carlos Ruiz',
        'email' => 'carlos@example.com',
        'message' => 'Quiero saber más sobre Focus Work.',
        'privacy' => true,
    ]);

    $response
        ->assertRedirect(route('contacto'))
        ->assertSessionHas('status');

    $message = ContactMessage::where('email', 'carlos@example.com')->first();

    $this->assertNotNull($message);
    $this->assertNotNull($message->privacy_accepted_at);
});

test('account deletion requires the confirmation checkbox', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'password',
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'confirm_deletion')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});

test('account deletion deletes tasks, sessions and user, anonymizes records and logs audit', function () {
    $user = User::factory()->create();
    $task = Task::factory()->create(['user_id' => $user->id]);
    FocusSession::factory()->create(['user_id' => $user->id, 'task_id' => $task->id]);
    $testimonial = Testimonial::create([
        'user_id' => $user->id,
        'name' => 'Laura Mejía',
        'role' => 'Estudiante',
        'text' => 'Me ayuda mucho a concentrarme.',
        'initials' => 'LM',
        'variant' => 'normal',
    ]);
    $contactMessage = ContactMessage::create([
        'user_id' => $user->id,
        'name' => 'Laura Mejía',
        'email' => $user->email,
        'message' => 'Quiero saber más sobre Focus Work.',
    ]);

    $response = $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
            'confirm_deletion' => true,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/')
        ->assertSessionHas('status', 'Tu cuenta y tus datos personales fueron eliminados.');

    $this->assertGuest();
    $this->assertNull($user->fresh());
    $this->assertDatabaseMissing('tasks', ['user_id' => $user->id]);
    $this->assertDatabaseMissing('focus_sessions', ['user_id' => $user->id]);

    $this->assertDatabaseHas('testimonials', [
        'id' => $testimonial->id,
        'name' => 'Usuario eliminado',
        'initials' => 'UE',
        'user_id' => null,
    ]);

    $this->assertDatabaseHas('contact_messages', [
        'id' => $contactMessage->id,
        'name' => 'Usuario eliminado',
        'email' => 'eliminado-'.$user->id.'@anonimo.invalid',
        'message' => '[contenido eliminado por solicitud del titular]',
        'user_id' => null,
    ]);

    $this->assertDatabaseHas('account_deletions', [
        'user_hash' => hash('sha256', mb_strtolower($user->email)),
    ]);
});

test('the only admin cannot delete their account', function () {
    $admin = User::factory()->admin()->create();

    $response = $this
        ->actingAs($admin)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'password',
            'confirm_deletion' => true,
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'admin')
        ->assertRedirect('/profile');

    $this->assertNotNull($admin->fresh());
    $this->assertDatabaseCount('account_deletions', 0);
});

test('an admin can delete their account when another admin exists', function () {
    $admin = User::factory()->admin()->create();
    User::factory()->admin()->create();

    $response = $this
        ->actingAs($admin)
        ->delete('/profile', [
            'password' => 'password',
            'confirm_deletion' => true,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/');

    $this->assertGuest();
    $this->assertNull($admin->fresh());
});

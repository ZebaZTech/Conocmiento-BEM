<?php

use App\Models\ContactMessage;
use App\Models\User;

test('guests are redirected from admin contact messages index', function () {
    $this->get(route('admin.contact-messages.index'))->assertRedirect(route('login'));
});

test('guests are redirected from admin contact message show', function () {
    $contactMessage = ContactMessage::factory()->create();

    $this->get(route('admin.contact-messages.show', $contactMessage))->assertRedirect(route('login'));
});

test('guests are redirected from admin contact message destroy', function () {
    $contactMessage = ContactMessage::factory()->create();

    $this->delete(route('admin.contact-messages.destroy', $contactMessage))->assertRedirect(route('login'));
});

test('auth user can list contact messages', function () {
    $user = User::factory()->admin()->create();
    $contactMessage = ContactMessage::factory()->create([
        'name' => 'Ana Torres',
        'email' => 'ana@example.com',
    ]);

    $response = $this->actingAs($user)->get(route('admin.contact-messages.index'));

    $response->assertOk();
    $response->assertSee($contactMessage->name);
    $response->assertSee($contactMessage->email);
});

test('auth user can view a contact message', function () {
    $user = User::factory()->admin()->create();
    $contactMessage = ContactMessage::factory()->create([
        'message' => 'Necesito ayuda con mi plan.',
    ]);

    $response = $this->actingAs($user)->get(route('admin.contact-messages.show', $contactMessage));

    $response->assertOk();
    $response->assertSee($contactMessage->name);
    $response->assertSee($contactMessage->email);
    $response->assertSee('Necesito ayuda con mi plan.');
});

test('auth user can delete a contact message', function () {
    $user = User::factory()->admin()->create();
    $contactMessage = ContactMessage::factory()->create();

    $response = $this->actingAs($user)->delete(route('admin.contact-messages.destroy', $contactMessage));

    $response->assertRedirect(route('admin.contact-messages.index'));
    $this->assertDatabaseMissing('contact_messages', ['id' => $contactMessage->id]);
});

test('contact form stores a message', function () {
    $response = $this->post(route('contacto.store'), [
        'name' => 'Carlos Ruiz',
        'email' => 'carlos@example.com',
        'message' => 'Quiero saber más sobre Focus Work.',
    ]);

    $response->assertRedirect(route('contacto'));
    $response->assertSessionHas('status');
    $this->assertDatabaseHas('contact_messages', [
        'name' => 'Carlos Ruiz',
        'email' => 'carlos@example.com',
        'message' => 'Quiero saber más sobre Focus Work.',
    ]);
});

test('contact form stores the authenticated user id', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->post(route('contacto.store'), [
        'name' => 'Usuario Autenticado',
        'email' => 'autenticado@example.com',
        'message' => 'Mensaje con sesión iniciada.',
    ]);

    $this->assertDatabaseHas('contact_messages', [
        'user_id' => $user->id,
        'email' => 'autenticado@example.com',
    ]);
});

test('contact form validates the submitted data', function () {
    $response = $this->from(route('contacto'))->post(route('contacto.store'), [
        'name' => '',
        'email' => 'correo-invalido',
        'message' => '',
    ]);

    $response->assertRedirect(route('contacto'));
    $response->assertSessionHasErrors(['name', 'email', 'message']);
    $this->assertDatabaseCount('contact_messages', 0);
});

test('contact form validation errors are shown in spanish', function () {
    $response = $this->from(route('contacto'))->post(route('contacto.store'), [
        'name' => '',
        'email' => 'correo-invalido',
        'message' => '',
    ]);

    $response->assertRedirect(route('contacto'));
    $response->assertSessionHasErrors([
        'name' => 'El campo nombre es obligatorio.',
        'email' => 'El campo correo debe ser una dirección de correo válida.',
        'message' => 'El campo mensaje es obligatorio.',
    ]);
});

<?php

use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Auth\Notifications\ResetPassword;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

test('registration sends the welcome mail to the user email', function () {
    Mail::fake();

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

    Mail::assertSent(WelcomeMail::class, function (WelcomeMail $mail) {
        return $mail->hasTo('test@example.com');
    });
});

test('registration still works when sending the welcome mail fails', function () {
    Mail::shouldReceive('to')->andThrow(new RuntimeException('El servicio de correo no está disponible'));

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

    $this->assertAuthenticated();
    $this->assertDatabaseHas('users', ['email' => 'test@example.com']);
});

test('password reset notification is sent', function () {
    Notification::fake();

    $user = User::factory()->create();

    $response = $this->from(route('password.request'))->post(route('password.email'), [
        'email' => $user->email,
    ]);

    $response->assertSessionHas('status');

    Notification::assertSentTo($user, ResetPassword::class);
});

test('mail test command succeeds and sends the email', function () {
    $this->artisan('mail:test', ['to' => 'destino@example.com'])
        ->expectsOutputToContain('Correo de prueba enviado a destino@example.com')
        ->assertExitCode(0);

    $messages = app('mailer')->getSymfonyTransport()->messages();

    expect($messages)->not->toBeEmpty();

    $email = $messages[0]->getOriginalMessage();

    expect($email->getSubject())->toBe('Correo de prueba de Focus Work');
    expect(collect($email->getTo())->map(fn ($address) => $address->getAddress())->all())->toContain('destino@example.com');
});

test('resend service config exists and its key comes from env', function () {
    expect(config('services.resend'))->toBeArray();
    expect(config('services.resend'))->toHaveKey('key');
    expect(config('services.resend.key'))->toBe(env('RESEND_API_KEY'));
});

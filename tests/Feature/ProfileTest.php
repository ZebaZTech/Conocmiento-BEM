<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('profile page is displayed', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->get('/profile');

    $response->assertOk();
});

test('profile information can be updated', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    $this->assertSame('Test User', $user->name);
    $this->assertSame('test@example.com', $user->email);
    $this->assertNull($user->email_verified_at);
});

test('email verification status is unchanged when the email address is unchanged', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->patch('/profile', [
            'name' => 'Test User',
            'email' => $user->email,
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $this->assertNotNull($user->refresh()->email_verified_at);
});

test('user can delete their account', function () {
    $user = User::factory()->create();

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
});

test('correct password must be provided to delete account', function () {
    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->from('/profile')
        ->delete('/profile', [
            'password' => 'wrong-password',
            'confirm_deletion' => true,
        ]);

    $response
        ->assertSessionHasErrorsIn('userDeletion', 'password')
        ->assertRedirect('/profile');

    $this->assertNotNull($user->fresh());
});

test('profile photo can be uploaded to the s3 disk', function () {
    Storage::fake('s3');

    $user = User::factory()->create();

    $response = $this
        ->actingAs($user)
        ->post('/profile/photo', [
            'photo' => UploadedFile::fake()->image('avatar.jpg', 200, 200),
        ]);

    $response
        ->assertSessionHasNoErrors()
        ->assertRedirect('/profile');

    $user->refresh();

    expect($user->profile_photo_path)->not->toBeNull();
    Storage::disk('s3')->assertExists($user->profile_photo_path);
});

test('uploading a new profile photo deletes the previous one', function () {
    Storage::fake('s3');

    $user = User::factory()->create(['profile_photo_path' => 'profile-photos/old.jpg']);
    Storage::disk('s3')->put('profile-photos/old.jpg', 'old photo');

    $this
        ->actingAs($user)
        ->post('/profile/photo', [
            'photo' => UploadedFile::fake()->image('new.png', 200, 200),
        ])
        ->assertSessionHasNoErrors();

    Storage::disk('s3')->assertMissing('profile-photos/old.jpg');
    Storage::disk('s3')->assertExists($user->refresh()->profile_photo_path);
});

test('profile photo must be a valid image of at most 2 MB', function () {
    Storage::fake('s3');

    $user = User::factory()->create();

    $this
        ->actingAs($user)
        ->post('/profile/photo', [
            'photo' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
        ])
        ->assertSessionHasErrors('photo');

    expect($user->refresh()->profile_photo_path)->toBeNull();
});

test('deleting the account removes the profile photo from the s3 disk', function () {
    Storage::fake('s3');

    $user = User::factory()->create(['profile_photo_path' => 'profile-photos/avatar.jpg']);
    Storage::disk('s3')->put('profile-photos/avatar.jpg', 'photo');

    $this
        ->actingAs($user)
        ->delete('/profile', [
            'password' => 'password',
            'confirm_deletion' => true,
        ])
        ->assertSessionHasNoErrors();

    Storage::disk('s3')->assertMissing('profile-photos/avatar.jpg');
    $this->assertNull($user->fresh());
});

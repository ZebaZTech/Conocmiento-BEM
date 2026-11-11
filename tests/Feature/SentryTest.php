<?php

use App\Models\User;

test('regular users receive a 403 on the sentry test route', function () {
    $user = User::factory()->create();

    $this->actingAs($user)->get('/admin/sentry-test')->assertForbidden();
});

test('admins receive a 500 response on the sentry test route', function () {
    $admin = User::factory()->admin()->create();

    $this->actingAs($admin)->get('/admin/sentry-test')->assertServerError();
});

test('sentry does not send default pii', function () {
    expect(config('sentry.send_default_pii'))->toBeFalse();
});

test('sentry dsn is null or empty in the testing environment', function () {
    expect(config('sentry.dsn'))->toBeEmpty();
});

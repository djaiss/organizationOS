<?php

declare(strict_types=1);

use App\Jobs\SendFailedLoginEmail;
use App\Models\User;
use Illuminate\Support\Facades\Queue;

it('renders the login screen', function (): void {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

it('authenticates a user', function (): void {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('organizations.index', absolute: false));
});

it('does not authenticate a user with invalid password', function (): void {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

it('sends an email on failed login', function (): void {
    Queue::fake();

    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    Queue::assertPushed(SendFailedLoginEmail::class, function (SendFailedLoginEmail $job) use ($user): bool {
        return $job->email === $user->email;
    });
});

it('logs out a user', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});

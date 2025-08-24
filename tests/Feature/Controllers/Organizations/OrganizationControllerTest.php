<?php

declare(strict_types=1);
use App\Models\Organization;
use App\Models\User;

it('shows the organizations the user is a member of', function (): void {
    $user = User::factory()->create();
    $organization = Organization::factory()->create([
        'name' => 'Dunder Mifflin',
        'slug' => 'dunder-mifflin',
    ]);
    $user->organizations()->attach($organization->id, [
        'joined_at' => now(),
    ]);

    $response = $this->actingAs($user)->get('/organizations');

    $response->assertStatus(200);
    $response->assertSee('Dunder Mifflin');
});

it('shows a message when the user is not a member of any organizations', function (): void {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->get('/organizations');

    $response->assertStatus(200);
    $response->assertSee('You are not a member of any organizations yet.');
});

<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('it creates an organization', function () {
    $user = User::factory()->create();
    Sanctum::actingAs($user);

    $response = $this->json('POST', '/api/organizations', [
        'name' => 'Dunder Mifflin',
    ]);

    $response->assertStatus(201);

    $organization = $user->organizations()->first();

    expect($response->json())
        ->toBe([
            'id' => $organization->id,
            'object' => 'organization',
            'name' => 'Dunder Mifflin',
        ]);
});

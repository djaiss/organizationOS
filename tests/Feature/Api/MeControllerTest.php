<?php

use App\Models\User;
use Laravel\Sanctum\Sanctum;

test('the /me endpoint returns information about the logged user', function () {
    $user = Sanctum::actingAs(
        User::factory()->create([
            'name' => 'Dwight Schrute',
            'email' => 'dwight.schrute@dundermifflin.com',
        ])
    );

    $response = $this->json('GET', '/api/me');

    $response->assertStatus(200);

    expect($response->json())
        ->toBe([
            'id' => $user->id,
            'name' => 'Dwight Schrute',
            'email' => 'dwight.schrute@dundermifflin.com',
        ]);
});

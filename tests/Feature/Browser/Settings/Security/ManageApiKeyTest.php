<?php

declare(strict_types=1);

use App\Models\User;

it('manages API keys', function (): void {
    $user = User::factory()->create([
        'email' => 'michael.scott@dundermifflin.com',
    ]);

    $this->actingAs($user);

    $page = visit('/settings/security');
    $page->press('@new-api-key-button');
    $page->type('label', 'test1');
    $page->press('@create-api-key-button');
    $page->assertSee('API Key created successfully');
});

<?php

use App\Models\Organization;
use App\Models\User;

test('it belongs to an organization', function () {
    $organization = Organization::factory()->create();
    $user = User::factory()->create([
        'organization_id' => $organization->id,
    ]);

    expect($user->organization()->exists())->toBeTrue();
});

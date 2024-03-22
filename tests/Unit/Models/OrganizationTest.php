<?php

use App\Models\Organization;
use App\Models\User;

test('it has multiple users', function () {
    $organization = Organization::factory()->create();
    User::factory()->create(['organization_id' => $organization->id]);

    expect($organization->users()->exists())->toBeTrue();
});

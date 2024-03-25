<?php

use App\Models\Organization;
use App\Models\User;

test('it has multiple users', function () {
    $organization = Organization::factory()->create();
    $organization->users()->attach(User::factory()->create());

    expect($organization->users()->exists())->toBeTrue();
});

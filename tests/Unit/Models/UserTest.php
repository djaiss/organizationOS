<?php

use App\Models\Organization;
use App\Models\User;

test('it has many organizations', function () {
    $organization = Organization::factory()->create();
    $user = User::factory()->create();
    $user->organizations()->attach($organization);

    expect($user->organizations()->exists())->toBeTrue();
});

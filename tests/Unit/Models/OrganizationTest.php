<?php

use App\Models\Organization;
use App\Models\Permission;
use App\Models\User;

test('it has multiple users', function () {
    $organization = Organization::factory()->create();
    $organization->users()->attach(User::factory()->create());

    expect($organization->users()->exists())->toBeTrue();
});

test('it has many permissions', function () {
    $organization = Organization::factory()->create();
    Permission::factory()->create([
        'organization_id' => $organization->id,
    ]);

    expect($organization->permissions()->exists())->toBeTrue();
});

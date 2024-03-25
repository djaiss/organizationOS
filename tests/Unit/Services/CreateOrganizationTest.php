<?php

use App\Models\Organization;
use App\Models\User;
use App\Services\CreateOrganization;

test('it creates an organization', function () {
    $user = User::factory()->create();
    $this->be($user);

    $organization = (new CreateOrganization(
        name: 'Dunder Mifflin',
    ))->execute();

    expect($organization)->toBeInstanceOf(Organization::class);

    $this->assertDatabaseHas('organizations', [
        'id' => $organization->id,
        'name' => 'Dunder Mifflin',
    ]);

    $this->assertDatabaseHas('organization_user', [
        'organization_id' => $organization->id,
        'user_id' => $user->id,
    ]);
});

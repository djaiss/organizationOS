<?php

use App\Exceptions\NotEnoughPermissionException;
use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use App\Services\CreatePermission;

test('a user can create a permission', function () {
    $organization = Organization::factory()->create();
    $user = userWithPermission(Action::MANAGE_PERMISSIONS, $organization);
    $this->be($user);

    $permission = (new CreatePermission(
        organization: $organization,
        label: 'Administrator with less power',
    ))->execute();

    expect($permission)->toBeInstanceOf(Permission::class);

    $this->assertDatabaseHas('permissions', [
        'id' => $permission->id,
        'organization_id' => $organization->id,
        'label' => 'Administrator with less power',
    ]);
});

test('a user cant create a permission if he doesnt have the right to do so', function () {
    $organization = Organization::factory()->create();
    $user = userWithPermission('fake-permission', $organization);
    $this->be($user);

    (new CreatePermission(
        organization: $organization,
        label: 'Administrator with less power',
    ))->execute();
})->throws(NotEnoughPermissionException::class);

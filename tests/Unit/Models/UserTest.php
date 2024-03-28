<?php

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use App\Models\User;

test('it has many organizations', function () {
    $organization = Organization::factory()->create();
    $user = User::factory()->create();
    $user->organizations()->attach($organization);

    expect($user->organizations()->exists())->toBeTrue();
});

test('it gets the permission of a user within an organization', function () {
    $permission = Permission::factory()->create();
    $user = User::factory()->create();
    $organization = Organization::factory()->create();
    $organization->users()->syncWithoutDetaching([
        $user->id => ['permission_id' => $permission->id],
    ]);

    $userPermission = $user->getPermissionInOrganization($organization);

    expect($userPermission)->toBeInstanceOf(Permission::class);
    expect($userPermission->id)->toEqual($permission->id);
});

test('it checks if a user has the right to do an action', function () {
    $permission = Permission::factory()->create();
    $action = Action::factory()->create([
        'identifier' => 'view_user',
    ]);
    $permission->actions()->attach($action);
    $user = User::factory()->create();
    $organization = Organization::factory()->create();
    $organization->users()->syncWithoutDetaching([
        $user->id => ['permission_id' => $permission->id],
    ]);
    $this->be($user);

    expect($user->hasTheRightTo('view_user', $organization))->toBeTrue();

    expect($user->hasTheRightTo('manage_janitors', $organization))->toBeFalse();
});

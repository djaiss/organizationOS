<?php

use App\Models\Action;
use App\Models\Permission;

test('it belongs to many permissions', function () {
    $action = Action::factory()->create();
    $permission = Permission::factory()->create();
    $action->permissions()->attach($permission);

    expect($action->permissions()->exists())->toBeTrue();
});

<?php

use App\Models\Action;
use App\Models\Permission;

test('it belongs to one organization', function () {
    $permission = Permission::factory()->create();

    expect($permission->organization()->exists())->toBeTrue();
});

test('it belongs to many actions', function () {
    $permission = Permission::factory()->create();
    $action = Action::factory()->create();
    $permission->actions()->attach($action);

    expect($permission->actions()->exists())->toBeTrue();
});

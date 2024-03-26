<?php

use App\Models\Permission;

test('it belongs to one organization', function () {
    $permission = Permission::factory()->create();

    expect($permission->organization()->exists())->toBeTrue();
});

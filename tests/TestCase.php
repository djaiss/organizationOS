<?php

namespace Tests;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    /**
     * Create an administrator in an account.
     *
     * @return Employee
     */
    public function userWithPermission(string $action, Organization $organization): User
    {
        $permission = Permission::factory()->create([
            'organization_id' => $organization->id,
        ]);
        $action = Action::factory()->create([
            'identifier' => $action,
        ]);
        $permission->actions()->attach($action);
        $user = User::factory()->create();
        $organization->users()->syncWithoutDetaching([
            $user->id => ['permission_id' => $permission->id],
        ]);

        return $user;
    }
}

<?php

namespace Tests\Unit\Models;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_many_organizations(): void
    {
        $organization = Organization::factory()->create();
        $user = User::factory()->create();
        $user->organizations()->attach($organization);

        $this->assertTrue($user->organizations()->exists());
    }

    /** @test */
    public function it_gets_the_permission_of_a_user_within_an_organization(): void
    {
        $permission = Permission::factory()->create();
        $user = User::factory()->create();
        $organization = Organization::factory()->create();
        $organization->users()->syncWithoutDetaching([
            $user->id => ['permission_id' => $permission->id],
        ]);

        $userPermission = $user->getPermissionInOrganization($organization);

        $this->assertInstanceOf(
            Permission::class,
            $permission
        );
        $this->assertEquals(
            $userPermission->id,
            $permission->id
        );
    }

    /** @test */
    public function it_checks_if_a_user_has_the_right_to_do_an_action(): void
    {
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

        $this->assertTrue($user->hasTheRightTo('view_user', $organization));
        $this->assertFalse($user->hasTheRightTo('manage_janitors', $organization));
    }
}

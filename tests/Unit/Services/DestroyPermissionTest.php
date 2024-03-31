<?php

namespace Tests\Unit\Services;

use App\Exceptions\NotEnoughPermissionException;
use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use App\Services\DestroyPermission;
use Exception;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DestroyPermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_destroy_a_permission(): void
    {
        $organization = Organization::factory()->create();
        $user = $this->userWithPermission(Action::MANAGE_PERMISSIONS, $organization);
        $this->be($user);

        $permission = Permission::factory()->create([
            'organization_id' => $organization->id,
            'label' => 'Small Administrator',
        ]);

        (new DestroyPermission(
            organization: $organization,
            permission: $permission,
        ))->execute();

        $this->assertDatabaseMissing('permissions', [
            'id' => $permission->id,
        ]);
    }

    /** @test */
    public function a_user_cant_delete_a_permission_if_he_doesnt_have_the_right_to_do_so(): void
    {
        $this->expectException(NotEnoughPermissionException::class);

        $organization = Organization::factory()->create();
        $user = $this->userWithPermission('fake-permission', $organization);
        $this->be($user);

        $permission = Permission::factory()->create([
            'organization_id' => $organization->id,
            'label' => 'Small Administrator',
        ]);

        (new DestroyPermission(
            organization: $organization,
            permission: $permission,
        ))->execute();
    }

    /** @test */
    public function a_user_cant_delete_a_permission_he_is_using(): void
    {
        $this->expectException(Exception::class);

        $organization = Organization::factory()->create();
        $user = $this->userWithPermission('fake-permission', $organization);
        $this->be($user);

        $permission = Permission::latest()->first();

        (new DestroyPermission(
            organization: $organization,
            permission: $permission,
        ))->execute();
    }
}

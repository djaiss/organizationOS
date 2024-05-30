<?php

namespace Tests\Unit\Services;

use App\Exceptions\NotEnoughPermissionException;
use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use App\Services\CreatePermission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreatePermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_permission(): void
    {
        $organization = Organization::factory()->create();
        $user = $this->userWithPermission(Action::MANAGE_PERMISSIONS, $organization);
        $this->be($user);

        $permission = (new CreatePermission(
            organization: $organization,
            label: 'Administrator with less power',
        ))->execute();

        $this->assertInstanceOf(
            Permission::class,
            $permission
        );

        $this->assertDatabaseHas('permissions', [
            'id' => $permission->id,
            'organization_id' => $organization->id,
            'label' => 'Administrator with less power',
        ]);
    }

    /** @test */
    public function a_user_cant_create_a_permission_if_he_doesnt_have_the_right_to_do_so(): void
    {
        $this->expectException(NotEnoughPermissionException::class);

        $organization = Organization::factory()->create();
        $user = $this->userWithPermission('fake-permission', $organization);
        $this->be($user);

        (new CreatePermission(
            organization: $organization,
            label: 'Administrator with less power',
        ))->execute();
    }
}

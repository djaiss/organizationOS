<?php

namespace Tests\Feature\Api\Organization;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class PermissionControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_permission(): void
    {
        $organization = Organization::factory()->create();
        $user = $this->userWithPermission(Action::MANAGE_PERMISSIONS, $organization);
        Sanctum::actingAs($user);

        $response = $this->json('POST', '/api/organizations/'.$organization->id.'/permissions', [
            'label' => 'Crazy administrator',
        ]);

        $response->assertStatus(201);

        $permission = Permission::latest('id')->first();

        $this->assertEquals(
            [
                'id' => $permission->id,
                'object' => 'permission',
                'label' => 'Crazy administrator',
            ],
            $response->json()
        );
    }

    /** @test */
    public function it_updates_a_permission(): void
    {
        $organization = Organization::factory()->create();
        $user = $this->userWithPermission(Action::MANAGE_PERMISSIONS, $organization);
        Sanctum::actingAs($user);

        $permission = Permission::factory()->create([
            'organization_id' => $organization->id,
            'label' => 'Small Administrator',
        ]);

        $response = $this->json('PUT', '/api/organizations/'.$organization->id.'/permissions/'.$permission->id, [
            'label' => 'Crazy administrator',
        ]);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'id' => $permission->id,
                'object' => 'permission',
                'label' => 'Crazy administrator',
            ],
            $response->json()
        );
    }

    /** @test */
    public function it_deletes_a_permission(): void
    {
        $organization = Organization::factory()->create();
        $user = $this->userWithPermission(Action::MANAGE_PERMISSIONS, $organization);
        Sanctum::actingAs($user);

        $permission = Permission::factory()->create([
            'organization_id' => $organization->id,
            'label' => 'Small Administrator',
        ]);

        $response = $this->json('DELETE', '/api/organizations/' . $organization->id . '/permissions/' . $permission->id);

        $response->assertStatus(200);

        $this->assertEquals(
            [
                'status' => 'success',
            ],
            $response->json()
        );
    }
}

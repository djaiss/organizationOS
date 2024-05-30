<?php

namespace Tests\Feature\Api\Organization;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_organization(): void
    {
        $user = User::factory()->create();
        Sanctum::actingAs($user);

        $response = $this->json('POST', '/api/organizations', [
            'name' => 'Dunder Mifflin',
        ]);

        $response->assertStatus(201);

        $organization = $user->organizations()->first();

        $this->assertEquals(
            $response->json(),
            [
                'id' => $organization->id,
                'object' => 'organization',
                'name' => 'Dunder Mifflin',
            ]
        );
    }

    /** @test */
    public function it_lists_all_the_organizations(): void
    {
        $user = User::factory()->create();
        $organization = $user->organizations()->create([
            'name' => 'Dunder Mifflin',
        ]);
        $secondOrganization = $user->organizations()->create([
            'name' => 'Wayne Enterprises',
        ]);
        Sanctum::actingAs($user);

        $response = $this->json('GET', '/api/organizations');

        $response->assertStatus(200);

        $this->assertEquals(
            $response->json(),
            [
                0 => [
                    'id' => $organization->id,
                    'object' => 'organization',
                    'name' => 'Dunder Mifflin',
                ],
                1 => [
                    'id' => $secondOrganization->id,
                    'object' => 'organization',
                    'name' => 'Wayne Enterprises',
                ],
            ]
        );
    }
}

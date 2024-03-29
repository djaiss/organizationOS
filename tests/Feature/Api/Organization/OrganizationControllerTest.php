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
    public function it_returns_the_information_about_the_logged_user(): void
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
}

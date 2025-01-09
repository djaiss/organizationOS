<?php

declare(strict_types=1);

namespace Tests\Feature\Api\Teams;

use App\Enums\Permission;
use App\Models\Team;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class TeamControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function administrator_can_create_a_team(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $user = User::factory()->create([
            'permission' => Permission::ADMINISTRATOR->value,
        ]);

        Sanctum::actingAs($user);

        $response = $this->json('POST', '/api/teams', [
            'name' => 'Web developers',
        ]);

        $response->assertStatus(201);
        $team = Team::orderBy('id', 'desc')->first();

        $this->assertEquals(
            [
                'id' => $team->id,
                'object' => 'team',
                'account_id' => $user->account_id,
                'name' => 'Web developers',
                'created_at' => '1514764800',
            ],
            $response->json()['data']
        );

        $this->assertDatabaseHas('teams', [
            'id' => $team->id,
            'account_id' => $user->account_id,
            'name' => 'Web developers',
        ]);
    }

    #[Test]
    public function hr_representative_can_create_a_team(): void
    {
        $user = User::factory()->create([
            'permission' => Permission::HR->value,
        ]);

        Sanctum::actingAs($user);

        $response = $this->json('POST', '/api/teams', [
            'name' => 'Web developers',
        ]);

        $response->assertStatus(201);
    }

    #[Test]
    public function regular_member_can_create_a_team(): void
    {
        $user = User::factory()->create([
            'permission' => Permission::MEMBER->value,
        ]);

        Sanctum::actingAs($user);

        $response = $this->json('POST', '/api/teams', [
            'name' => 'Web developers',
        ]);

        $response->assertStatus(201);
    }

    #[Test]
    public function it_validates_team_name_when_creating(): void
    {
        $user = User::factory()->create([
            'permission' => Permission::ADMINISTRATOR->value,
        ]);

        Sanctum::actingAs($user);

        // Test empty name
        $response = $this->json('POST', '/api/teams', [
            'name' => '',
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);

        // Test name too long
        $response = $this->json('POST', '/api/teams', [
            'name' => str_repeat('a', 256),
        ]);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['name']);
    }
}

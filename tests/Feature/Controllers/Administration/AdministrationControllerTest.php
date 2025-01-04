<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Administration;

use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class AdministrationControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function administration_index_can_be_rendered(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $user = User::factory()->create([
            'first_name' => 'Dwight',
            'last_name' => 'Schrute',
            'email' => 'dwight@schrute.com',
            'last_activity_at' => now(),
        ]);
        Log::factory()->create([
            'user_id' => $user->id,
            'action' => 'account_creation',
            'description' => 'Created an account',
        ]);

        $response = $this->actingAs($user)
            ->get('/administration');

        $response->assertStatus(200);

        $this->assertArrayHasKey('user', $response);
        $this->assertArrayHasKey('logs', $response);
        $this->assertArrayHasKey('has_more_logs', $response);

        $this->assertEquals(
            [
                'profile_photo_url' => $user->profile_photo_url,
                'first_name' => 'Dwight',
                'last_name' => 'Schrute',
                'email' => 'dwight@schrute.com',
                'name' => 'Dwight Schrute',
            ],
            $response['user']
        );

        $this->assertEquals(
            [
                'user' => [
                    'name' => 'Dwight Schrute',
                ],
                'action' => 'account_creation',
                'description' => 'Created an account',
                'created_at' => '0 seconds ago',
            ],
            $response['logs'][0]
        );

        $this->assertFalse($response['has_more_logs']);
    }

    #[Test]
    public function user_can_update_their_information(): void
    {
        $user = User::factory()->create();
        $response = $this->actingAs($user)
            ->put('/administration', [
                'first_name' => 'Dwight',
                'last_name' => 'Schrute',
                'email' => 'dwight@schrute.com',
            ]);

        $response->assertStatus(302);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'first_name' => 'Dwight',
            'last_name' => 'Schrute',
            'email' => 'dwight@schrute.com',
        ]);
    }
}

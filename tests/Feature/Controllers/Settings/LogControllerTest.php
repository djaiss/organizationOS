<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Settings;

use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LogControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_all_the_logs(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));
        $user = User::factory()->create([
            'first_name' => 'Ross',
            'last_name' => 'Geller',
            'nickname' => null,
        ]);

        $log = Log::factory()->create([
            'organization_id' => null,
            'user_id' => $user->id,
            'action' => 'profile_update',
            'description' => 'Updated their profile',
        ]);

        $response = $this->actingAs($user)
            ->get('/settings/profile/logs');

        $response->assertStatus(200);
        $response->assertViewIs('settings.logs.index');
        $this->assertArrayHasKey('logs', $response);

        $logs = $response['logs'];
        $this->assertCount(1, $logs);
        $this->assertEquals($log->id, $logs[0]->id);
        $this->assertEquals('Ross Geller', $logs[0]->user->name);
        $this->assertEquals('profile_update', $logs[0]->action);
        $this->assertEquals('Updated their profile', $logs[0]->description);
    }

    #[Test]
    public function it_shows_a_pagination(): void
    {
        $user = User::factory()->create();

        // Create 15 logs (more than the per-page limit of 10)
        Log::factory()->count(15)->create([
            'organization_id' => null,
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)
            ->get('/settings/profile/logs');

        $response->assertStatus(200);
        $this->assertCount(10, $response['logs']); // First page should have 10 items
        $this->assertTrue($response['logs']->hasMorePages());
    }
}

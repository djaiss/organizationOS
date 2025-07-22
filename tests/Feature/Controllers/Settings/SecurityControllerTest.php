<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SecurityControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_displays_the_change_password_form(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/settings/security');

        $response->assertStatus(200);
        $response->assertViewIs('settings.security.index');
    }
}

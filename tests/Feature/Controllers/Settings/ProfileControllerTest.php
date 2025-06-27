<?php

namespace Tests\Feature\Controllers\Settings;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_the_profile_page(): void
    {
        $this->actingAs(User::factory()->create());

        $this->get('/settings/profile')->assertOk();
    }

    #[Test]
    public function it_updates_the_profile_information(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put('/settings/profile', [
                'first_name' => 'Michael',
                'last_name' => 'Scott',
                'nickname' => 'Michael',
                'email' => 'michael.scott@dundermifflin.com',
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/settings/profile');

        $user->refresh();

        $this->assertSame('Michael', $user->first_name);
        $this->assertSame('Scott', $user->last_name);
        $this->assertSame('Michael', $user->nickname);
        $this->assertSame('michael.scott@dundermifflin.com', $user->email);
        $this->assertNull($user->email_verified_at);
    }

    #[Test]
    public function it_does_not_change_the_email_verification_status_when_email_address_is_unchanged(): void
    {
        $user = User::factory()->create();

        $response = $this
            ->actingAs($user)
            ->put('/settings/profile', [
                'first_name' => 'Michael',
                'last_name' => 'Scott',
                'nickname' => 'Michael',
                'email' => $user->email,
            ]);

        $response
            ->assertSessionHasNoErrors()
            ->assertRedirect('/settings/profile');

        $this->assertNotNull($user->refresh()->email_verified_at);
    }
}

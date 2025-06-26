<?php

declare(strict_types=1);

namespace Tests\Feature\Controllers\Organizations;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrganizationControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_shows_the_organizations_the_user_is_a_member_of(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create([
            'name' => 'Dunder Mifflin',
            'slug' => 'dunder-mifflin',
        ]);
        $user->organizations()->attach($organization->id, [
            'joined_at' => now(),
        ]);

        $response = $this->actingAs($user)->get('/organizations');

        $response->assertStatus(200);
        $response->assertSee('Dunder Mifflin');
    }

    #[Test]
    public function it_shows_a_message_when_the_user_is_not_a_member_of_any_organizations(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get('/organizations');

        $response->assertStatus(200);
        $response->assertSee('You are not a member of any organizations yet.');
    }
}

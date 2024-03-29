<?php

namespace Tests\Unit\Services;

use App\Jobs\PopulateAccount;
use App\Models\Organization;
use App\Models\User;
use App\Services\CreateOrganization;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Queue;
use Tests\TestCase;

class CreateOrganizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_an_organization(): void
    {
        Queue::fake();
        $user = User::factory()->create();
        $this->be($user);

        $organization = (new CreateOrganization(
            name: 'Dunder Mifflin',
        ))->execute();

        $this->assertInstanceOf(
            Organization::class,
            $organization
        );

        $this->assertDatabaseHas('organizations', [
            'id' => $organization->id,
            'name' => 'Dunder Mifflin',
        ]);

        $this->assertDatabaseHas('permissions', [
            'organization_id' => $organization->id,
            'label_translation_key' => 'Administrator',
        ]);

        $this->assertDatabaseHas('organization_user', [
            'organization_id' => $organization->id,
            'user_id' => $user->id,
        ]);

        Queue::assertPushed(PopulateAccount::class);
    }
}

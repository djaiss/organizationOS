<?php

namespace Tests\Unit\Models;

use App\Models\Organization;
use App\Models\Permission;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_multiple_users(): void
    {
        $organization = Organization::factory()->create();
        $organization->users()->attach(User::factory()->create());

        $this->assertTrue($organization->users()->exists());
    }

    /** @test */
    public function it_has_many_persmissions(): void
    {
        $organization = Organization::factory()->create();
        Permission::factory()->create([
            'organization_id' => $organization->id,
        ]);

        $this->assertTrue($organization->permissions()->exists());
    }
}

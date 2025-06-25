<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_has_many_users(): void
    {
        $organization = Organization::factory()->create();
        User::factory()->count(2)->create([
            'organization_id' => $organization->id,
        ]);

        $this->assertTrue($organization->users()->exists());
    }
}

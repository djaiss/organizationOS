<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\EmailSent;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_many_organizations(): void
    {
        $user = User::factory()->create();
        $organization1 = Organization::factory()->create();
        $organization2 = Organization::factory()->create();

        $user->organizations()->attach($organization1->id, [
            'joined_at' => now(),
        ]);
        $user->organizations()->attach($organization2->id, [
            'joined_at' => now(),
        ]);

        $this->assertCount(2, $user->organizations);
        $this->assertTrue($user->organizations->contains($organization1));
        $this->assertTrue($user->organizations->contains($organization2));
    }

    #[Test]
    public function it_has_many_emails_sent(): void
    {
        $user = User::factory()->create();
        EmailSent::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($user->emailsSent()->exists());
    }

    #[Test]
    public function it_gets_the_name(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Dwight',
            'last_name' => 'Schrute',
            'nickname' => null,
        ]);

        $this->assertEquals(
            'Dwight Schrute',
            $user->name,
        );

        $user->nickname = 'The Beet Farmer';
        $user->save();
        $this->assertEquals(
            'The Beet Farmer',
            $user->name,
        );
    }

    #[Test]
    public function it_has_initials(): void
    {
        $dwight = User::factory()->create([
            'first_name' => 'Dwight',
            'last_name' => 'Schrute',
        ]);

        $this->assertEquals('DS', $dwight->initials());
    }

    #[Test]
    public function it_checks_organization_membership(): void
    {
        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        $this->assertFalse($user->isPartOfOrganization($organization));

        $user->organizations()->attach($organization->id, [
            'joined_at' => now(),
        ]);
        $this->assertTrue($user->isPartOfOrganization($organization));
    }
}

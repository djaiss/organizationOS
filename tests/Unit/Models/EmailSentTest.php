<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\EmailSent;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class EmailSentTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_an_organization(): void
    {
        $organization = Organization::factory()->create();
        $emailSent = EmailSent::factory()->create([
            'organization_id' => $organization->id,
        ]);

        $this->assertTrue($emailSent->organization()->exists());
    }

    #[Test]
    public function it_belongs_to_a_user(): void
    {
        $user = User::factory()->create();
        $emailSent = EmailSent::factory()->create([
            'user_id' => $user->id,
        ]);

        $this->assertTrue($emailSent->user()->exists());
    }
}

<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_belongs_to_an_account(): void
    {
        $dwight = User::factory()->create();

        $this->assertTrue($dwight->account()->exists());
    }

    #[Test]
    public function it_has_many_logs(): void
    {
        $dwight = User::factory()->create();
        Log::factory()->create([
            'user_id' => $dwight->id,
        ]);

        $this->assertTrue($dwight->logs()->exists());
    }

    #[Test]
    public function it_gets_the_name(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Dwight',
            'last_name' => 'Schrute',
        ]);

        $this->assertEquals(
            'Dwight Schrute',
            $user->name
        );
    }

    #[Test]
    public function it_can_determine_if_two_factor_authentication_is_enabled(): void
    {
        $user = User::factory()->create();

        $this->assertFalse($user->hasEnabledTwoFactorAuthentication());

        $user->two_factor_secret = encrypt('secret');
        $user->two_factor_confirmed_at = now();
        $user->save();

        $this->assertTrue($user->hasEnabledTwoFactorAuthentication());
    }
}

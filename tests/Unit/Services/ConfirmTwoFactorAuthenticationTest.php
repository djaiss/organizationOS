<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Models\User;
use App\Services\ConfirmTwoFactorAuthentication;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use PragmaRX\Google2FA\Google2FA;
use Tests\TestCase;

class ConfirmTwoFactorAuthenticationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_confirms_two_factor_authentication(): void
    {
        $tfaEngine = app(Google2FA::class);
        $userSecret = $tfaEngine->generateSecretKey();
        $validOtp = $tfaEngine->getCurrentOtp($userSecret);

        $user = User::factory()->create([
            'two_factor_secret' => encrypt($userSecret),
            'two_factor_confirmed_at' => null,
        ]);

        (new ConfirmTwoFactorAuthentication(
            user: $user,
            code: $validOtp
        ))->execute();

        $user = $user->fresh();

        $this->assertNotNull($user->two_factor_confirmed_at);
        // $this->assertTrue($user->hasEnabledTwoFactorAuthentication());

        $user->forceFill(['two_factor_confirmed_at' => null])->save();

        // $this->assertFalse($user->hasEnabledTwoFactorAuthentication());
    }

    // #[Test]
    // public function it_throws_validation_exception_when_secret_is_empty(): void
    // {
    //     $this->expectException(ValidationException::class);

    //     $user = User::factory()->create([
    //         'two_factor_secret' => null,
    //     ]);

    //     (new ConfirmTwoFactorAuthentication(
    //         user: $user,
    //         code: '123456'
    //     ))->execute();
    // }

    // #[Test]
    // public function it_throws_validation_exception_when_code_is_empty(): void
    // {
    //     $this->expectException(ValidationException::class);

    //     $user = User::factory()->create([
    //         'two_factor_secret' => 'secret',
    //     ]);

    //     (new ConfirmTwoFactorAuthentication(
    //         user: $user,
    //         code: ''
    //     ))->execute();
    // }

    // #[Test]
    // public function it_throws_validation_exception_when_code_is_invalid(): void
    // {
    //     $this->expectException(ValidationException::class);

    //     $user = User::factory()->create([
    //         'two_factor_secret' => 'secret',
    //     ]);

    //     (new ConfirmTwoFactorAuthentication(
    //         user: $user,
    //         code: 'invalid'
    //     ))->execute();
    // }
}

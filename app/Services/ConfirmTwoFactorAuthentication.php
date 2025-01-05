<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use Illuminate\Validation\ValidationException;
use PragmaRX\Google2FA\Google2FA;

class ConfirmTwoFactorAuthentication
{
    public function __construct(
        public User $user,
        public string $code,
    ) {}

    public function execute(): void
    {
        $this->confirm();
    }

    private function confirm(): void
    {
        $google2fa = app(Google2FA::class);

        if (
            empty($this->user->two_factor_secret) ||
            ($this->code === '' || $this->code === '0') ||
            ! $google2fa->verifyKey(decrypt($this->user->two_factor_secret), $this->code)
        ) {
            throw ValidationException::withMessages([
                'code' => [__('The provided two factor authentication code was invalid.')],
            ]);
        }

        $this->user->two_factor_confirmed_at = now();
        $this->user->save();
    }
}

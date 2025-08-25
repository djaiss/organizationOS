<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\LogUserAction;
use App\Jobs\SendAPIDestroyedEmail;
use App\Models\User;

final class DestroyApiKey
{
    private string $label;

    public function __construct(
        public User $user,
        public int $tokenId,
    ) {}

    /**
     * Destroy an API key.
     */
    public function execute(): void
    {
        $token = $this->user->tokens()->where('id', $this->tokenId)->first();
        $this->label = $token->name;
        $token->delete();

        $this->log();
        $this->sendEmail();
    }

    private function log(): void
    {
        LogUserAction::dispatch(
            organization: null,
            user: $this->user,
            action: 'api_key_deletion',
            description: 'Deleted an API key',
        )->onQueue('low');
    }

    private function sendEmail(): void
    {
        SendAPIDestroyedEmail::dispatch(
            email: $this->user->email,
            label: $this->label,
        )->onQueue('high');
    }
}

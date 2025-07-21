<?php

declare(strict_types=1);

namespace App\Actions;

use App\Jobs\LogUserAction;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

/**
 * Create an account for a user.
 */
class CreateAccount
{
    private User $user;

    public function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
        public string $organizationName,
    ) {}

    public function execute(): User
    {
        $this->addFirstUser();
        $this->createOrganization();
        $this->log();

        return $this->user;
    }

    private function createOrganization(): void
    {
        new CreateOrganization(
            userId: $this->user->id,
            organizationName: $this->organizationName,
        )->execute();
    }

    private function addFirstUser(): void
    {
        $this->user = User::create([
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
        ]);
    }

    private function log(): void
    {
        LogUserAction::dispatch(
            organization: null,
            user: $this->user,
            action: 'account_created',
            description: 'Created an account',
        )->onQueue('low');
    }
}

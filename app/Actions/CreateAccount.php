<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Account;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

/**
 * Create an account for a user.
 */
class CreateAccount
{
    private Organization $organization;

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
        $this->create();
        $this->addFirstUser();

        return $this->user;
    }

    private function create(): void
    {
        $this->organization = Organization::create([
            'name' => $this->organizationName,
            'slug' => Str::slug($this->organizationName),
        ]);
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
}

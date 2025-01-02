<?php

namespace App\Services;

use App\Jobs\SetupAccount;
use App\Models\Account;
use App\Models\User;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;

class CreateAccount
{
    private Account $account;

    public function __construct(
        public string $email,
        public string $password,
        public string $firstName,
        public string $lastName,
    ) {}

    /**
     * Create an account.
     */
    public function execute(): User
    {
        $this->account = Account::create();

        return $this->addFirstUser();
    }

    private function addFirstUser(): User
    {
        return User::create([
            'account_id' => $this->account->id,
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'locale' => App::getLocale(),
            'is_account_administrator' => true,
            'timezone' => 'UTC',
        ]);
    }
}
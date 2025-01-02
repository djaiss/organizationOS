<?php

namespace Tests\Unit\Services;

use App\Jobs\SetupAccount;
use App\Models\User;
use App\Services\CreateAccount;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_creates_an_account(): void
    {
        $this->executeService();
    }

    private function executeService(): void
    {
        $user = (new CreateAccount(
            email: 'dwight@dundermifflin.com',
            password: 'johnny',
            firstName: 'Dwight',
            lastName: 'Schrute',
        ))->execute();

        $this->assertDatabaseHas('accounts', [
            'id' => $user->account->id,
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'account_id' => $user->account_id,
            'first_name' => 'Dwight',
            'last_name' => 'Schrute',
            'email' => 'dwight@dundermifflin.com',
            'is_account_administrator' => true,
            'timezone' => 'UTC',
        ]);

        $this->assertInstanceOf(
            User::class,
            $user
        );
    }
}
<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreateAccount;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\UniqueConstraintViolationException;
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

    #[Test]
    public function it_cant_create_an_account_with_the_same_email(): void
    {
        $this->expectException(UniqueConstraintViolationException::class);

        User::factory()->create([
            'email' => 'michael.scott@dundermifflin.com',
        ]);

        (new CreateAccount(
            email: 'michael.scott@dundermifflin.com',
            password: 'password',
            firstName: 'Michael',
            lastName: 'Scott',
            organizationName: 'Dunder Mifflin',
        ))->execute();
    }

    private function executeService(): void
    {
        Queue::fake();
        Carbon::setTestNow(Carbon::create(2018, 1, 1));

        $user = (new CreateAccount(
            email: 'michael.scott@dundermifflin.com',
            password: 'password',
            firstName: 'Michael',
            lastName: 'Scott',
            organizationName: 'Dunder Mifflin',
        ))->execute();

        $this->assertDatabaseHas('organizations', [
            'name' => 'Dunder Mifflin',
            'slug' => 'dunder-mifflin',
        ]);

        $this->assertDatabaseHas('users', [
            'id' => $user->id,
            'email' => 'michael.scott@dundermifflin.com',
            'first_name' => 'Michael',
            'last_name' => 'Scott',
        ]);

        $this->assertInstanceOf(
            User::class,
            $user,
        );
    }
}

<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Jobs\LogUserAction;
use App\Jobs\UpdateUserLastActivityDate;
use App\Models\User;
use App\Services\UpdateAccountInformation;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateAccountInformationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_updates_account_information(): void
    {
        Queue::fake();

        $user = User::factory()->create();

        $updatedUser = (new UpdateAccountInformation(
            user: $user,
            name: 'Dunder Mifflin Paper Company',
        ))->execute();

        $this->assertDatabaseHas('accounts', [
            'id' => $updatedUser->account->id,
            'name' => 'Dunder Mifflin Paper Company',
        ]);

        $this->assertInstanceOf(
            User::class,
            $updatedUser
        );

        Queue::assertPushed(UpdateUserLastActivityDate::class, function (UpdateUserLastActivityDate $job) use ($user): bool {
            return $job->user->id === $user->id;
        });

        Queue::assertPushed(LogUserAction::class, function (LogUserAction $job) use ($user): bool {
            return $job->action === 'account_update'
                && $job->user->id === $user->id
                && $job->description === 'Updated their organization account';
        });
    }
}

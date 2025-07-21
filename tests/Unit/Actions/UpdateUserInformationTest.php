<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Jobs\LogUserAction;
use App\Jobs\UpdateUserLastActivityDate;
use App\Models\User;
use App\Actions\UpdateUserInformation;
use Carbon\Carbon;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Queue;
use InvalidArgumentException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateUserInformationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_updates_user_information(): void
    {
        Queue::fake();

        $user = User::factory()->create([
            'first_name' => 'Ross',
            'last_name' => 'Geller',
            'email' => 'ross.geller@friends.com',
        ]);

        $this->executeService($user);

        Queue::assertPushedOn(
            queue: 'low',
            job: LogUserAction::class,
            callback: function (LogUserAction $job) use ($user): bool {
                return $job->action === 'personal_profile_update' && $job->user->id === $user->id;
            },
        );
    }

    #[Test]
    public function it_triggers_email_verification_when_email_changes(): void
    {
        Event::fake();

        $user = User::factory()->create([
            'email' => 'ross.geller@friends.com',
            'email_verified_at' => now(),
        ]);

        $this->executeService($user, 'monica.geller@friends.com');

        Event::assertDispatched(Registered::class);
        $this->assertNull($user->refresh()->email_verified_at);
    }

    #[Test]
    public function it_does_not_trigger_email_verification_when_email_stays_same(): void
    {
        Event::fake();

        $user = User::factory()->create([
            'email' => 'ross.geller@friends.com',
            'email_verified_at' => now(),
        ]);

        $this->executeService($user, 'ross.geller@friends.com');

        Event::assertNotDispatched(Registered::class);
        $this->assertNotNull($user->refresh()->email_verified_at);
    }

    private function executeService(User $user, string $email = 'dwight@dundermifflin.com'): void
    {
        $updatedUser = (new UpdateUserInformation(
            user: $user,
            email: $email,
            firstName: 'Ross',
            lastName: 'Geller',
            nickname: 'Ross',
            locale: 'fr',
        ))->execute();

        $this->assertDatabaseHas('users', [
            'id' => $updatedUser->id,
            'email' => $email,
            'first_name' => 'Ross',
            'last_name' => 'Geller',
            'nickname' => 'Ross',
            'locale' => 'fr',
        ]);

        $this->assertInstanceOf(
            User::class,
            $updatedUser,
        );
    }
}

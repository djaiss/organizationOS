<?php

declare(strict_types=1);

namespace Tests\Unit\Services;

use App\Enums\Permission;
use App\Exceptions\PermissionException;
use App\Jobs\LogUserAction;
use App\Jobs\UpdateUserLastActivityDate;
use App\Models\Office;
use App\Models\User;
use App\Services\UpdateOffice;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class UpdateOfficeTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_updates_an_office(): void
    {
        Queue::fake();

        $user = User::factory()->create([
            'permission' => Permission::ADMINISTRATOR->value,
        ]);

        $office = Office::factory()->create([
            'account_id' => $user->account_id,
            'name' => 'Scranton Branch',
        ]);

        $updatedOffice = (new UpdateOffice(
            user: $user,
            office: $office,
            name: 'Stamford Branch',
        ))->execute();

        $this->assertDatabaseHas('offices', [
            'id' => $office->id,
            'account_id' => $user->account_id,
            'name' => 'Stamford Branch',
        ]);

        $this->assertInstanceOf(
            Office::class,
            $updatedOffice
        );

        Queue::assertPushed(UpdateUserLastActivityDate::class, function (UpdateUserLastActivityDate $job) use ($user): bool {
            return $job->user->id === $user->id;
        });

        Queue::assertPushed(LogUserAction::class, function (LogUserAction $job) use ($user): bool {
            return $job->action === 'office_update'
                && $job->user->id === $user->id
                && $job->description === 'Updated the office called Stamford Branch';
        });
    }

    #[Test]
    public function hr_representative_cannot_update_an_office(): void
    {
        Queue::fake();

        $user = User::factory()->create([
            'permission' => Permission::HR->value,
        ]);

        $office = Office::factory()->create([
            'account_id' => $user->account_id,
        ]);

        $this->expectException(PermissionException::class);

        (new UpdateOffice(
            user: $user,
            office: $office,
            name: 'Stamford Branch',
        ))->execute();
    }

    #[Test]
    public function regular_member_cannot_update_an_office(): void
    {
        $user = User::factory()->create([
            'permission' => Permission::MEMBER->value,
        ]);

        $office = Office::factory()->create([
            'account_id' => $user->account_id,
        ]);

        $this->expectException(PermissionException::class);

        (new UpdateOffice(
            user: $user,
            office: $office,
            name: 'Stamford Branch',
        ))->execute();
    }
}

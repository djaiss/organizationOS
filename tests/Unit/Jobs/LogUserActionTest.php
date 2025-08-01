<?php

declare(strict_types=1);

namespace Tests\Unit\Jobs;

use App\Jobs\LogUserAction;
use App\Models\Log;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class LogUserActionTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_logs_user_action(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Ross',
            'last_name' => 'Geller',
            'nickname' => null,
        ]);
        LogUserAction::dispatch(
            organization: null,
            user: $user,
            action: 'personal_profile_update',
            description: 'Updated their personal profile',
        );

        $log = Log::first();

        $this->assertEquals('Ross Geller', $log->getUserName());
        $this->assertEquals('personal_profile_update', $log->action);
        $this->assertEquals('Updated their personal profile', $log->description);
    }
}

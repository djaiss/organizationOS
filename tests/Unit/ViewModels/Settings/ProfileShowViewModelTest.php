<?php

declare(strict_types=1);

namespace Tests\Unit\ViewModels\Settings;

use App\Http\ViewModels\Settings\ProfileShowViewModel;
use App\Models\EmailSent;
use App\Models\Log;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProfileShowViewModelTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_tells_the_user_if_they_have_more_logs(): void
    {
        $user = User::factory()->create([
            'first_name' => 'Ross',
            'last_name' => 'Geller',
        ]);

        Log::factory()->count(6)->create([
            'user_id' => $user->id,
        ]);

        $viewModel = (new ProfileShowViewModel(
            user: $user,
        ));

        $this->assertTrue($viewModel->hasMoreLogs());
    }

    #[Test]
    public function it_gets_the_latest_logs(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));

        $user = User::factory()->create([
            'first_name' => 'Michael',
            'last_name' => 'Scott',
            'nickname' => null,
        ]);

        Log::factory()->create([
            'user_id' => $user->id,
            'action' => 'profile_update',
            'description' => 'Updated their profile',
        ]);

        $viewModel = (new ProfileShowViewModel(
            user: $user,
        ));

        $this->assertCount(1, $viewModel->logs());
        $this->assertEquals(
            [
                'username' => 'Michael Scott',
                'action' => 'profile_update',
                'description' => 'Updated their profile',
                'created_at' => '2018-01-01 00:00:00',
                'created_at_diff_for_humans' => '0 seconds ago',
            ],
            (array) $viewModel->logs()->first(),
        );
    }

    #[Test]
    public function it_gets_the_latest_emails_sent(): void
    {
        Carbon::setTestNow(Carbon::create(2018, 1, 1));

        $user = User::factory()->create([
            'first_name' => 'Michael',
            'last_name' => 'Scott',
            'nickname' => null,
        ]);

        EmailSent::factory()->create([
            'user_id' => $user->id,
            'email_type' => 'welcome',
            'email_address' => 'michael.scott@dundermifflin.com',
            'subject' => 'Welcome to our platform',
            'body' => 'Thank you for joining us!',
            'sent_at' => Carbon::now(),
            'delivered_at' => null,
            'bounced_at' => null,
        ]);

        $viewModel = (new ProfileShowViewModel(
            user: $user,
        ));

        $this->assertCount(1, $viewModel->emailsSent());
        $this->assertEquals(
            [
                'email_type' => 'welcome',
                'email_address' => 'michael.scott@dundermifflin.com',
                'subject' => 'Welcome to our platform',
                'body' => 'Thank you for joining us!',
                'sent_at' => '0 seconds ago',
                'delivered_at' => null,
                'bounced_at' => null,
            ],
            (array) $viewModel->emailsSent()->first(),
        );
    }
}

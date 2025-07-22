<?php

declare(strict_types=1);

namespace Tests\Unit\Jobs;

use App\Enums\EmailType;
use App\Jobs\SendFailedLoginEmail;
use App\Mail\LoginFailed;
use App\Models\EmailSent;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class SendFailedLoginEmailTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_sends_an_email_to_the_user_if_there_is_a_failed_login(): void
    {
        Config::set('app.name', 'OrganizationOS');
        Mail::fake();

        User::factory()->create([
            'email' => 'michael.scott@dundermifflin.com',
        ]);

        SendFailedLoginEmail::dispatch('michael.scott@dundermifflin.com');

        Mail::assertQueued(LoginFailed::class, function (LoginFailed $mail): bool {
            return $mail->hasTo('michael.scott@dundermifflin.com') &&
                $mail->queue === 'high';
        });

        $emailSent = EmailSent::latest()->first();
        $this->assertEquals(EmailType::LOGIN_FAILED->value, $emailSent->email_type);
        $this->assertEquals('michael.scott@dundermifflin.com', $emailSent->email_address);
        $this->assertEquals('Login attempt on OrganizationOS', $emailSent->subject);
    }

    #[Test]
    public function it_does_not_send_an_email_if_the_user_does_not_exist(): void
    {
        Mail::fake();

        SendFailedLoginEmail::dispatch('michael.scott@dundermifflin.com');

        Mail::assertNotQueued(LoginFailed::class);
    }
}

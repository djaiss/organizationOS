<?php

declare(strict_types=1);
use App\Enums\EmailType;
use App\Jobs\SendFailedLoginEmail;
use App\Mail\LoginFailed;
use App\Models\EmailSent;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

it('sends an email to the user if there is a failed login', function (): void {
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
    expect($emailSent->email_type)->toEqual(EmailType::LOGIN_FAILED->value);
    expect($emailSent->email_address)->toEqual('michael.scott@dundermifflin.com');
    expect($emailSent->subject)->toEqual('Login attempt on OrganizationOS');
});

it('does not send an email if the user does not exist', function (): void {
    Mail::fake();

    SendFailedLoginEmail::dispatch('michael.scott@dundermifflin.com');

    Mail::assertNotQueued(LoginFailed::class);
});

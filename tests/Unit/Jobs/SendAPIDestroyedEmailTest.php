<?php

declare(strict_types=1);

use App\Enums\EmailType;
use App\Jobs\SendAPIDestroyedEmail;
use App\Mail\ApiKeyDestroyed;
use App\Models\EmailSent;
use App\Models\User;
use Illuminate\Support\Facades\Mail;

it('sends an email to the user if the api is destroyed', function (): void {
    Mail::fake();

    User::factory()->create([
        'email' => 'michael.scott@dundermifflin.com',
    ]);

    SendAPIDestroyedEmail::dispatch(
        email: 'michael.scott@dundermifflin.com',
        label: 'API Key',
    );

    Mail::assertQueued(ApiKeyDestroyed::class, function (ApiKeyDestroyed $mail): bool {
        return $mail->hasTo('michael.scott@dundermifflin.com') &&
            $mail->queue === 'high';
    });

    $emailSent = EmailSent::latest()->first();

    expect($emailSent->email_type)->toBe(EmailType::API_DESTROYED->value);
    expect($emailSent->email_address)->toBe('michael.scott@dundermifflin.com');
    expect($emailSent->subject)->toBe('API key removed');
});

it('does not send an email if the user does not exist', function (): void {
    Mail::fake();

    SendAPIDestroyedEmail::dispatch(
        email: 'michael.scott@dundermifflin.com',
        label: 'API Key',
    );

    Mail::assertNotQueued(ApiKeyDestroyed::class);
});

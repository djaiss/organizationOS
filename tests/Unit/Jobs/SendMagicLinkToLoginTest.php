<?php

declare(strict_types=1);

use App\Enums\EmailType;
use App\Jobs\SendMagicLinkToLogin;
use App\Mail\MagicLinkCreated;
use App\Models\EmailSent;
use App\Models\User;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;

it('sends a link to login', function (): void {
    Config::set('app.name', 'OrganizationOS');
    Mail::fake();

    User::factory()->create([
        'email' => 'michael.scott@dundermifflin.com',
    ]);

    SendMagicLinkToLogin::dispatch(
        email: 'michael.scott@dundermifflin.com',
        url: 'https://example.com/magiclink/abc123',
    );

    Mail::assertQueued(MagicLinkCreated::class, function (MagicLinkCreated $mail): bool {
        return $mail->hasTo('michael.scott@dundermifflin.com') &&
            $mail->link === 'https://example.com/magiclink/abc123' &&
            $mail->queue === 'high';
    });

    $emailSent = EmailSent::latest()->first();
    expect($emailSent->email_type)->toEqual(EmailType::MAGIC_LINK_CREATED->value);
    expect($emailSent->email_address)->toEqual('michael.scott@dundermifflin.com');
    expect($emailSent->subject)->toEqual('Login to OrganizationOS');
});

it('does not send an email if the user does not exist', function (): void {
    Mail::fake();

    SendMagicLinkToLogin::dispatch(
        email: 'michael.scott@dundermifflin.com',
        url: 'https://example.com/magiclink/abc123',
    );

    Mail::assertNotQueued(MagicLinkCreated::class);
});

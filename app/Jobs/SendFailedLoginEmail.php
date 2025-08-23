<?php

declare(strict_types=1);

namespace App\Jobs;

use App\Actions\CreateEmailSent;
use App\Enums\EmailType;
use App\Mail\LoginFailed;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Mail;

final class SendFailedLoginEmail implements ShouldQueue
{
    use Queueable;

    private bool $valid = true;

    private User $user;

    public function __construct(
        public string $email
    ) {}

    /**
     * Send an email to the user when someone (hopefully not malicious) tries
     * to login to their account but fails.
     */
    public function handle(): void
    {
        $this->validate();

        if ($this->valid) {
            $this->send();
            $this->recordEmailSent();
        }
    }

    private function validate(): void
    {
        try {
            $this->user = User::where('email', $this->email)->firstOrFail();
        } catch (ModelNotFoundException) {
            $this->valid = false;
        }
    }

    private function send(): void
    {
        $message = new LoginFailed()->onQueue('high');

        Mail::to($this->email)
            ->queue($message);
    }

    private function recordEmailSent(): void
    {
        new CreateEmailSent(
            organization: null,
            user: $this->user,
            emailType: EmailType::LOGIN_FAILED->value,
            emailAddress: $this->user->email,
            subject: 'Login attempt on ' . config('app.name'),
            body: new LoginFailed()->render(),
        )->execute();
    }
}

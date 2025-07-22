<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Models\EmailSent;
use App\Models\User;
use App\Actions\CreateEmailSent;
use App\Models\Organization;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Queue;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateEmailSentTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_creates_an_email_sent(): void
    {
        Queue::fake();

        $user = User::factory()->create();

        $emailSent = (new CreateEmailSent(
            user: $user,
            organization: null,
            emailType: 'birthday_wishes',
            emailAddress: 'dwight.schrute@dundermifflin.com',
            subject: 'Happy Birthday!',
            body: 'Hope you have a great day!',
        ))->execute();

        $this->assertDatabaseHas('emails_sent', [
            'id' => $emailSent->id,
            'organization_id' => null,
            'user_id' => $user->id,
            'uuid' => $emailSent->uuid,
            'email_type' => 'birthday_wishes',
            'email_address' => 'dwight.schrute@dundermifflin.com',
            'subject' => 'Happy Birthday!',
            'body' => 'Hope you have a great day!',
        ]);

        $this->assertEquals(36, mb_strlen($emailSent->uuid));

        $this->assertInstanceOf(
            EmailSent::class,
            $emailSent,
        );
    }

    #[Test]
    public function it_sanitizes_the_body_and_strips_any_links(): void
    {
        Queue::fake();

        $user = User::factory()->create();

        $emailSent = (new CreateEmailSent(
            user: $user,
            organization: null,
            emailType: 'birthday_wishes',
            emailAddress: 'dwight.schrute@dundermifflin.com',
            subject: 'Happy Birthday!',
            body: 'Hope you <a href="https://example.com">have a great day!</a>',
        ))->execute();

        $this->assertDatabaseHas('emails_sent', [
            'id' => $emailSent->id,
            'body' => 'Hope you have a great day!',
        ]);
    }

    #[Test]
    public function it_fails_if_user_doesnt_belong_to_organization(): void
    {
        $this->expectException(ModelNotFoundException::class);

        $user = User::factory()->create();
        $organization = Organization::factory()->create();

        (new CreateEmailSent(
            user: $user,
            organization: $organization,
            emailType: 'birthday_wishes',
            emailAddress: 'monica.geller@friends.com',
            subject: 'Happy Birthday!',
            body: 'Hope you have a great day!',
        ))->execute();
    }
}

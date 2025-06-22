<?php

namespace Tests\Browser\Tests\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class SendMagicLinkTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[Test]
    public function it_can_send_magic_link(): void
    {
        $user = User::factory()->create([
            'email' => 'michael.scott@dundermifflin.com',
        ]);

        $this->browse(function (Browser $browser) use ($user) {
            $browser->visit('/login')
                ->press('@magic-link-link')
                ->type('email', $user->email)
                ->press('@magic-link-button')
                ->assertPathIs('/send-magic-link');
        });
    }
}

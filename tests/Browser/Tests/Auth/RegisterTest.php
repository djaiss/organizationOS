<?php

declare(strict_types=1);

namespace Tests\Browser\Tests\Auth;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class RegisterTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[Test]
    public function it_can_create_a_new_account(): void
    {
        $this->browse(function (Browser $browser): void {
            $browser->visit('/register')
                ->type('first_name', 'Michael')
                ->type('last_name', 'Scott')
                ->type('email', 'michael.scott@dundermifflin.com')
                ->type('password', 'v@pfzY*9s')
                ->type('password_confirmation', 'v@pfzY*9s')
                ->press('@register-button')
                ->waitForLocation('/verify-email')
                ->assertPathIs('/verify-email');
        });
    }
}

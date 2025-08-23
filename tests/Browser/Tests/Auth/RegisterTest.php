<?php

declare(strict_types=1);
uses(Tests\DuskTestCase::class);
use Laravel\Dusk\Browser;

uses(Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can create a new account', function (): void {
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
});

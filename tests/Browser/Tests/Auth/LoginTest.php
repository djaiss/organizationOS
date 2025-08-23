<?php

declare(strict_types=1);
uses(Tests\DuskTestCase::class);
use App\Models\User;
use Laravel\Dusk\Browser;

uses(Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can login with password', function (): void {
    $user = User::factory()->create([
        'email' => 'michael.scott@dundermifflin.com',
    ]);

    $this->browse(function (Browser $browser) use ($user): void {
        $browser->visit('/login')
            ->type('email', $user->email)
            ->type('password', 'password')
            ->press('@login-button')
            ->assertPathIs('/organizations');
    });
});

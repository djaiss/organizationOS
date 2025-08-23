<?php

declare(strict_types=1);
uses(Tests\DuskTestCase::class);
use App\Models\User;
use Laravel\Dusk\Browser;

uses(Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can send magic link', function (): void {
    $user = User::factory()->create([
        'email' => 'michael.scott@dundermifflin.com',
    ]);

    $this->browse(function (Browser $browser) use ($user): void {
        $browser->visit('/login')
            ->press('@magic-link-link')
            ->type('email', $user->email)
            ->press('@magic-link-button')
            ->assertPathIs('/send-magic-link');
    });
});

<?php

declare(strict_types=1);
uses(Tests\DuskTestCase::class);
use App\Models\User;
use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Settings\ProfilePage;

uses(Illuminate\Foundation\Testing\DatabaseMigrations::class);

it('can change password', function (): void {
    $user = User::factory()->create([
        'email' => 'michael.scott@dundermifflin.com',
    ]);

    $this->browse(function (Browser $browser) use ($user): void {
        $browser->loginAs($user)
            ->visit('/settings/security')
            ->type('current_password', 'password')
            ->type('new_password', 'MSw&w%@qt')
            ->type('new_password_confirmation', 'MSw&w%@qt')
            ->press('@change-password-button')
            ->assertPathIs('/settings/security');

        $browser->pause(500);

        $browser->visit(new ProfilePage)
            ->assertLogContains('update_user_password');
    });
});

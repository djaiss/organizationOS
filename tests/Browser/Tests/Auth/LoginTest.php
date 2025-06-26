<?php

declare(strict_types=1);

namespace Tests\Browser\Tests\Auth;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use PHPUnit\Framework\Attributes\Test;

class LoginTest extends DuskTestCase
{
    use DatabaseMigrations;

    #[Test]
    public function it_can_login_with_password(): void
    {
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
    }
}

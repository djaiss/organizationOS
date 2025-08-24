<?php

declare(strict_types=1);
uses(Tests\DuskTestCase::class);
use Laravel\Dusk\Browser;

test('basic example', function (): void {
    $this->browse(function (Browser $browser): void {
        $browser->visit('/')
            ->assertSee('test');
    });
});

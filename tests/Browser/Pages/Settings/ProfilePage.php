<?php

declare(strict_types=1);

namespace Tests\Browser\Pages\Settings;

use Laravel\Dusk\Browser;
use Tests\Browser\Pages\Page;

final class ProfilePage extends Page
{
    /**
     * Get the URL for the page.
     */
    public function url(): string
    {
        return '/settings/profile';
    }

    /**
     * Assert that the browser is on the page.
     */
    public function assert(Browser $browser): void
    {
        $browser->assertPathIs($this->url());
    }

    /**
     * Assert that a specific log action is visible.
     */
    public function assertLogContains(Browser $browser, string $action): self
    {
        $browser->with('@logs-box', function (Browser $logsSection) use ($action): void {
            $logsSection->assertSee($action);
        });

        return $this;
    }
}

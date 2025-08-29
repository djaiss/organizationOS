<?php

declare(strict_types=1);


it('can render the profile documentation', function (): void {
    $response = $this->get('/docs/api/profile');

    $response->assertOk();
});

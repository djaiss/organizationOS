<?php

declare(strict_types=1);


it('can render the api management documentation', function (): void {
    $response = $this->get('/docs/api/management');

    $response->assertOk();
});

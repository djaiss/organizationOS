<?php

declare(strict_types=1);


it('can render the api management documentation', function (): void {
    $response = $this->get('/docs/api/api-management');

    $response->assertOk();
});

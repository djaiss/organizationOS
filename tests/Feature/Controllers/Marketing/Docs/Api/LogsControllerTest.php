<?php

declare(strict_types=1);


it('can render the logs documentation', function (): void {
    $response = $this->get('/docs/api/logs');

    $response->assertOk();
});

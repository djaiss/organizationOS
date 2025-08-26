<?php

declare(strict_types=1);


it('can render the authentication documentation', function (): void {
    $response = $this->get('/docs/api/authentication');

    $response->assertOk();
});

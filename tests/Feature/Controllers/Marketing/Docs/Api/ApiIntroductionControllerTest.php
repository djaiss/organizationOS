<?php

declare(strict_types=1);


it('can render the api introduction documentation', function (): void {
    $response = $this->get('/docs/api');

    $response->assertOk();
});

<?php

declare(strict_types=1);


it('can render the introduction documentation', function (): void {
    $response = $this->get('/docs');

    $response->assertOk();
});

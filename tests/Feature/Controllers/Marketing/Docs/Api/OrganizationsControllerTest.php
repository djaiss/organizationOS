<?php

declare(strict_types=1);


it('shows the organizations documentation', function (): void {
    $response = $this->get('/docs/api/organizations');

    $response->assertOk();
});

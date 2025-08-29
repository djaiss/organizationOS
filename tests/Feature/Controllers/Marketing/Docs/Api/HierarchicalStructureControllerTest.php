<?php

declare(strict_types=1);


it('can render the hierarchical structure documentation', function (): void {
    $response = $this->get('/docs/concepts/hierarchical-structure');

    $response->assertOk();
});

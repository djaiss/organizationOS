<?php

namespace Tests\Unit\Traits;

use App\Models\Permission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TranslatableTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_translates(): void
    {
        $permission = Permission::factory()->create([
            'label' => 'this is the real name',
            'label_translation_key' => 'permission.label',
        ]);

        $this->assertEquals(
            'this is the real name',
            $permission->label
        );

        $permission = Permission::factory()->create([
            'label' => null,
            'label_translation_key' => 'permission.label',
        ]);

        $this->assertEquals(
            'permission.label',
            $permission->label
        );
    }
}

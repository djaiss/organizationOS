<?php

namespace Tests\Unit\Models;

use App\Models\Action;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PermissionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_has_multiple_users(): void
    {
        $permission = Permission::factory()->create();

        $this->assertTrue($permission->organization()->exists());
    }

    /** @test */
    public function it_has_many_persmissions(): void
    {
        $permission = Permission::factory()->create();
        $action = Action::factory()->create();
        $permission->actions()->attach($action);

        $this->assertTrue($permission->actions()->exists());
    }
}

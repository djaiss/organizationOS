<?php

namespace Tests\Unit\Models;

use App\Models\Action;
use App\Models\Permission;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_belongs_to_many_permissions(): void
    {
        $action = Action::factory()->create();
        $permission = Permission::factory()->create();
        $action->permissions()->attach($permission);

        $this->assertTrue($action->permissions()->exists());
    }
}

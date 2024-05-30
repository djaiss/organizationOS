<?php

namespace Tests\Unit\ViewModels\Organization\Adminland;

use App\Http\ViewModels\Organization\Adminland\AdminlandPermissionViewModel;
use App\Http\ViewModels\Profile\ApiAccessViewModel;
use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class AdminlandPermissionViewModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gets_all_the_data_needed_for_the_index_view(): void
    {
        $organization = Organization::factory()->create();
        $permission = Permission::factory()->create([
            'organization_id' => $organization->id,
        ]);
        $action = Action::factory()->create([
            'identifier' => Action::MANAGE_PERMISSIONS,
            'label_translation_key' => 'Test Action',
            'description_translation_key' => 'Test Description',
        ]);
        $permission->actions()->attach($action);
        $user = User::factory()->create();
        $organization->users()->syncWithoutDetaching([
            $user->id => ['permission_id' => $permission->id],
        ]);

        $array = AdminlandPermissionViewModel::index($organization);

        $this->assertIsArray($array);
        $this->assertArrayHasKey('organization', $array);
        $this->assertArrayHasKey('permissions', $array);
        $this->assertArrayHasKey('url', $array);

        $this->assertEquals(
            [
                'id' => $organization->id,
                'name' => $organization->name,
            ],
            $array['organization']
        );

        $this->assertEquals(
            [
                'id' => $action->id,
                'label' => 'Test Action',
                'description' => 'Test Description',
            ],
            $array['permissions']->toArray()[0]['actions']->toArray()[0]
        );

        $this->assertEquals(
            [
                'sidebar_menu' => config('app.url') . '/organizations/' . $organization->id . '/adminland/permissions',
            ],
            $array['url']
        );
    }
}

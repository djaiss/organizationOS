<?php

namespace Tests\Unit\ViewModels\Organization;

use App\Http\ViewModels\Organization\AdminlandViewModel;
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

class AdminlandViewModelTest extends TestCase
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

        $array = AdminlandViewModel::index($organization);

        $this->assertIsArray($array);
        $this->assertArrayHasKey('organization', $array);
        $this->assertArrayHasKey('permissions', $array);

        $this->assertEquals(
            [
                'id' => $action->id,
                'label' => 'Test Action',
                'description' => 'Test Description',
            ],
            $array['permissions']->toArray()[0]['actions']->toArray()[0]
        );
    }
}

<?php

namespace Tests\Unit\ViewModels;

use App\Http\ViewModels\DashboardViewModel;
use App\Models\Organization;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DashboardViewModelTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_gets_all_the_organizations_the_user_is_part_of(): void
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $organization = Organization::factory()->create([
            'name' => 'Dunder Mifflin',
        ]);
        $organization->users()->attach($user->id);

        $array = DashboardViewModel::index();

        $this->assertIsArray($array);
        $this->assertArrayHasKey('organizations', $array);

        $this->assertEquals(
            [
                'id' => $organization->id,
                'name' => 'Dunder Mifflin',
                'url' => [
                    'show' => env('APP_URL').'/organizations/'.$organization->id,
                ],
            ],
            $array['organizations']->toArray()[0]
        );
    }
}

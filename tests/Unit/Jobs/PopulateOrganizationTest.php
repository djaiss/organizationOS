<?php

namespace Tests\Unit\Jobs;

use App\Jobs\PopulateOrganization;
use App\Models\Organization;
use App\Models\Permission;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class PopulateOrganizationTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_populates_an_organization(): void
    {
        $organization = Organization::factory()->create();

        Permission::factory()->create([
            'organization_id' => $organization->id,
            'label_translation_key' => 'Administrator',
        ]);

        PopulateOrganization::dispatch($organization);

        $this->assertEquals(
            1,
            DB::table('actions')->count()
        );
    }
}

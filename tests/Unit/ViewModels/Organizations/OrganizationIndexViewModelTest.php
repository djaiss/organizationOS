<?php

declare(strict_types=1);

namespace Tests\Unit\ViewModels\Organizations;

use App\Http\ViewModels\Organizations\OrganizationIndexViewModel;
use App\Models\User;
use App\Models\Organization;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class OrganizationIndexViewModelTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_returns_the_correct_organizations(): void
    {
        $user = User::factory()->create();
        $organization1 = Organization::factory()->create([
            'name' => 'Dunder Mifflin',
            'slug' => 'dunder-mifflin',
        ]);
        $organization2 = Organization::factory()->create([
            'name' => 'Dunder Mifflin Paper Company',
            'slug' => 'dunder-mifflin-paper-company',
        ]);

        $user->organizations()->attach($organization1->id, [
            'joined_at' => now(),
        ]);
        $user->organizations()->attach($organization2->id, [
            'joined_at' => now(),
        ]);

        $viewModel = new OrganizationIndexViewModel(
            user: $user,
        );

        $organizations = $viewModel->organizations();

        $this->assertCount(2, $organizations);

        $firstOrganization = $organizations->first();
        $this->assertTrue(property_exists($firstOrganization, 'id'));
        $this->assertTrue(property_exists($firstOrganization, 'name'));
        $this->assertTrue(property_exists($firstOrganization, 'slug'));

        $this->assertEquals($organization1->id, $firstOrganization->id);
        $this->assertEquals($organization1->name, 'Dunder Mifflin');
        $this->assertEquals($organization1->slug, 'dunder-mifflin');
    }
}

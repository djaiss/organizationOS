<?php

declare(strict_types=1);

namespace Tests\Unit\Actions;

use App\Actions\CreateOrganization;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Validation\ValidationException;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CreateOrganizationTest extends TestCase
{
    use DatabaseTransactions;

    #[Test]
    public function it_creates_an_organization(): void
    {
        $this->executeService();
    }

    #[Test]
    public function it_throws_an_exception_if_user_not_found(): void
    {
        $this->expectException(ModelNotFoundException::class);

        (new CreateOrganization(
            userId: 999,
            organizationName: 'Dunder Mifflin',
        ))->execute();
    }

    #[Test]
    public function it_throws_an_exception_if_organization_name_is_already_taken(): void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();

        Organization::factory()->create([
            'name' => 'Dunder Mifflin',
        ]);

        (new CreateOrganization(
            userId: $user->id,
            organizationName: 'Dunder Mifflin',
        ))->execute();
    }

    #[Test]
    public function it_throws_an_exception_if_organization_name_contains_special_characters(): void
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create();

        (new CreateOrganization(
            userId: $user->id,
            organizationName: 'Dunder@ / Mifflin!',
        ))->execute();
    }

    private function executeService(): void
    {
        Carbon::setTestNow(Carbon::parse('2025-03-17 10:00:00'));

        $user = User::factory()->create();

        $organization = (new CreateOrganization(
            userId: $user->id,
            organizationName: 'Dunder Mifflin',
        ))->execute();

        $this->assertDatabaseHas('organizations', [
            'id' => $organization->id,
            'name' => 'Dunder Mifflin',
            'slug' => 'dunder-mifflin',
        ]);

        $this->assertDatabaseHas('organization_user', [
            'organization_id' => $organization->id,
            'user_id' => $user->id,
            'joined_at' => '2025-03-17 10:00:00',
        ]);

        $this->assertInstanceOf(
            Organization::class,
            $organization,
        );
    }
}

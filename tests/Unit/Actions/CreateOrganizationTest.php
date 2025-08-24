<?php

declare(strict_types=1);

use App\Actions\CreateOrganization;
use App\Models\Organization;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Validation\ValidationException;

it('creates an organization', function (): void {
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

    expect($organization)->toBeInstanceOf(Organization::class);
});

it('throws an exception if user not found', function (): void {
    $this->expectException(ModelNotFoundException::class);

    (new CreateOrganization(
        userId: 999,
        organizationName: 'Dunder Mifflin',
    ))->execute();
});

it('throws an exception if organization name is already taken', function (): void {
    $this->expectException(ValidationException::class);

    $user = User::factory()->create();

    Organization::factory()->create([
        'name' => 'Dunder Mifflin',
    ]);

    (new CreateOrganization(
        userId: $user->id,
        organizationName: 'Dunder Mifflin',
    ))->execute();
});

it('throws an exception if organization name contains special characters', function (): void {
    $this->expectException(ValidationException::class);

    $user = User::factory()->create();

    (new CreateOrganization(
        userId: $user->id,
        organizationName: 'Dunder@ / Mifflin!',
    ))->execute();
});

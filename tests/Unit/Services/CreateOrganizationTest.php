<?php

use App\Jobs\PopulateAccount;
use App\Models\Organization;
use App\Models\User;
use App\Services\CreateOrganization;
use Illuminate\Support\Facades\Queue;

test('it creates an organization', function () {
    Queue::fake();
    $user = User::factory()->create();
    $this->be($user);

    $organization = (new CreateOrganization(
        name: 'Dunder Mifflin',
    ))->execute();

    expect($organization)->toBeInstanceOf(Organization::class);

    $this->assertDatabaseHas('organizations', [
        'id' => $organization->id,
        'name' => 'Dunder Mifflin',
    ]);

    $this->assertDatabaseHas('permissions', [
        'organization_id' => $organization->id,
        'label_translation_key' => 'Administrator',
    ]);

    $this->assertDatabaseHas('organization_user', [
        'organization_id' => $organization->id,
        'user_id' => $user->id,
    ]);

    Queue::assertPushed(PopulateAccount::class);
});

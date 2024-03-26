<?php

use App\Http\ViewModels\DashboardViewHelper;
use App\Models\Organization;
use App\Models\User;

test('it gets all the organizations the user is part of', function () {
    $user = User::factory()->create();
    $this->actingAs($user);

    $organization = Organization::factory()->create([
        'name' => 'Dunder Mifflin',
    ]);
    $organization->users()->attach($user->id);

    $array = DashboardViewHelper::index();

    expect($array)->toBeArray();
    $this->assertArrayHasKey('organizations', $array);

    expect($array['organizations']->toArray()[0])->toBe([
        'id' => $organization->id,
        'name' => 'Dunder Mifflin',
        'url' => [
            'show' => env('APP_URL').'/organizations/'.$organization->id,
        ],
    ]);
});

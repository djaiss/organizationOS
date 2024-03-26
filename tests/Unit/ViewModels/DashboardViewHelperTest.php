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


});

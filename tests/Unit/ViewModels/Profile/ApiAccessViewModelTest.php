<?php

use App\Http\ViewModels\Profile\ApiAccessViewModel;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

test('it gets all the tokens needed for the index view', function () {
    Carbon::setTestNow(Carbon::create(2018, 1, 1));
    $user = User::factory()->create();
    $this->actingAs($user);

    $token = DB::table('personal_access_tokens')->insertGetId([
        'tokenable_type' => User::class,
        'tokenable_id' => $user->id,
        'name' => 'Test Token',
        'token' => 'test',
        'created_at' => Carbon::now(),
        'last_used_at' => Carbon::now(),
    ]);

    $array = ApiAccessViewModel::index();

    expect($array)->toBeArray();
    $this->assertArrayHasKey('tokens', $array);

    expect($array['tokens']->toArray())->toBe([
        [
            'id' => $token,
            'name' => 'Test Token',
            'last_used' => '0 seconds ago',
        ],
    ]);
});

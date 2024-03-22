<?php

use App\Models\User;
use App\Services\CreateAccount;

test('it creates an account', function () {
    $user = (new CreateAccount(
        email: 'dwight@dundermifflin.com',
        password: 'johnny',
        name: 'Dwight Schrute',
    ))->execute();

    expect($user)->toBeInstanceOf(User::class);

    $this->assertDatabaseHas('users', [
        'id' => $user->id,
        'name' => 'Dwight Schrute',
        'email' => 'dwight@dundermifflin.com',
    ]);
});

<?php

namespace Tests\Unit\Models;

use App\Models\Channel;
use App\Models\Organization;
use App\Models\Team;
use App\Models\Topic;
use App\Models\TopicNotification;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class UserTest extends TestCase
{
    use DatabaseTransactions;

    /** @test */
    public function it_belongs_to_an_organization(): void
    {
        $organization = Organization::factory()->create();
        $user = User::factory()->create([
            'organization_id' => $organization->id,
        ]);

        $this->assertTrue($user->organization()->exists());
    }
}

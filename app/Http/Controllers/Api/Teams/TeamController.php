<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api\Teams;

use App\Http\Controllers\Controller;
use App\Http\Resources\TeamResource;
use App\Services\CreateTeam;
use App\Services\UpdateTeam;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Team;

/**
 * @group Teams
 */
class TeamController extends Controller
{
    /**
     * Create a team.
     *
     * A team is a group of users. This should not be used to manage the
     * hierarchy of the company, as hierarchy is handled automatically by
     * the system.
     *
     * @bodyParam name string required The name of the team. Max 255 characters. Example: Web developers
     *
     * @response 200 {
     *  "id": 4,
     *  "object": "team",
     *  "account_id": 1,
     *  "name": "Web developers",
     *  "created_at": "1679090539"
     * }
     *
     * @responseField id The ID of the team.
     * @responseField object The type of the object. Always "team".
     * @responseField account_id The ID of the account.
     * @responseField name The name of the team.
     * @responseField created_at Time at which the object was created. Measured in seconds since the Unix epoch.
     */
    public function store(Request $request): JsonResource
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $team = (new CreateTeam(
            user: $request->user(),
            name: $validated['name'],
        ))->execute();

        return new TeamResource($team);
    }

    /**
     * Update a team.
     *
     * A team can be updated by any user who is part of the team.
     *
     * @bodyParam name string required The name of the team. Max 255 characters. Example: Web developers
     *
     * @response 200 {
     *  "id": 4,
     *  "object": "team",
     *  "account_id": 1,
     *  "name": "Web developers",
     *  "created_at": "1679090539"
     * }
     *
     * @responseField id The ID of the team.
     * @responseField object The type of the object. Always "team".
     * @responseField account_id The ID of the account.
     * @responseField name The name of the team.
     * @responseField created_at Time at which the object was created. Measured in seconds since the Unix epoch.
     */
    public function update(Request $request, Team $team): JsonResource
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ]);

        $team = (new UpdateTeam(
            user: $request->user(),
            team: $team,
            name: $validated['name'],
        ))->execute();

        return new TeamResource($team);
    }
}

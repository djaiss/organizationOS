<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Services\CreateOrganization;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Organization
 *
 * APIs for managing organizations
 */
class OrganizationController extends Controller
{
    /**
     * Create an organization
     *
     * An organization is at the core of the application. It is the entity that
     * groups users together.
     *
     * @bodyParam name string required The name of the organization. Max 255 characters. Example: Dunder Mifflin
     *
     * @response 201 {
     *  "id": 4,
     *  "object": "organization",
     *  "name": "Dunder Mifflin",
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $organization = (new CreateOrganization(
            name: $request->input('name'),
        ))->execute();

        return response()->json([
            'id' => $organization->id,
            'object' => 'organization',
            'name' => $organization->name,
        ], 201);
    }
}

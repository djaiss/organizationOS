<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Services\CreatePermission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Organization
 */
class PermissionController extends Controller
{
    /**
     * Create a permission
     *
     * A permission is a set of actions that a user can perform in an organization.
     *
     * By default, an account comes with a set of permissions that can be assigned to users, like 'Administrator'.
     *
     * @urlParam organization required The id of the organization. Example: 1
     *
     * @bodyParam label string required The name of the permission. Max 255 characters. Example: Administrator
     *
     * @response 201 {
     *  "id": 4,
     *  "object": "permission",
     *  "label": "Administrator",
     * }
     */
    public function store(Request $request): JsonResponse
    {
        $organization = $request->attributes->get('organization');
        $permission = (new CreatePermission(
            organization: $organization,
            label: $request->input('label'),
        ))->execute();

        return response()->json([
            'id' => $permission->id,
            'object' => 'permission',
            'label' => $permission->label,
        ], 201);
    }
}

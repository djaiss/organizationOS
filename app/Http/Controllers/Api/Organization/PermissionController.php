<?php

namespace App\Http\Controllers\Api\Organization;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Services\CreatePermission;
use App\Services\DestroyPermission;
use App\Services\UpdatePermission;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

/**
 * @group Permissions
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
    public function create(Request $request): JsonResponse
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

    /**
     * Update a permission
     *
     * @urlParam organization required The id of the organization. Example: 1
     * @urlParam permission required The id of the permission. Example: 1
     *
     * @bodyParam label string required The name of the permission. Max 255 characters. Example: Administrator
     *
     * @response 200 {
     *  "id": 4,
     *  "object": "permission",
     *  "label": "Administrator",
     * }
     */
    public function update(Request $request, int $organizationId, int $permissionId): JsonResponse
    {
        $organization = $request->attributes->get('organization');

        $permission = Permission::where('organization_id', $organizationId)
            ->findOrFail($permissionId);

        $permission = (new UpdatePermission(
            organization: $organization,
            permission: $permission,
            label: $request->input('label'),
        ))->execute();

        return response()->json([
            'id' => $permission->id,
            'object' => 'permission',
            'label' => $permission->label,
        ], 200);
    }

    /**
     * Delete a permission
     *
     * @urlParam organization required The id of the organization. Example: 1
     * @urlParam permission required The id of the permission. Example: 1
     *
     * @response 200 {
     *  "status": "success",
     * }
     */
    public function destroy(Request $request, int $organizationId, int $permissionId): JsonResponse
    {
        $organization = $request->attributes->get('organization');

        $permission = Permission::where('organization_id', $organizationId)
            ->findOrFail($permissionId);

        (new DestroyPermission(
            organization: $organization,
            permission: $permission,
        ))->execute();

        return response()->json([
            'status' => 'success',
        ], 200);
    }

    /**
     * List all permissions
     *
     * This will list all the permissions in the organization, sorted
     * alphabetically.
     *
     * @urlParam organization required The id of the organization. Example: 1
     *
     * @response 200 [{
     *  "id": 4,
     *  "object": "permission",
     *  "label": "Administrator",
     * }, {
     *  "id": 5,
     *  "object": "permission",
     *  "label": "User",
     * }]
     */
    public function index(Request $request): JsonResponse
    {
        $organization = $request->attributes->get('organization');
        $permissions = $organization->permissions()
            ->orderBy('label')
            ->get()
            ->map(fn (Permission $permission) => [
                'id' => $permission->id,
                'object' => 'permission',
                'label' => $permission->label,
            ]);

        return response()->json($permissions, 200);
    }
}

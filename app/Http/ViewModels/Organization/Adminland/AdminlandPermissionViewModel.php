<?php

namespace App\Http\ViewModels\Organization\Adminland;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;

class AdminlandPermissionViewModel
{
    public static function index(Organization $organization): array
    {
        $permissions = $organization->permissions()
            ->with('actions')
            ->get()
            ->map(fn (Permission $permission) => [
                'id' => $permission->id,
                'label' => $permission->label,
                'actions' => $permission->actions()->get()->map(fn (Action $action) => [
                    'id' => $action->id,
                    'label' => trans($action->label_translation_key),
                    'description' => trans($action->description_translation_key),
                ]),
            ]);

        return [
            'organization' => [
                'id' => $organization->id,
                'name' => $organization->name,
            ],
            'permissions' => $permissions,
        ];
    }
}

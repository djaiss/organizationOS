<?php

namespace App\Http\ViewModels\Organization;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;

class AdminlandViewModel
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
                'url' => [
                    'show' => route('organization.show', $organization),
                ],
            ]);

        return [
            'permissions' => $permissions,
        ];
    }
}

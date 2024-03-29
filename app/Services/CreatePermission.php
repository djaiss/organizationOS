<?php

namespace App\Services;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;

class CreatePermission extends BaseService
{
    private Permission $permission;

    public function __construct(
        public Organization $organization,
        public string $label,
    ) {
    }

    public function permissions(): array
    {
        return [Action::MANAGE_PERMISSIONS];
    }

    public function execute(): Permission
    {
        $this->canExecuteService($this->organization);
        $this->createPermission();

        return $this->permission;
    }

    private function createPermission(): void
    {
        $this->permission = Permission::create([
            'organization_id' => $this->organization->id,
            'label' => $this->label,
        ]);
    }
}

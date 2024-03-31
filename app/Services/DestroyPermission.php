<?php

namespace App\Services;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class DestroyPermission extends BaseService
{
    public function __construct(
        public Organization $organization,
        public Permission $permission,
    ) {
    }

    public function permissions(): array
    {
        return [Action::MANAGE_PERMISSIONS];
    }

    public function execute(): Permission
    {
        $this->validate();
        $this->delete();

        return $this->permission;
    }

    private function validate(): void
    {
        $this->canExecuteService($this->organization);

        if ($this->permission->organization_id !== $this->organization->id) {
            throw new ModelNotFoundException();
        }

        // make sure the user can't delete the permission he is using
        if (auth()->user()->getPermissionInOrganization($this->organization)->id === $this->permission->id) {
            throw new Exception();
        }
    }

    private function delete(): void
    {
        $this->permission->delete();
    }
}

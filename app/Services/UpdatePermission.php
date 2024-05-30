<?php

namespace App\Services;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class UpdatePermission extends BaseService
{
    public function __construct(
        public Organization $organization,
        public Permission $permission,
        public string $label,
    ) {
    }

    public function permissions(): array
    {
        return [Action::MANAGE_PERMISSIONS];
    }

    public function execute(): Permission
    {
        $this->validate();
        $this->update();

        return $this->permission;
    }

    private function validate(): void
    {
        $this->canExecuteService($this->organization);

        if ($this->permission->organization_id !== $this->organization->id) {
            throw new ModelNotFoundException();
        }
    }

    private function update(): void
    {
        $this->permission->label = $this->label;
        $this->permission->save();
    }
}

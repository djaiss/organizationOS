<?php

namespace App\Services;

use App\Exceptions\NotEnoughPermissionException;
use App\Models\Organization;

abstract class BaseService
{
    /**
     * Get the permissions that users need to execute the service.
     *
     * @return array<int, string>
     */
    public function permissions(): array
    {
        return [];
    }

    /**
     * @param  array<string, string>  $data
     */
    public function valueOrNull(array $data, string $index): ?string
    {
        if (empty($data[$index])) {
            return null;
        }

        return $data[$index] == '' ? null : $data[$index];
    }

    /**
     * Checks if the current user executing the service has the permission
     * to do the action.
     */
    public function canExecuteService(Organization $organization): bool
    {
        if (empty($this->permissions())) {
            return true;
        }

        foreach ($this->permissions() as $permission) {
            if (! auth()->user()->hasTheRightTo($permission, $organization)) {
                throw new NotEnoughPermissionException();
            }
        }

        return true;
    }
}

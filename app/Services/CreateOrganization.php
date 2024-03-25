<?php

namespace App\Services;

use App\Models\Organization;

class CreateOrganization extends BaseService
{
    private Organization $organization;

    public function __construct(
        public string $name,
    ) {
    }

    public function execute(): Organization
    {
        $this->createOrganization();
        $this->associateUser();

        return $this->organization;
    }

    private function createOrganization(): void
    {
        $this->organization = Organization::create([
            'name' => $this->name,
        ]);
    }

    private function associateUser(): void
    {
        $this->organization->users()->syncWithoutDetaching([auth()->user()->id]);
    }
}

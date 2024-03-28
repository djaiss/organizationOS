<?php

namespace App\Services;

use App\Jobs\PopulateAccount;
use App\Models\Organization;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;

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
        $this->createPermissions();
        $this->associateUser();
        $this->populate();

        return $this->organization;
    }

    private function createOrganization(): void
    {
        $this->organization = Organization::create([
            'name' => $this->name,
        ]);
    }

    private function createPermissions(): void
    {
        $permissions = [
            trans_key('Administrator'),
            trans_key('Human Resource'),
            trans_key('User'),
        ];

        foreach ($permissions as $permission) {
            DB::table('permissions')->insert([
                'organization_id' => $this->organization->id,
                'label' => null,
                'label_translation_key' => $permission,
                'created_at' => now(),
            ]);
        }
    }

    private function associateUser(): void
    {
        $permission = Permission::where('label_translation_key', 'Administrator')->first();

        $this->organization->users()->syncWithoutDetaching([
            auth()->user()->id => ['permission_id' => $permission->id],
        ]);
    }

    private function populate(): void
    {
        PopulateAccount::dispatch($this->organization);
    }
}

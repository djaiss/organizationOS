<?php

namespace App\Jobs;

use App\Models\Organization;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class PopulateAccount implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Organization $organization)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->addPermissions();
    }

    private function addPermissions(): void
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
}

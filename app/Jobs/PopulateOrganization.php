<?php

namespace App\Jobs;

use App\Models\Action;
use App\Models\Organization;
use App\Models\Permission;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;

class PopulateOrganization implements ShouldQueue
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
        $this->addActions();
    }

    private function addActions(): void
    {
        $permission = Permission::where('label_translation_key', 'Administrator')->first();

        $id = DB::table('actions')->insertGetId([
            'identifier' => Action::MANAGE_PERMISSIONS,
            'label_translation_key' => 'Manage permissions',
            'description_translation_key' => 'Manages who can do what.',
            'created_at' => now(),
        ]);

        DB::table('action_permission')->insert([
            'action_id' => $id,
            'permission_id' => $permission->id,
        ]);
    }
}

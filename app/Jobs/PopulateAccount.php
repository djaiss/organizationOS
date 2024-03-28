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
        $this->addActions();
    }

    private function addActions(): void
    {
        DB::table('actions')->insert([
            'identifier' => 'manage_permissions',
            'label_translation_key' => 'Manage permissions',
            'description_translation_key' => 'Manages who can do what.',
            'created_at' => now(),
        ]);
    }
}

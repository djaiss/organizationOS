<?php

declare(strict_types=1);

namespace App\Http\ViewModels\Settings;

use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Collection;

class ProfileShowViewModel
{
    public Collection $logs;

    public function __construct(
        private readonly User $user,
    ) {}

    public function hasMoreLogs(): bool
    {
        return Log::where('user_id', $this->user->id)->count() > 5;
    }

    public function logs(): Collection
    {
        return Log::where('user_id', $this->user->id)
            ->with('user')
            ->with('organization')
            ->take(5)
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(fn(Log $log) => (object) [
                'username' => $log->getUserName(),
                'action' => $log->action,
                'description' => $log->description,
                'created_at' => $log->created_at->format('Y-m-d H:i:s'),
                'created_at_diff_for_humans' => $log->created_at->diffForHumans(),
            ]);
    }
}

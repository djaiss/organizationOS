<?php

namespace App\Http\ViewModels;

use App\Models\Organization;

class DashboardViewModel
{
    public static function index(): array
    {
        $organizations = auth()->user()->organizations
            ->map(fn (Organization $organization) => [
                'id' => $organization->id,
                'name' => $organization->name,
                'url' => [
                    'show' => route('organization.show', $organization),
                ],
            ]);

        return [
            'organizations' => $organizations,
        ];
    }
}

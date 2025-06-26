<?php

declare(strict_types=1);

namespace App\Actions;

use App\Models\Organization;
use App\Models\User;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

/**
 * Create an organization for a user.
 * The user will be added to the organization as the first user.
 */
class CreateOrganization
{
    private Organization $organization;

    private User $user;

    public function __construct(
        public int $userId,
        public string $organizationName,
    ) {}

    public function execute(): Organization
    {
        $this->validate();
        $this->create();
        $this->addFirstUser();

        return $this->organization;
    }

    private function validate(): void
    {
        if (User::find($this->userId) === null) {
            throw new ModelNotFoundException('User not found');
        }

        // make sure the organization name is not already taken
        if (Organization::where('name', $this->organizationName)->exists()) {
            throw ValidationException::withMessages([
                'organization_name' => 'Organization name already taken',
            ]);
        }

        // make sure the organization name doesn't contain any special characters
        if (in_array(preg_match('/^[a-zA-Z0-9\s\-_]+$/', $this->organizationName), [0, false], true)) {
            throw ValidationException::withMessages([
                'organization_name' => 'Organization name can only contain letters, numbers, spaces, hyphens and underscores',
            ]);
        }
    }

    private function create(): void
    {
        $this->organization = Organization::create([
            'name' => $this->organizationName,
            'slug' => Str::slug($this->organizationName),
        ]);
    }

    private function addFirstUser(): void
    {
        $this->user = User::find($this->userId);
        $this->user->organizations()->attach($this->organization->id, [
            'joined_at' => now(),
        ]);
    }
}

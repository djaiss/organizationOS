<?php

namespace App\Models;

use App\Cache\UserPermissionsCache;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'nickname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function organizations(): BelongsToMany
    {
        return $this->belongsToMany(Organization::class, 'organization_user')
            ->withPivot('permission_id')
            ->withTimestamps();
    }

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function getPermissionInOrganization(Organization $organization): Permission
    {
        return Permission::find($this->organizations()->find($organization->id)->pivot->permission_id);
    }

    /**
     * Check if the user has the right to perform an action.
     */
    public function hasTheRightTo(string $action, Organization $organization): bool
    {
        $permissions = UserPermissionsCache::make(
            user: auth()->user(),
            organization: $organization,
        )->value();

        return $permissions->contains(fn (array $permission) => $permission['identifier'] === $action);
    }
}

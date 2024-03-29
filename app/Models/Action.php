<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Action extends Model
{
    use HasFactory;

    protected $table = 'actions';

    const MANAGE_PERMISSIONS = 'manage_permissions';

    protected $fillable = [
        'identifier',
        'label_translation_key',
        'description_translation_key',
    ];

    public function permissions(): BelongsToMany
    {
        return $this->belongsToMany(Permission::class, 'action_permission');
    }
}

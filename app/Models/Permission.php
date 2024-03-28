<?php

namespace App\Models;

use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory, Translatable;

    protected $table = 'permissions';

    protected $fillable = [
        'label',
        'label_translation_key',
    ];

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class);
    }

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class, 'action_permission');
    }
}

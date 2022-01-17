<?php

namespace App\Models;

use App\Filters\Concerns\HasFilters;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    use HasFactory;
    use HasFilters;

    public const PERMISSIONS = [
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }
}

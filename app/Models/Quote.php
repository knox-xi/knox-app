<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Fillable(['content'])]
class Quote extends Model
{
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /** Users who liked this quote (pivot table: likes). */
    public function likes(): BelongsToMany
    {
        return $this->belongsToMany(User::class, 'likes');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Community extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description', 'creator_id'];

    public function discussions(): HasMany {
        return $this->hasMany(Discussion::class);
    }

    public function creator(): BelongsTo {
        return $this->belongsTo(User::class);
    }
}
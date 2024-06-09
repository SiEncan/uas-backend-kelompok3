<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Discussion extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'author_id', 'content', 'community_id'];

    public function author(): BelongsTo {
        return $this->belongsTo(User::class);
    }

    public function community(): BelongsTo {
        return $this->belongsTo(Community::class);
    }

    public function comments(): HasMany {
        return $this->hasMany(Comment::class);
    }

}
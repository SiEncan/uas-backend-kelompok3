<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class Comment extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'author_id', 'discussion_id'];

    public function author()
    {
        return $this->belongsTo(User::class);
    }

    public function discussion()
    {
        return $this->belongsTo(Discussion::class);
    }
}
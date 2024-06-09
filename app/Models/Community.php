<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Community extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'description'];

    public function discussions(): HasMany {
        return $this->hasMany(Post::class);
    }
}
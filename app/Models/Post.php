<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'content',
        'user_id',
        'category_id',
        'look',
        'is_published',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

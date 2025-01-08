<?php

namespace App\Models;

use App\Observers\PostObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Storage;

#[ObservedBy(PostObserver::class)]
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
        'image',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }
    public function updateImageInPost($data)
    {
        $data['image'] = Storage::disk('public')->put('images', $data['image']);
        $this->update($data);
        session()->flash('status', 'Image updated successfully');
    }
    public static function createWithUserAndCategory($data)
    {

        $data['user_id'] = auth()->user()->id;
        $data['category_id'] = Category::all()->first()->id;
        self::create($data);
    }
}

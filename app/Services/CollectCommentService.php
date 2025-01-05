<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Database\Eloquent\Collection;

class CollectCommentService extends Collection
{
    /**
     * Create a new class instance.
     */
    public static function threaded(Collection $collection, $parentId = null)
    {
        $comments = $collection->groupBy('parent_id');
        if (count($comments)) {
            $comments['root'] = $comments[''];
            unset($comments['']);
        }
        return $comments;
    }
}

<?php

namespace App\Http\Controllers;

use App\Http\Resources\SeasonResource;
use App\Models\Post;
use App\Models\Season;
use App\Services\ResourceService;
use Illuminate\Auth\Access\Gate;
use Illuminate\Http\Request;

class SeasonController extends Controller
{
    public function index(Post $post)
    {
        $seasons = SeasonResource::collection(Season::where('post_id', '=', $post->id)->get())->resolve();
        return view('seasons.season_list', compact('seasons'));
    }
    public function create(Post $post)
    {
        dd($post);
        return view('seasons.season_create');
    }
}

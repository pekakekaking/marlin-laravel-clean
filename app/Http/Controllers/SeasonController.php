<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreSeasonRequest;
use App\Http\Resources\PostResource;
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
        return view('seasons.season_list', compact('seasons', 'post'));
    }

    public function create(Post $post)
    {
        return view('seasons.season_create', compact('post'));
    }

    public function store(StoreSeasonRequest $request, Post $post)
    {
        $data = $request->validationData();
        Season::create($data);

        return back();
    }

    public function edit(Post $post, Season $season)
    {
        $season = SeasonResource::make($season)->resolve();
        $post=PostResource::make($post)->resolve();
        return view('seasons.season_edit', compact('season','post'));
    }
}

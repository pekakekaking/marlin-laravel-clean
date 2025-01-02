<?php

namespace App\Listeners;

use App\Events\PostShowEvent;
use App\Models\Post;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class PostShowListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(PostShowEvent $event): void
    {;
        $event->post->update([
            'look'=>$event->post['look']+1,
        ]);


    }
}

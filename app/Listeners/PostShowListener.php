<?php

namespace App\Listeners;

use App\Events\PostShowEvent;

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
    {
        $event->post->update([
            'look' => $event->post['look'] + 1,
        ]);

    }
}

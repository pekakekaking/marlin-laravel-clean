<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class StatusPostTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    #[Test] public function status_of_post_can_be_changed_by_admin()
    {
        $this->withoutExceptionHandling();
        $post = Post::latest()->first();
        $originalStatus = $post->is_published;
        $user = \App\Models\User::find(4);
        $response = $this->followingRedirects()->actingAs($user)->get('/posts/' . $post->id . '/status');
        $post->refresh();
        $response->assertStatus(200);

        $this->assertNotEquals($post->is_published,$originalStatus);
    }
}

<?php

namespace Tests\Feature;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CommentTest extends TestCase
{
    #[Test] public function comment_can_be_stored(): void
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $data = [
            'post_id' => 1,
            'content' => fake()->sentence(5),
            'parent_id' => null,
            'is_approved' => 0,
        ];
        $response = $this->followingRedirects()->actingAs($user)->post('/posts/' . $data['post_id'] . '/comments/', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('comments', $data);

        $comment = Comment::latest()->first();
        $this->assertEquals($data['content'], $comment->content);

    }

    #[Test] public function attribute_content_is_required()
    {
        $user = \App\Models\User::find(4);
        $data = [
            'post_id' => 1,
            'content' => '',
            'parent_id' => null,
            'is_approved' => 0,
        ];
        $res = $this->actingAs($user)->post('/posts/' . $data['post_id'] . '/comments/', $data);
        $res->assertSessionHasErrors('content');
        $res->assertInvalid('content');

    }

    #[Test] public function comment_can_be_stored_only_by_auth_user()
    {
        $data = [
            'post_id' => 1,
            'content' => fake()->sentence(5),
            'parent_id' => null,
            'is_approved' => 0,
        ];
        $response = $this->post('/posts/' . $data['post_id'] . '/comments/', $data);
        $response->assertRedirect();
        $this->assertDatabaseMissing('comments', ['content' => $data['content']]);
    }

    #[Test] public function comment_can_be_approved_by_admin()
    {
        $this->withoutExceptionHandling();
        $comment = Comment::latest()->first();
        $originalStatus = $comment->is_approved;
        $user = \App\Models\User::find(4);
        $response = $this->followingRedirects()->actingAs($user)->get('/posts/' . $comment->post_id . '/comments/' . $comment->id);
        $comment->refresh();
        $response->assertStatus(200);

        $this->assertNotEquals($comment['is_approved'],$originalStatus);
    }

    #[Test] public function comment_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $comment = Comment::latest()->first();
        $user = \App\Models\User::find(4);
        $response = $this->followingRedirects()->actingAs($user)->get('/comments/' . $comment->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('comments', ['id' => $comment->id]);
    }

    #[Test] public function comment_can_be_deleted_only_by_admin_user()
    {
        $user = \App\Models\User::find(5);
        $comment = Comment::latest()->first();
        $response = $this->followingRedirects()->actingAs($user)->get('/comments/' . $comment->id);
        $response->assertStatus(403);
        $this->assertDatabaseHas('comments', ['id' => $comment->id]);
    }
}

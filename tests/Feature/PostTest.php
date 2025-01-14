<?php

namespace Tests\Feature;

use App\Models\Post;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PostTest extends TestCase
{
    #[Test]
    public function response_for_route_create_is_view_create()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);

        $response = $this->actingAs($user)->get('/posts/create');
        $response->assertViewIs('create');
        $response->assertSeeText('Добавить статью');

    }

    #[Test]
    public function post_can_be_stored()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $data = [
            'name' => fake()->word(),
            'content' => fake()->paragraph(),
            'category_id' => 1,
        ];
        $response = $this->followingRedirects()->actingAs($user)->post('/posts/', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('posts', $data);

        $post = Post::latest()->first();
        $this->assertEquals($data['name'], $post->name);
    }

    #[Test]
    public function attribute_name_is_required()
    {
        $user = \App\Models\User::find(4);
        $data = [
            'name' => '',
            'content' => fake()->paragraph(),
            'category_id' => 1,
        ];
        $res = $this->actingAs($user)->post('/posts/', $data);
        $res->assertSessionHasErrors('name');
        $res->assertInvalid('name');

    }

    #[Test]
    public function attribute_content_is_required()
    {
        $user = \App\Models\User::find(4);
        $data = [
            'name' => fake()->paragraph(),
            'content' => '',
            'category_id' => 1,
        ];
        $res = $this->actingAs($user)->post('/posts/', $data);
        $res->assertSessionHasErrors('content');
        $res->assertInvalid('content');

    }

    #[Test]
    public function post_can_be_updated()
    {
        $user = \App\Models\User::find(4);
        $this->withoutExceptionHandling();
        $post = Post::latest()->first();
        $data = [
            'name' => 'name edited',
            'content' => 'content edited',
        ];

        $response = $this->followingRedirects()->actingAs($user)->patch('/posts/'.$post->id, $data);
        $response->assertStatus(200);
        $postUpdated = $post->refresh();
        $this->assertEquals($data['name'], $postUpdated->name);
        $this->assertEquals($data['content'], $postUpdated->content);

        $this->assertEquals($post->id, $postUpdated->id);

    }

    #[Test]
    public function response_for_route_posts_index_is_view_main()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $response = $this->actingAs($user)->get('/posts');
        $response->assertViewIs('main');
        $response->assertSeeText('Список статей');

        $posts = Post::all();
        $titles = $posts->pluck('name')->toArray();
        $response->assertSeeText($titles);
    }

    #[Test]
    public function response_for_route_posts_show_is_view_show()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $post = Post::latest()->first();
        $response = $this->actingAs($user)->get('/posts/'.$post->id);
        $response->assertViewIs('show');
        $response->assertSeeText('Просмотр статьи');

        $response->assertSeeText($post->name);
        $response->assertSeeText($post->content);
    }

    #[Test]
    public function response_for_route_posts_edit_is_view_edit()
    {
        $this->withoutExceptionHandling();
        $post = Post::latest()->first();
        $user = \App\Models\User::find(4);

        $response = $this->actingAs($user)->get('/posts/'.$post->id.'/edit');
        $response->assertViewIs('edit');
        $response->assertSeeText('Редактировать статью');
        $response->assertSeeHtml($post->name);
        $response->assertSeeHtml($post->content);
    }

    #[Test]
    public function post_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $post = Post::latest()->first();
        $this->actingAs($user)->delete('/posts/'.$post->id);
        $post = Post::latest()->first();
        $this->actingAs($user)->delete('/posts/'.$post->id);
        $post = Post::latest()->first();
        $response = $this->actingAs($user)->delete('/posts/'.$post->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('posts', ['content' => $post->content]);
    }

    #[Test]
    public function post_can_be_deleted_only_by_admin()
    {
        $user = \App\Models\User::find(5);
        $post = Post::latest()->first();
        $response = $this->actingAs($user)->delete('/posts/'.$post->id);
        $response->assertStatus(403);
        $this->assertDatabaseHas('posts', ['name' => $post->name]);
    }
}

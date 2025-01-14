<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Post;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryInPostTest extends TestCase
{
    #[Test]
    public function response_for_route_select_is_view_select_category()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $post = Post::find(1);

        $response = $this->actingAs($user)->get('/posts/'.$post->id.'/category');
        $response->assertViewIs('select_category');
        $response->assertSeeText('Изменить категорию');
        $response->assertSeeHtml($post->name);
        $response->assertSeeHtml($post->category->name);
    }

    #[Test]
    public function category_can_be_updated_in_post()
    {
        $user = \App\Models\User::find(4);
        $this->withoutExceptionHandling();
        $post = Post::find(1);
        $data = [
            'category_id' => Category::inRandomOrder()->first()->id,
        ];

        $response = $this->followingRedirects()->actingAs($user)->post('/posts/'.$post->id.'/category', $data);
        $response->assertStatus(200);
        $postUpdated = $post->refresh();
        $this->assertEquals($data['category_id'], $postUpdated->category_id);

        $this->assertEquals($post->id, $postUpdated->id);

    }

    #[Test]
    public function attribute_category_id_is_required()
    {
        $user = \App\Models\User::find(4);
        $post = Post::find(1);
        $data = [
            'category_id' => '',
        ];
        $response = $this->actingAs($user)->post('/posts/'.$post->id.'/category', $data);
        $response->assertSessionHasErrors('category_id');
        $response->assertInvalid('category_id');

    }

    #[Test]
    public function category_can_be_updated_in_post_only_by_admin()
    {
        $user = \App\Models\User::find(5);
        $post = Post::find(1);
        $data = [
            'category_id' => 2,
        ];
        $response = $this->followingRedirects()->actingAs($user)->post('/posts/'.$post->id.'/category', $data);
        $response->assertStatus(403);
    }
}

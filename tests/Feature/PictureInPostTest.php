<?php

namespace Tests\Feature;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Testing\File;
use Illuminate\Support\Facades\Storage;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class PictureInPostTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
        Storage::fake('public');
    }

    #[Test] public function can_store_or_update_picture_in_post(): void
    {
        $this->withoutExceptionHandling();
        $data['image'] = File::create('file.jpg');
        $post = Post::factory()->create();
        $post->updateImageInPost($data);
        $this->assertEquals('images/' . $data['image']->hashName(), $post->image);
        Storage::disk('public')->assertExists($post->image);
    }

    #[Test] public function attribute_image_is_file(): void
    {
        $user = \App\Models\User::find(4);
        $post = Post::factory()->create();
        $data = [
            'image' => 'string',
        ];
        $res = $this->actingAs($user)->post('/posts/' . $post->id . '/image', $data);
        $res->assertInvalid('image');
        $res->assertSessionHasErrors('image');
    }

    #[Test] public function picture_can_be_updated_in_post_only_by_admin()
    {
        $user = \App\Models\User::find(5);
        $post = Post::find(1);
        $data['image'] = File::create('file.jpg');

        $response = $this->followingRedirects()->actingAs($user)->post('/posts/' . $post->id . '/image', $data);
        $response->assertStatus(403);
        $this->assertNotEquals('images/' . $data['image']->hashName(), $post->image);

    }
}
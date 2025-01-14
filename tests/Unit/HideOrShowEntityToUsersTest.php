<?php


use App\Models\Category;
use App\Models\Post;
use App\Services\Helper;
use App\Services\ResourceService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class HideOrShowEntityToUsersTest extends TestCase
{

    #[Test] public function test_method_hide_or_show_entity_to_users()
    {
        $post=Post::find(1);
        (new Helper)->HideOrShowEntityToUsers($post,'is_published');
        $this->assertTrue($post->wasChanged('is_published'));
    }

}

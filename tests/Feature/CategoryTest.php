<?php

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Category;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    #[Test]
    public function response_for_route_create_is_view_category_create()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);

        $response = $this->actingAs($user)->get('/categories/create');
        $response->assertViewIs('category_create');
        $response->assertSeeText('Добавить категорию');

    }

    #[Test]
    public function category_can_be_stored()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $data = [
            'name' => 'Category 1',
        ];
        $response = $this->followingRedirects()->actingAs($user)->post('/categories/', $data);
        $response->assertStatus(200);
        $this->assertDatabaseHas('categories', $data);

        $category = Category::latest()->first();
        $this->assertEquals($data['name'], $category->name);
    }

    #[Test]
    public function attribute_name_is_required()
    {
        $user = \App\Models\User::find(4);
        $data = [
            'name' => '',
        ];
        $res = $this->actingAs($user)->post('/categories/', $data);
        $res->assertSessionHasErrors('name');
        $res->assertInvalid('name');

    }

    #[Test]
    public function category_can_be_updated()
    {
        $user = \App\Models\User::find(4);
        $this->withoutExceptionHandling();
        $category = Category::factory()->create();
        $data = [
            'name' => 'Category 1 edited',
        ];

        $response = $this->followingRedirects()->actingAs($user)->patch('/categories/'.$category->id, $data);
        $response->assertStatus(200);
        $categoryUpdated = $category->refresh();
        $this->assertEquals($data['name'], $categoryUpdated->name);

        $this->assertEquals($category->id, $categoryUpdated->id);

    }

    #[Test]
    public function response_for_route_categories_index_is_view_category_list()
    {
        $this->withoutExceptionHandling();
        $user = \App\Models\User::find(4);
        $response = $this->actingAs($user)->get('/categories');
        $response->assertViewIs('category_list');
        $response->assertSeeText('Список категорий');

        $categories = Category::all();
        $titles = $categories->pluck('name')->toArray();
        $response->assertSeeText($titles);
    }

    #[Test]
    public function response_for_route_categories_edit_is_view_category_edit()
    {
        $this->withoutExceptionHandling();
        $category = Category::latest()->first();
        $user = \App\Models\User::find(4);

        $response = $this->actingAs($user)->get('/categories/'.$category->id.'/edit');
        $response->assertViewIs('category_edit');
        $response->assertSeeText('Изменить категорию');
        $response->assertSeeHtml($category->name);
    }

    #[Test]
    public function category_can_be_deleted()
    {
        $this->withoutExceptionHandling();
        $category = Category::latest()->first();
        $user = \App\Models\User::find(4);
        $this->actingAs($user)->delete('/categories/'.$category->id);
        $category = Category::latest()->first();
        $response = $this->actingAs($user)->delete('/categories/'.$category->id);
        $response->assertStatus(200);
        $this->assertDatabaseMissing('categories', ['name' => $category->name]);
    }

    #[Test]
    public function category_can_be_deleted_only_by_auth_user()
    {
        $category = Category::latest()->first();
        $response = $this->delete('/categories/'.$category->id);
        $response->assertRedirect();
        $this->assertDatabaseHas('categories', ['name' => $category->name]);
    }

    #[Test]
    public function category_can_be_deleted_only_by_admin()
    {
        $user = \App\Models\User::find(5);
        $category = Category::latest()->first();
        $response = $this->actingAs($user)->delete('/categories/'.$category->id);
        $response->assertStatus(403);
        $this->assertDatabaseHas('categories', ['name' => $category->name]);
    }
}

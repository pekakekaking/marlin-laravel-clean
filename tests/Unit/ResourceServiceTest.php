<?php

namespace Tests\Unit;

use App\Models\Category;
use App\Services\ResourceService;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ResourceServiceTest extends TestCase
{

    #[Test] public function test_collect_all_method_in_resource_service()
    {
        $collection = (new ResourceService)->collectAll('Category');
        $this->assertIsArray($collection);
        $count = count($collection);
        $this->assertDatabaseCount('categories', $count);
    }

    #[Test] public function test_collect_one_method_in_resource_service()
    {
        $category = Category::find(1);
        $response = (new ResourceService)->collectOne($category);
        $this->assertIsArray($response);
        $this->assertEquals($category->id,$response['id']);

    }
}

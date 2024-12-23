<?php

namespace Tests\Feature\Modules\Products\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Modules\Products\Models\Product;
use App\Modules\Products\Models\Category;
use App\Modules\Products\Services\RecommendationEngineService;
use Mockery\MockInterface;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

class ProductRecommendationsControllerTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_returns_correct_recommendations_structure(): void
    {
        $category = Category::factory()->create();
        $product = Product::factory()->category($category)->create();

        $recommendedProducts = Product::factory()->count(10)->create();

        $this->mock(RecommendationEngineService::class, function (MockInterface $mock) use ($recommendedProducts) {
            $mock->shouldReceive('recommendations')
                ->andReturn(collect($recommendedProducts));
        });

        $response = $this->getJson("/api/recommendations/{$product->id}");

        $response->assertOk()
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'id',
                        'name',
                        'price',
                        'category' => [
                            'id',
                            'name'
                        ]
                    ]
                ]
            ]);
    }
}

<?php

namespace App\Modules\Products\Controllers;

use App\Modules\Products\Models\Product;
use App\Modules\Products\Resources\ProductResource;
use App\Modules\Products\Services\RecommendationEngineService;
use Illuminate\Http\Resources\Json\JsonResource;

readonly class ProductRecommendationsController
{
    public function __construct(private RecommendationEngineService $recommendationService)
    {
    }

    public function __invoke(Product $product): JsonResource
    {
        $recommendedProducts = $this->recommendationService->recommendations($product);

        return ProductResource::collection($recommendedProducts);
    }
}

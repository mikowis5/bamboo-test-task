<?php

namespace App\Modules\Products\Controllers;

use App\Modules\Products\Models\Product;
use App\Modules\Products\Resources\ProductResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Request;

readonly class ProductController
{
    public function __invoke(Request $request): JsonResource
    {
        $products = Product::query()
            ->with('category')
            ->paginate(10);

        return ProductResource::collection($products);
    }
}

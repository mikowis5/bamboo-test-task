<?php

namespace App\Modules\Products\Services;

use App\Modules\Products\Models\Product;
use Illuminate\Support\Collection;

class RecommendationEngineService
{
    private const float CATEGORY_WEIGHT = 0.5;
    private const float PRICE_WEIGHT = 1.5;
    private const int LIMIT = 10;

    /**
     * @return Collection<Product>
     */
    public function recommendations(Product $product): Collection
    {
        return Product::query()
            ->with('category')
            ->whereNot('id', $product->id)
            ->selectRaw("
                products.*,
                (
                    -- Category match
                    (CASE WHEN category_id = ? THEN ? ELSE 0 END)

                    -- Price closeness
                    + (? / (1 + ABS(price - ?)))
                ) AS rankScore
            ", [
                $product->category_id,
                self::CATEGORY_WEIGHT,
                self::PRICE_WEIGHT,
                $product->price
            ])
            ->orderByDesc('rankScore')
            ->limit(self::LIMIT)
            ->get();
    }
}

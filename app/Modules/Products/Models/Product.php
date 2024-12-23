<?php

namespace App\Modules\Products\Models;

use Database\Factories\Modules\Products\Models\ProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int $id
 * @property int $category_id
 * @property float $price
 * @property string $name
 *
 * @property-read Category $category
 * @method static ProductFactory factory()
 */
class Product extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'price' => 'float',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}

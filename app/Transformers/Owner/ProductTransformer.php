<?php

namespace App\Transformers\Owner;

use App\Product;
use League\Fractal\TransformerAbstract;

class ProductTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Product $product)
    {
        return [
            'id' => $product->id,
            'product_categories_id' => $product->product_categories_id,
            'project_id' => $product->project_id,
            'name' => $product->name,
            'size' => $product->size,
            'cost' => number_format($product->cost, 2, '.', ','),
            'price' => number_format($product->price, 2, '.', ','),
            'picture' => $product->picture,
            'time_to_prepare' => $product->time_to_prepare . ' min',
        ];
    }
}

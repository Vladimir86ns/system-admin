<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\ProductCategory;
use App\Project;

class Product extends Model
{
    protected $fillable = [
        'product_categories_id',
        'project_id',
        'name',
        'size',
        'cost',
        'price',
        'picture',
        'time_to_prepare'
    ];

    protected $casts = [
        'investment_collected' => 'boolean',
    ];

    /**
     * Get the product category record associated with the product.
     */
    public function productCategory()
    {
        return $this->hasOne(ProductCategory::class);
    }

    /**
     * The projects that belong to the product.
     */
    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }
}

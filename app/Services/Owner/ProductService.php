<?php

namespace App\Services\Owner;

use Sentinel;
use App\User;
use App\Product;
use App\ProductCategory;

class ProductService
{
    /**
     * Save new product of company.
     *
     * @return Product
     */
    public function save(array $attributes)
    {
        $attributes = $this->appendCompanyIdCategoryId($attributes);
        $attributesToSave = $this->getAttributesForSave($attributes);

        return Product::create($attributesToSave);
    }

    /**
     * @param array $attributes
     * @return array
     */
    public function appendCompanyIdCategoryId(array &$attributes)
    {
        if (!empty($attributes['category'])) {
            $category = $this->getCategoryByName($attributes['category']);
            $attributes['product_categories_id'] = $category['id'];
        }

        $user = $this->getUser();
        $attributes['project_id'] = optional($user->project)->id;

        return $attributes;
    }

    /**
     * Return only attributes for save
     *
     * @return array
     */
    public function getAttributesForSave(array $attributes)
    {
        return array_except($attributes, ['_token', 'btnSubmit']);
    }

    /**
     * Get user.
     *
     * @return array
     */
    public function getUser()
    {
        return Sentinel::getUser();
    }

    /**
     * Get category by name.
     *
     * @return ProductCategory
     */
    public function getCategoryByName(string $categoryName)
    {
        return ProductCategory::where('name', $categoryName)->first();
    }
}

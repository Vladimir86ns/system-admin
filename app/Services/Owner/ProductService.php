<?php

namespace App\Services\Owner;

use App\User;
use Sentinel;
use App\Product;
use App\ProductCategory;
use App\Transformers\Owner\ProductTransformer;
use League\Fractal\Manager as FractalManager;
use League\Fractal\Resource\Collection;

class ProductService
{
    /**
     * @var FractalManager
     */
    protected $fractal;

    /**
     * @var transformer
     */
    protected $transformer;

    /**
     * Product service controller
     *
     * @param FractalManager $fractalManager
     * @param ProductTransformer $transformer
     */
    public function __construct(
        FractalManager $fractalManager,
        ProductTransformer $transformer
    ) {
        $this->fractal = $fractalManager;
        $this->transformer = $transformer;
    }

    /**
     * Get all products.
     *
     * @return Product
     */
    public function getAll()
    {
        $companyId = $this->getCompanyId();

        return Product::where('project_id', $companyId)->get();
    }

    /**
     * Get all transformed products.
     *
     * @return Product
     */
    public function getAllTransformed()
    {
        $result = new Collection($this->getAll(), $this->transformer);

        return $this->fractal->createData($result)->toArray();
    }

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

    /**
     * Get company id.
     *
     * @return array
     */
    public function getCompanyId()
    {
        return $this->getUser()->project->id;
    }
}

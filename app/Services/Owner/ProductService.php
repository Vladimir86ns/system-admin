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
     * @param array $attributes
     * @return Product
     */
    public function save(array $attributes)
    {
        $attributes = $this->appendCompanyIdCategoryId($attributes);
        $attributesToSave = $this->getAttributesForSave($attributes);

        return Product::create($attributesToSave);
    }

    /**
     * Append company id and category id to attributes before save to DB
     *
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
     * @param array $attributes
     * @return array
     */
    public function getAttributesForSave(array $attributes)
    {
        return array_except($attributes, ['_token', 'btnSubmit']);
    }

    /**
     * Return only attributes for save
     *
     * @param array $attributes
     * @return array
     */
    public function getAttributesForEdit(array $attributes)
    {
        $attributes = $this->getAttributesForSave($attributes);

        return array_except($attributes, ['picture']);
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
     * @param string $categoryName
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

    /**
     * Delete product
     *
     * @param int $id
     * @return bool
     */
    public function delete(int $id)
    {
        $product = $this->getProductById($id);

        if ($product) {
            $product->delete();
        }

        return $product;
    }

    /**
     * Get product
     *
     * @param int $id
     * @return Product
     */
    public function getProductById(int $id)
    {
        return Product::find($id);
    }

    /**
     * Get product
     *
     * @param int $id
     * @return array
     */
    public function getTransformedProduct(int $id)
    {
        $product = $this->getProductById($id);

        if ($product) {
            return $this->transformer->transform($product);
        }

        return $product;
    }


    /**
     * Save edited product to DB
     *
     * @param int $id
     * @param array $attributes
     * @return array
     */
    public function editSave($id, $attributes)
    {
        $product = $this->getProductById($id);

        if ($product) {
            $attributes = $this->appendCompanyIdCategoryId($attributes);
            $attributesToSave = $this->getAttributesForEdit($attributes);

            return $product->update($attributesToSave);
        }

        return $product;
    }

    /**
     * Get all products.
     *
     * @return Product
     */
    public function apiGetAll($companyId)
    {
        return Product::where('project_id', $companyId)->get();
    }

    /**
     * Get all transformed products.
     *
     * @return Product
     */
    public function apiGetAllTransformed($companyId)
    {
        $result = new Collection($this->apiGetAll($companyId), $this->transformer);

        return $this->fractal->createData($result)->toArray();
    }
}

<?php

namespace App\Http\Controllers;

use Redirect;
use App\Product;
use Illuminate\Http\Request;
use App\Services\Owner\ProductService;
use App\Http\Requests\Owner\ProductRequest;

class ProductController extends Controller
{
    /**
     * @var service
     */
    protected $service;

    /**
     * Product Controller
     *
     */
    public function __construct(
        ProductService $productService
    ) {
        $this->service = $productService;
    }

    /**
     * Show all products for company.
     *
     * @return View
     */
    public function index()
    {
        $allProducts = $this->service->getAllTransformed();
        $product = false;

        return view('owner.product.index', compact(['allProducts', 'product']));
    }

    /**
     * Add new project to company.
     *
     * @return View
     */
    public function create()
    {
        return view('owner.product.form.add-product');
    }

    /**
     * Save new project of company.
     *
     * @return View
     */
    public function store(ProductRequest $request)
    {
        $inputs = $request->all();
        $project = $this->service->save($inputs);

        if ($project) {
            return Redirect::back()->with("success", "You successfully added {$inputs['name']} product.");
        }

        return Redirect::back()->with("error", "Something went wrong!");
    }

    /**
     * Delete product from company.
     *
     * @return View
     */
    public function delete($id)
    {
        $isDeleted = $this->service->delete($id);

        if ($isDeleted) {
            return Redirect::back()->with("success", "You successfully removed product.");
        }

        return Redirect::back()->with("error", "Product with {$id} not found!");
    }

    /**
     * Get all products in table and selected product details.
     *
     * @return View
     */
    public function edit($id)
    {
        $product = $this->service->getProductById($id);

        if ($product) {
            $allProducts = $this->service->getAllTransformed();

            return view('owner.product.index', compact(['allProducts', 'product']));
        }

        return Redirect::back()->with("error", "Product with {$id} not found!");
    }

    /**
     * Save edited product.
     *
     * @return View
     */
    public function editSave($id, ProductRequest $request)
    {
        $inputs = $request->all();
        $isSaved = $this->service->editSave($id, $inputs);

        if ($isSaved) {
            return Redirect::back()->with("success", "You successfully updated product.");
        }

        return Redirect::back()->with("error", "Product with {$id} not found!");
    }
}

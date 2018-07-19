<?php

namespace App\Http\Controllers;

use Redirect;
use App\Product;
use Illuminate\Http\Request;
use App\Services\Owner\ProductService;
use App\Http\Requests\Owner\ProductRequest;

class ApiProductController extends Controller
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
    public function getAll($id)
    {
        return $this->service->apiGetAllTransformed($id);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Show all products for company.
     *
     * @return View
     */
    public function index()
    {
        return view('owner.product.index');
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
    public function store(Request $request)
    {
        dd($request->all());
    }
}

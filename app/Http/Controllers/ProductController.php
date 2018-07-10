<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // dd('index');
        return view('owner.product.index');
    }

    public function create()
    {
        return view('owner.product.form.add-product');
    }
}

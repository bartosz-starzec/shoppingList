<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProductCollection;
use Illuminate\Routing\Controller;
use App\Product;

class ProductController extends Controller
{
    /**
     * @return ProductCollection
     */
    public function index(): ProductCollection
    {
        return new ProductCollection(Product::all());
    }
}

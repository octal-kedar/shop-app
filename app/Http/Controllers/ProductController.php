<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function getProductsWithCategories()
    {
        $products = Product::with('subcategory.category')->get();

        return response()->json(['products' => $products]);
    }
}

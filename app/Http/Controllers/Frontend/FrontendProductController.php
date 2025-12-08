<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Product;
use Illuminate\View\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FrontendProductController extends Controller
{
    public function product_details(Product $product)
    {
        return view('frontend.product_details', compact('product'));
    }
}

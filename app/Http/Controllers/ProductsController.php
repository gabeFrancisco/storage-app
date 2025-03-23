<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    public function getAll(){
        $products = Product::with("category")->get();
        return response()->json($products, 200);
    }


}

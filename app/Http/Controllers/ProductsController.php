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

    public function get($id){
        $product = Product::find($id);
        if($product == null){
            return response()->json(["error" => "The product with the given ID does not exists on database!"]);
        }

        return response()->json($product, 200);
    }
}

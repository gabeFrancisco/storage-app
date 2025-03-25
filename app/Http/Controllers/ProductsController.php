<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductsController extends Controller
{
    private function getProductById($id)
    {
        $dbProduct = Product::where("id", $id)->first();
        if ($dbProduct != null) {
            return $dbProduct;
        }

        return null;
    }

    private function getProductByName($name)
    {
        $dbProduct = Product::where("name", $name)->first();
        if ($dbProduct != null) {
            if (strtolower($dbProduct->name) == strtolower($name)) {
                return $dbProduct;
            }
        }

        return null;
    }


    public function getAll()
    {
        $products = Product::with("category")->get();
        return response()->json($products, 200);
    }

    public function get($id)
    {
        $product = $this->getProductById($id);
        if ($product == null) {
            return response()->json(["error" => "The product with the given ID does not exists on database!"]);
        }

        return response()->json($product, 200);
    }

    public function post(Request $request)
    {
        $name = $request->input("name");
        $description = $request->input("description");
        $cat_id = $request->input("category_id");
        $quantity = $request->input("quantity");
        $price = $request->input("price");

        $dbProd = $this->getProductByName($name);
        if ($dbProd != null) {
            return
                response()->json(['message' => 'There is a category on database with the same name. Please use another name!']);
        }

        Product::create([
            "name" => $name,
            "description" => $description,
            "category_id" => $cat_id,
            "quantity" => $quantity,
            "price" => $price
        ]);

        return response()->json("Ok!", status: 200);
    }
}

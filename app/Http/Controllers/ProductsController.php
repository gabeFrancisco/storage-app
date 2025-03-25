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

        return response()->json(["error" => "The product with the given ID does not exists on database!"]);
    }

    private function getProductByName($name)
    {
        $dbProduct = Product::where("name", $name)->first();
        if ($dbProduct != null) {
            if (strtolower($dbProduct->name) == strtolower($name)) {
                return
                response()->json(['message' => 'There is a category on database with the same name. Please use another name!']);
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

        Product::create([
            "name" => $name,
            "description" => $description,
            "category_id" => $cat_id,
            "quantity" => $quantity,
            "price" => $price
        ]);

        return response()->json("Ok!", status: 200);
    }

    public function update(Request $request, $id){
        $name = $request->input("name");
        $description = $request->input("description");
        $cat_id = $request->input("category_id");
        $quantity = $request->input("quantity");
        $price = $request->input("price");

        $prod = $this->getProductById($id);
        
        Product::where("id", $id)->update([
            "name" => $name,
            "description" => $description,
            "category_id" => $cat_id,
            "quantity" => $quantity,
            "price" => $price
        ]);

        $prod->refresh();

        return response()->json([
            "message" => "Successful update",
            "category" => $prod
        ], 200);
    }
}

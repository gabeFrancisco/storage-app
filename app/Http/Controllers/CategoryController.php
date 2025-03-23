<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class CategoryController extends Controller
{
    public function getAll()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function post(Request $request)
    {
        $name = $request->input("name");
        $description = $request->input("description");

        $dbCat = Category::where("name", $name)->first();
        if ($dbCat != null) {
            if (strtolower($dbCat->name) == strtolower($name)) {
                return
                    response()->json(['message' => 'There is a category on database with the same name. Please use another name!']);
            }
        }
        Category::create([
            "name" => $name,
            "description" => $description
        ]);



        return response()->json("Ok!", 200);
    }
}

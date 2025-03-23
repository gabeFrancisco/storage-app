<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class CategoryController extends Controller
{
    public function getAll(){
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function post(Request $request){
        $name = $request->input("name");
        $description = $request->input("description");

        Category::create([
            "name"=> $name,
            "description"=> $description
        ]);

        return response()->json("Ok!", 200);
    }
}

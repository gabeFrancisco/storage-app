<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Routing\ResponseFactory;

class CategoryController extends Controller
{
    public function getAll()
    {
        $categories = Category::all();
        return response()->json($categories, 200);
    }

    public function get($id){
        $cat = Category::where("id", $id)->first();
        if($cat == null){
            return response()->json(["error" => "The category with the given ID does not exists on database!"]);
        }

        return response()->json(["message" => $cat]);
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

    public function update(Request $request, $id){
        $name = $request->input("name");
        $description = $request->input("description");

        $cat = Category::where("id", $id)->first();
        if($cat == null){
            return response()->json(["error" => "The category with the given ID does not exists on database!"]);
        }

        Category::where("id", $id)->update([
            "name"=> $name,
            "description"=> $description
        ]);

        $cat->refresh();

        return response()->json([
            "message" => "Successful update",
            "category" => $cat
        ], 200);
    }

    public function delete($id){

        $cat = Category::where("id", $id)->first();
        if($cat == null){
            return response()->json(["error" => "The category with the given ID does not exists on database!"]);
        }

       $cat->delete();

       return response()->json(["message" => "The category was deleted with success!"], 200);
    }
}

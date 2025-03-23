<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CreateCategory(Request $request)
    {
        $user_id = $request->header('id');


        Category::create([
            'name' => $request->name,
            'user_id' => $user_id
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category created successfully'
        ]);
    }


    public function CategoryList(Request $request)
    {
        $user_id = $request->header('id');

        $category = Category::where('user_id', $user_id)->get();

        return $category;
    }

    public function CategoryById(Request $request)
    {
        $user_id = $request->header('id');

        $category = Category::where('id', $request->id)->where('user_id', $user_id)->first();

        return $category;
    }

    public function CategoryUpdate(Request $request)
    {
        $user_id = $request->header('id');
        $id = $request->input('id');

        $category = Category::where('id', $id)->where('user_id', $user_id)->update([
            'name' => $request->name
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Category updated successfully'
        ]);
    }

    public function CategoryDelete(Request $request, $id)
    {
        $user_id = $request->header('id');

        Category::where('user_id', $user_id)->where('user_id', $user_id)->where('id', $id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Category deleted successfully'
        ]);
    }
}

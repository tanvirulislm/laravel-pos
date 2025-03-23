<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function CreateProduct(Request $request)
    {
        $user_id = $request->header('id');

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        $data = [
            'name' => $request->name,
            'category_id' => $request->category_id,
            'price' => $request->price,
            'unit' => $request->unit,
            'user_id' => $user_id
        ];

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filepath = 'uploads/' . $filename;

            $image->move(public_path('uploads'), $filename);
            $data['image'] = $filepath;
        }
        Product::create($data);
        return response()->json([
            'status' => 'success',
            'message' => 'Product created successfully'
        ]);
    }


    public function ProductList(Request $request)
    {
        $user_id = $request->header('id');


        $products = Product::where('user_id', $user_id)->get();
        return $products;
    }

    public function ProductById(Request $request)
    {
        $user_id = $request->header('id');

        $product = Product::where('user_id', $user_id)->where('id', $request->id)->first();

        return $product;
    }


    public function ProductUpdate(Request $request)
    {
        $user_id = $request->header('id');

        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'price' => 'required',
            'unit' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);

        $product = Product::where('user_id', $user_id)->findOrFail($request->id);

        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->unit = $request->unit;

        if ($request->hasFile('image')) {

            if ($product->image && file_exists(public_path($product->image))) {
                unlink(public_path('uploads/' . $product->image));
            }
            $request->validate([
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
            ]);

            $image = $request->file('image');

            $filename = time() . '.' . $image->getClientOriginalExtension();
            $filepath = 'uploads' . $filename;

            $image->move(public_path('uploads'), $filename);
            $product->image = $filepath;
        }
        $product->save();
        return response()->json([
            'status' => 'success',
            'message' => 'Product Updated successfully'
        ]);
    }
}

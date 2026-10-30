<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\Category;

class CategoryController extends Controller
{
    public function category()
    {
        return view('admin.category.index');
    }
    public function index()
    {
        $categories = Category::where('status', 1)->get();

        return view('admin.category.indexs', compact('categories'));
    }
    public function categoryprocess(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255|unique:categories,name',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',

            // Validates file type and size (2MB)

        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        if ($validator->passes()) {
            $imageName = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/category'), $imageName);
            }
            $category = new Category();
            $category->name = $request->name;
            $category->description = $request->description;
            $category->image = $imageName;
            $category->status = $request->status;
            $category->save();
            return response()->json([
                'status' => true,
                'message' => 'Category added successfully!'
            ]);
        }
    }
    public function edit($id)
    {
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        // 1. Category check (! bosate hobe)
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found',
            ]);
        }

        // 2. Validation (Update er somoy nijer id ignore korar jonno . $id dite hobe)
        $validator = Validator::make($request->all(), [
            'name'        => 'required|string|max:255|unique:categories,name,' . $id,
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048', // Image optional/nullable kora valo
        ]);

        // Jodi validation fail kore
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }

        // 3. Update code gulo validation er BAIRE thakbe
        $category->name = $request->name;
        $category->description = $request->description;
        $category->status = $request->status;

        // Jodi notun image upload kora hoy
        if ($request->hasFile('image')) {
            // Puraton image thakle delete kore dewa
            if ($category->image && file_exists(public_path('uploads/category/' . $category->image))) {
                @unlink(public_path('uploads/category/' . $category->image));
            }

            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/category'), $imageName);

            $category->image = $imageName;
        }

        $category->save();

        // 4. Success Response
        return response()->json([
            'status' => true,
            'message' => 'Category updated successfully!'
        ]);
    }
    public function delete($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return response()->json([
                'status' => false,
                'message' => 'Category not found'
            ]);
        }

        // Jodi image thake tahole folder theke delete kore dewa
        if ($category->image && file_exists(public_path('uploads/category/' . $category->image))) {
            @unlink(public_path('uploads/category/' . $category->image));
        }

        // Database theke category delete kora
        $category->delete();

        return response()->json([
            'status' => true,
            'message' => 'Category deleted successfully!'
        ]);
    }
}

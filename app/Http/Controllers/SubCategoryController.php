<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Models\SubCategory;
use App\Models\Category;

class SubCategoryController extends Controller
{
    public function subcategory()
    {
        $categories = Category::where('status', 1)->get();
        return view('admin.subcategory.index', compact('categories'));
    }
    public function index()
    {
        $subcategories = SubCategory::where('status', 1)->get();
        return view('admin.subcategory.manage', compact('subcategories'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id', // category_id database-e ache kina check korbe
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
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
                $image->move(public_path('uploads/subcategoryImage'), $imageName);
            }
            $subcategory = new SubCategory();
            $subcategory->category_id = $request->category_id;
            $subcategory->name = $request->name;
            $subcategory->description = $request->description;
            $subcategory->image = $imageName;
            $subcategory->status = $request->status;
            $subcategory->save();
            return response()->json([
                'status' => true,
                'message' => 'subcategory create successfully',
            ]);
        }
    }
    public function edit($id)
    {
        $subcategory = SubCategory::findOrFail($id);
        $categories = Category::where('status', 1)->get();

        return view('admin.subcategory.edit', compact('subcategory', 'categories'));
    }
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);
        if (!$subcategory) {
            return response()->json([
                'status' => false,
                'message' => 'subcategory not found',
            ]);
        }
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id', // category_id database-e ache kina check korbe
            'name'        => 'required|string|max:255',
            'description' => 'required|string',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors(),
            ]);
        }
        if ($request->hasFile('image')) {
            if ($subcategory->image && file_exists(public_path('/uploads/subcategoryImage/' . $subcategory->image))) {
                unlink(public_path('/uploads/subcategoryImage/' . $subcategory->image));
            }
            $image = $request->file('image');
            $imageName = time() . '_' . Str::slug($request->name) . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/subcategoryImage'), $imageName);


            $subcategory->image = $imageName;
        }
        $subcategory->category_id = $request->category_id;
        $subcategory->name = $request->name;
        $subcategory->description = $request->description;
        $subcategory->status = $request->status;
        $subcategory->save();

        return response()->json([
            'status' => true,
            'message' => 'Subcategory updated successfully',
        ]);
    }
    public function destroy($id){
        $subcategory = SubCategory::find($id);
        if(!$subcategory){
            return response()->json([
                'status' => false,
                'message' => 'Subcategory not found',
            ]);
        }
        if ($subcategory->image && file_exists(public_path('/uploads/subcategoryImage/' . $subcategory->image))) {
            unlink(public_path('/uploads/subcategoryImage/' . $subcategory->image));
        }
        $subcategory->delete();

        return response()->json([
            'status' => true,
            'message' => 'Subcategory deleted successfully',
        ]);
    }
}

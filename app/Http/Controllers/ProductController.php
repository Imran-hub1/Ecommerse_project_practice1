<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Brand;
use App\Models\Product;

use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function product()
    {
        $categories = Category::where('status', 1)->get();
        $subcategories = Subcategory::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.product.index', compact('categories', 'subcategories', 'brands'));
    }
    public function manage()
    {
        $products = Product::with(['category', 'subcategory', 'brand'])->get();
        return view('admin.product.manage', compact('products'));
    }
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'category_id' => 'required|exists:categories,id',
            'subcategory_id' => 'required|exists:sub_categories,id',
            'brand_id' => 'required|exists:brands,id',
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'short_description' => 'required|string|max:255',
            'price' => 'required|numeric',
            'discount_price' => 'nullable|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048',
            'status' => 'required|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
        if ($validator->passes()) {
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . $request->name . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/product'), $imageName);
            }
            $product = new Product();
            $product->category_id = $request->category_id;
            $product->subcategory_id = $request->subcategory_id;
            $product->brand_id = $request->brand_id;
            $product->name = $request->name;
            $product->description = $request->description;
            $product->short_description = $request->short_description;
            $product->price = $request->price;
            $product->discount_price = $request->discount_price;
            $product->image = $imageName;
            $product->status = $request->status;
            $product->save();
            return response()->json([
                'status' => true,
                'message' => 'Product added successfully!'
            ]);
        }
    }
    public function edit($id)
    {
        $product = Product::find($id);
        $categories = Category::where('status', 1)->get();
        $subcategories = Subcategory::where('status', 1)->get();
        $brands = Brand::where('status', 1)->get();
        return view('admin.product.edit', compact('product', 'categories', 'subcategories', 'brands'));
    }
    public function update(Request $request, $id) {}
}

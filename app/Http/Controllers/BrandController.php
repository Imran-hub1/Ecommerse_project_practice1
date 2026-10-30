<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    public function brand()
    {
        return view('admin.brand.index');
    }
    public function manage()
    {
        $brands = Brand::where('status', 1)->get();
        return view('admin.brand.manage', compact('brands'));
    }
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg,webp|max:2048'
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
                $image->move(public_path('uploads/brandImage'), $imageName);
            }
            $brand = new Brand();
            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->image = $imageName;
            $brand->status = $request->status;
            $brand->save();
            return response()->json([
                'status' => true,
                'message' => 'Brand created successfully',
            ]);
        }
    }
    public function edit($id)
    {
        $brand = Brand::find($id);
        return view('admin.brand.edit', compact('brand'));
    }
    public function update(Request $request, $id)
    {
        $brand = Brand::find($id);
        $validator = Validator::make($request->all(), [
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
        if ($validator->passes()) {
            $brand->name = $request->name;
            $brand->description = $request->description;
            $brand->status = $request->status;

            // Jodi notun image upload kora hoy
            if ($request->hasFile('image')) {
                // Puraton image thakle delete kore dewa
                if ($brand->image && file_exists(public_path('uploads/brandImage/' . $brand->image))) {
                    @unlink(public_path('uploads/brandImage/' . $brand->image));
                }

                $image = $request->file('image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->move(public_path('uploads/brandImage'), $imageName);

                $brand->image = $imageName;
            }

            $brand->save();

            // 4. Success Response
            return response()->json([
                'status' => true,
                'message' => 'Brand updated successfully!'
            ]);
        }
    }
    public function delete($id)
    {
        $brand = Brand::find($id);
        if (!$brand) {
            return response()->json([
                'status' => false,
                'message' => 'Brand not found',
            ]);
        }
        if ($brand->image && file_exists(public_path('uploads/brandImage/' . $brand->image))) {
            @unlink(public_path('uploads/brandImage/' . $brand->image));
        }
        $brand->delete();
        return response()->json([
            'status' => true,
            'message' => 'Brand deleted successfully',
        ]);
    }
}

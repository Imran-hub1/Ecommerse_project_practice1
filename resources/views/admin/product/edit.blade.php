@extends('admin.dashboard.master')
@section('title')
@endsection
@section('content')

@section('content')
<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Update Product Form</h4>
                    </div>

                    <!-- ফর্ম ট্যাগ যুক্ত করা হয়েছে -->
                    <form action="" method="POST" id="productupdateForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="mb-3 row">
                                <label for="name" class="col-md-3 col-form-label">Category Name</label>
                                <div class="col-md-9">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ $product->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="name" class="col-md-3 col-form-label">SubCategory Name</label>
                                <div class="col-md-9">
                                    <select name="subcategory_id" id="subcategory_id" class="form-control">
                                        <option value="">Select SubCategory</option>
                                        @foreach($subcategories as $subcategory)
                                        <option value="{{ $subcategory->id }}" {{ $product->subcategory_id == $subcategory->id ? 'selected' : '' }}>{{ $subcategory->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <div class="mb-3 row">
                                <label for="name" class="col-md-3 col-form-label">Brand Name</label>
                                <div class="col-md-9">
                                    <select name="brand_id" id="brand_id" class="form-control">
                                        <option value="">Select Brand</option>
                                        @foreach($brands as $brand)
                                        <option value="{{ $brand->id }}" {{ $product->brand_id == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Name -->
                            <div class="mb-3 row">
                                <label for="name" class="col-md-3 col-form-label">Product Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your product name" value="{{ $product->name }}">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="mb-3 row">
                                <label for="description" class="col-md-3 col-form-label">Product Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter your product description">{{$product->description}}</textarea>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Short Description -->
                            <div class="mb-3 row">
                                <label for="short_description" class="col-md-3 col-form-label">Short Description</label>
                                <div class="col-md-9">
                                    <textarea name="short_description" id="short_description" class="form-control" rows="2" placeholder="Enter your product short description">{{$product->short_description}}</textarea>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Price -->
                            <div class="mb-3 row">
                                <label for="price" class="col-md-3 col-form-label">Product Price</label>
                                <div class="col-md-9">
                                    <input type="number" name="price" id="price" class="form-control" placeholder="Enter your product price" value="{{ $product->price }}">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Discount Price -->
                            <div class="mb-3 row">
                                <label for="discount_price" class="col-md-3 col-form-label">Discount Price</label>
                                <div class="col-md-9">
                                    <input type="number" name="discount_price" id="discount_price" class="form-control" placeholder="Enter your product discount price" value="{{ $product->discount_price }}">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="mb-3 row">
                                <label for="image" class="col-md-3 col-form-label">Product Image</label>
                                <div class="col-md-9">
                                    @if($product->image)
                                    <img src="{{ asset('uploads/product/' . $product->image) }}" alt="{{ $product->name }}" width="100">
                                    @endif
                                    <input type="file" name="image" id="image" class="form-control">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Status -->
                            <div class="mb-3 row">
                                <label for="status" class="col-md-3 col-form-label">Product Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1" {{ $product->status == 1 ? 'selected' : '' }}>Active</option>
                                        <option value="0" {{ $product->status == 0 ? 'selected' : '' }}>Block</option>
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="offset-md-3 col-md-9">
                                    <button type="submit" class="btn btn-primary">Update Product</button>
                                </div>
                            </div>

                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('customjs')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#productupdateForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
    })
</script>
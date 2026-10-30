@extends('admin.dashboard.master')

@section('title')
This is a product page
@endsection

@section('content')
<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Add Product Form</h4>
                    </div>

                    <!-- ফর্ম ট্যাগ যুক্ত করা হয়েছে -->
                    <form action="" method="POST" id="productForm" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">

                            <div class="mb-3 row">
                                <label for="name" class="col-md-3 col-form-label">Category Name</label>
                                <div class="col-md-9">
                                    <select name="category_id" id="category_id" class="form-control">
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
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
                                        <option value="{{ $subcategory->id }}">{{ $subcategory->name }}</option>
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
                                        <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                                        @endforeach
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Name -->
                            <div class="mb-3 row">
                                <label for="name" class="col-md-3 col-form-label">Product Name</label>
                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" class="form-control" placeholder="Enter your product name">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Description -->
                            <div class="mb-3 row">
                                <label for="description" class="col-md-3 col-form-label">Product Description</label>
                                <div class="col-md-9">
                                    <textarea name="description" id="description" class="form-control" rows="4" placeholder="Enter your product description"></textarea>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Short Description -->
                            <div class="mb-3 row">
                                <label for="short_description" class="col-md-3 col-form-label">Short Description</label>
                                <div class="col-md-9">
                                    <textarea name="short_description" id="short_description" class="form-control" rows="2" placeholder="Enter your product short description"></textarea>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Price -->
                            <div class="mb-3 row">
                                <label for="price" class="col-md-3 col-form-label">Product Price</label>
                                <div class="col-md-9">
                                    <input type="number" name="price" id="price" class="form-control" placeholder="Enter your product price">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Discount Price -->
                            <div class="mb-3 row">
                                <label for="discount_price" class="col-md-3 col-form-label">Discount Price</label>
                                <div class="col-md-9">
                                    <input type="number" name="discount_price" id="discount_price" class="form-control" placeholder="Enter your product discount price">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Image -->
                            <div class="mb-3 row">
                                <label for="image" class="col-md-3 col-form-label">Product Image</label>
                                <div class="col-md-9">
                                    <input type="file" name="image" id="image" class="form-control">
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Product Status -->
                            <div class="mb-3 row">
                                <label for="status" class="col-md-3 col-form-label">Product Status</label>
                                <div class="col-md-9">
                                    <select name="status" id="status" class="form-control">
                                        <option value="1">Active</option>
                                        <option value="0">Block</option>
                                    </select>
                                    <p class="text-danger"></p>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="offset-md-3 col-md-9">
                                    <button type="submit" class="btn btn-primary">Save Product</button>
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
    $('#productForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{route('product.store')}}",
            type: "POST",
            dataType: "json",
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                if (response.status == false) {
                    var errors = response.errors;
                    if (errors.category_id) {
                        $('#category_id').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category_id);
                    } else {
                        $('#category_id').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.subcategory_id) {
                        $('#subcategory_id').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.subcategory_id);
                    } else {
                        $('#subcategory_id').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.brand_id) {
                        $('#brand_id').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.brand_id);
                    } else {
                        $('#brand_id').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.name) {
                        $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    } else {
                        $('#name').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }

                    if (errors.description) {
                        $('#description').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.description);
                    } else {
                        $('#description').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.short_description) {
                        $('#short_description').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.short_description);
                    } else {
                        $('#short_description').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.price) {
                        $('#price').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.price);
                    } else {
                        $('#price').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.discount_price) {
                        $('#discount_price').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.discount_price);
                    } else {
                        $('#discount_price').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.image) {
                        $('#image').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.image);
                    } else {
                        $('#image').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                    if (errors.status) {
                        $('#status').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.status);
                    } else {
                        $('#status').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }
                } else {
                    window.location.href = "{{route('product')}}";
                }
            },
            error: function(jqXHR, exception) {
                console.log('something went wrong');
            }

        });
    });
</script>
@endsection
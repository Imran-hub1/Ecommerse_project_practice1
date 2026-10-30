@extends('admin.dashboard.master')
@section('title')
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>this is a manage page</h3>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Product Name</th>
                                    <th>Category</th>
                                    <th>Subcategory</th>
                                    <th>Brand</th>
                                    <th>Image</th>
                                    <th>description</th>
                                    <th>Short Description</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($products as $product)
                                <tr>
                                    <td>{{$product->name}}</td>
                                    <td>{{$product->category->name}}</td>
                                    <td>{{$product->subcategory->name}}</td>
                                    <td>{{$product->brand->name}}</td>
                                    <td><img src="{{ asset('uploads/product/' . $product->image) }}" alt="{{ $product->name }}" width="100"></td>
                                    <td>{{$product->description}}</td>
                                    <td>{{$product->short_description}}</td>
                                    <td>
                                        <a href="{{ route('product.edit', $product->id) }}" class="btn btn-sm btn-primary">Edit</a>
                                        <a href="" class="btn btn-sm btn-danger">Delete</a>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
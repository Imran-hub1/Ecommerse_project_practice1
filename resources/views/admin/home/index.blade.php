@extends('admin.master')
@section('title')
this is a detail page
@endsection
@section('content')
<section>
    <div class="row bannar">
        <div class="col-md-12">
            <div class="row-group">
                <div class="col-md-6">
                    <h3>bangladesh</h3>
                    <p>bangladesh is a beautiful country</p>
                </div>
                <div class="form">
                    <div class="col-md-6">
                        <div class="row-group">
                            <div class="col-md-3">
                                <label for="">first name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" value="name" placeholder="enter your name">
                            </div>
                        </div>
                        <div class="row-group">
                            <div class="col-md-3">
                                <label for="">first name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" value="name" placeholder="enter your name">
                            </div>
                        </div>
                        <div class="row-group">
                            <div class="col-md-3">
                                <label for="">first name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" value="name" placeholder="enter your name">
                            </div>
                        </div>
                        <div class="row-group">
                            <div class="col-md-3">
                                <label for="">first name</label>
                            </div>
                            <div class="col-md-9">
                                <input type="text" id="name" name="name" value="name" placeholder="enter your name">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="hr">
    <hr />
</div>
<section>
    <div class="container">

        <div class="row py-5">
            <div class="col-md-12">
                <div class="row">
                    @foreach($products as $product)
                    <div class="col-md-4">

                        <div class="card shadow-sm">
                            <div class="card-header bg-primary text-white">
                                <h2 class="h5 mb-0">{{ $product->name }}</h2>
                                <img src="{{ asset('/uploads/product/' .$product->image) }}" alt="{{ $product->name }}">
                            </div>
                            <div class="card-body">
                                <p class="mb-0">{{ $product->description }}</p>
                                <p>{{ $product->category->name }}</p>
                                <a href="{{route('detail', $product->id)}}">apply</a>
                            </div>
                        </div>

                    </div>
                    @endforeach

                </div>
            </div>
        </div>

    </div>
</section>
@endsection
@extends('admin.master')
@section('title')
this is a bangladehs
@endsection
@section('content')

<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <h2>this is a cart header</h2>
                                <img src="" alt="">
                            </div>
                            <div class="card-body">
                                <p>bangladesh is a beautiful country</p>
                                <a href="" class="btn btn-success add-to-cart" data-id="{{ $product->id }}"
                                    data-name="{{ $product->name }}"
                                    data-price="{{ $product->price }}"
                                    data-image="{{ $product->image }}">add to cart</a>
                                <a href="" class="btn btn-success" style="float:right">buy now</a>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('script')
<script>
    $(document).on('click', '.add-to-cart', function(e) {
        e.preventDefault();
        var product_id = $(this).data('id');
        var product_name = $(this).data('name');
        var product_price = $(this).data('price');
        var product_image = $(this).data('image');
        var product_qty = 1; // Default quantity

        $.ajax({
            url: "{{ route('add.to.cart') }}",
            method: "POST",
            data: {
                _token: "{{ csrf_token() }}",
                id: product_id,
                name: product_name,
                price: product_price,
                image: product_image,
                qty: product_qty
            },
            success: function(response) {
                alert(response.success);
                window.location.href = "{{route('cart')}}";
            }
        });
    });
</script>
@endsection
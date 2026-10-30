@extends('admin.master')

@section('title')
this is a cart page
@endsection

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mb-4">Shopping Cart</h2>

                <!-- কার্ট টেবিল -->
                <div class="table-responsive shadow-sm rounded">
                    <table class="table table-bordered table-hover align-middle mb-0 bg-white">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Price</th>
                                <th style="width: 150px;">Quantity</th>
                                <th>Total</th>
                                <th>Update</th>
                                <th>Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $totalPrice = 0;
                            @endphp
                            @foreach($cartProducts as $id => $item)
                            @php
                            $subTotal = $item['price'] * $item['quantity'];
                            $totalPrice += $subTotal;
                            @endphp
                            <tr>
                                <!-- Product Image -->
                                <td class="text-center">
                                    <img src="{{ asset('uploads/product/' . $item['image']) }}" alt="Product Image" class="img-thumbnail" style="width: 70px; height: 70px; object-fit: cover;">
                                </td>

                                <!-- Product Name -->
                                <td>
                                    <h6 class="mb-0">{{ $item['name'] }}</h6>
                                </td>

                                <!-- Price -->
                                <td class="text-center">৳{{ $item['price'] }}</td>

                                <!-- Quantity -->
                                <td class="text-center">
                                    <div class="input-group input-group-sm" style="width: 120px; margin: 0 auto;">
                                        <button class="btn btn-outline-secondary cart-decrement" data-id="{{ $id }}" type="button">-</button>
                                        <input type="text" class="form-control text-center" value="{{ $item['quantity'] }}">
                                        <button class="btn btn-outline-secondary cart-increment" data-id="{{ $id }}" type="button">+</button>
                                    </div>
                                </td>

                                <!-- Total Price -->
                                <td class="text-center fw-bold text-primary">
                                    ৳{{ $item['price'] * $item['quantity'] }}
                                </td>

                                <!-- Update Button -->
                                <td class="text-center">
                                    <button class="btn btn-sm btn-primary">
                                        <i class="fas fa-sync-alt"></i> Update
                                    </button>
                                </td>

                                <!-- Remove Button -->
                                <td class="text-center">
                                    <button class="btn btn-sm btn-danger cart-remove" data-id="{{ $id }}">
                                        <i class="fas fa-trash"></i> Remove
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- কার্টের নিচে মোট দাম এবং চেকআউট বাটন -->
                <div class="row mt-4">
                    <div class="col-md-6">
                        <a href="{{ route('product.manage') }}" class="btn btn-outline-dark">
                            <i class="fas fa-arrow-left"></i> Continue Shopping
                        </a>
                    </div>
                    <div class="col-md-6 text-end">
                        <div class="card p-3 shadow-sm bg-light">
                            <h4>Cart Total: <span class="text-success">৳{{ $totalPrice ?? 0 }}</span></h4>
                            <hr>
                            <a href="{{route('checkout')}}" class="btn btn-success btn-lg w-100">Proceed to Checkout</a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection
<!-- খেয়াল করুন: @section('content') এখানে প্রপারলি শেষ করা হয়েছে -->


@section('script')
<script>
    $(document).ready(function(e) {

        // Quantity Increment
        $(document).on('click', '.cart-increment', function(e) {
            e.preventDefault();
            var productId = $(this).data('id');
            updateCartQuantity(productId, 1);
        });

        // Quantity Decrement
        $(document).on('click', '.cart-decrement', function(e) {
            e.preventDefault();
            var productId = $(this).data('id');
            updateCartQuantity(productId, -1);
        });

        function updateCartQuantity(productId, changeValue) {
            $.ajax({
                url: "{{ route('update.cart') }}",
                type: 'POST',
                data: {
                    _token: "{{ csrf_token() }}",
                    id: productId,
                    change: changeValue,
                },
                success: function(response) {
                    if (response.status == 'success') {
                        window.location.reload();
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        }

        // Cart Item Remove
        $(document).on('click', '.cart-remove', function(e) {
            e.preventDefault();
            var productId = $(this).data('id');

            if (confirm('Are you sure you want to delete this item?')) {
                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    type: 'POST',
                    data: {
                        _token: "{{ csrf_token() }}",
                        id: productId,
                    },
                    success: function(response) {
                        if (response.status == 'success') {
                            window.location.reload();
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            }
        });

    });
</script>
@endsection
@extends('admin.master')

@section('title')
Order Success
@endsection

@section('content')
<div class="container py-5 text-center">
    <div class="card shadow-sm border-0 p-5">
        <h2 class="text-success mb-3">Thank You!</h2>
        <p class="fs-5">Your order has been placed successfully.</p>
        <p class="fw-bold">Your Order ID is: </p>

        <div class="mt-4">
            <a href="{{ url('/') }}" class="btn btn-primary">Continue Shopping</a>
        </div>
    </div>
</div>
@endsection
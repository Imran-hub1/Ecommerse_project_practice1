@extends('admin.master')

@section('title')
This is a checkout page
@endsection

@section('content')
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                <!-- চেকআউট ফর্ম শুরু -->
                <form action="" id="orderForm" method="POST">
                    @csrf

                    <div class="card shadow-sm border-0">
                        <div class="card-header bg-dark text-white py-3">
                            <h3 class="mb-0">Checkout Information</h3>
                        </div>

                        <div class="card-body p-4">

                            <!-- Name Field -->
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-3">
                                    <label for="name" class="fw-bold">Full Name:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="name" class="form-control" id="name" placeholder="Enter your full name" required>
                                    <p></p>
                                </div>

                            </div>

                            <!-- Email Field -->
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-3">
                                    <label for="email" class="fw-bold">Email Address:</label>
                                </div>
                                <div class="col-md-9">
                                    <!-- ইমেইলের জন্য input type="email" ব্যবহার করা ভালো -->
                                    <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email address" required>
                                    <P></P>
                                </div>
                            </div>

                            <!-- Phone Field (নতুন যোগ করা হয়েছে, যা দরকার হতে পারে) -->
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-3">
                                    <label for="phone" class="fw-bold">Phone Number:</label>
                                </div>
                                <div class="col-md-9">
                                    <input type="text" name="phone" class="form-control" id="phone" placeholder="Enter your phone number" required>
                                    <P></P>
                                </div>
                            </div>

                            <!-- Delivery Address Field -->
                            <div class="row mb-3 align-items-center">
                                <div class="col-md-3">
                                    <label for="delivery_address" class="fw-bold">Delivery Address:</label>
                                </div>
                                <div class="col-md-9">
                                    <textarea name="delivery_address" class="form-control" id="delivery_address" rows="2" placeholder="Enter delivery address" required></textarea>
                                    <P></P>
                                </div>
                            </div>

                            <!-- Payment Method (চেকআউটে সাধারণত পেমেন্ট অপশন লাগে) -->
                            <div class="row mb-4 align-items-center">
                                <div class="col-md-3">
                                    <label class="fw-bold">Payment Method:</label>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_method" id="cod" value="COD" checked>
                                        <label class="form-check-label" for="cod">Cash On Delivery</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="payment_method" id="online" value="Online">
                                        <label class="form-check-label" for="online">Online Payment</label>
                                    </div>
                                </div>
                            </div>

                            <!-- Submit Button -->
                            <div class="row">
                                <div class="col-md-9 offset-md-3">
                                    <button type="submit" class="btn btn-success btn-lg w-100">Confirm Order</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
                <!-- ফর্ম শেষ -->

            </div>
        </div>
    </div>
</section>
@endsection
@section('script')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $('#orderForm').submit(function(e) {
        e.preventDefault();

        $.ajax({
            url: "{{route('customerProcess')}}",
            type: "POST",
            dataType: 'json',
            data: $('#orderForm').serializeArray(),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
            },
            success: function(response) {
                if (response.status == false) {
                    if (response.message) {
                        alert(response.message);
                    }
                    var errors = response.errors;
                    if (errors.name) {
                        $('#name').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.name);
                    } else {
                        $('#name').removeClass('is-invalid').siblings('p').addClass('invalid-feedback').html('');
                    }
                    if (errors.email) {
                        $('#email').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.email);
                    } else {
                        $('#email').removeClass('is-invalid').siblings('p').addClass('invalid-feedback').html('');
                    }
                    if (errors.phone) {
                        $('#phone').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.phone);
                    } else {
                        $('#phone').removeClass('is-invalid').siblings('p').addClass('invalid-feedback').html('');
                    }
                    if (errors.delivery_address) {
                        $('#delivery_address').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.delivery_address);
                    } else {
                        $('#delivery_address').removeClass('is-invalid').siblings('p').addClass('invalid-feedback').html('');
                    }

                } else {
                    window.location.href = response.redirect_url;
                }
            },

            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }

        });

    });
</script>
@endsection
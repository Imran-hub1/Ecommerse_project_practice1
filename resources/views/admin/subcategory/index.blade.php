@extends('admin.dashboard.master')
@section('title')
this is a subcategory page
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>bangladesh</h4>
                    </div>
                    <form action="" method="POST" id="subcategoryForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row-group">

                                <label for="" class="col-md-3">Category Name</label>
                                <select name="category_id" id="category_id" class="form-control">
                                    <option value=""> select category</option>
                                    @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                    @endforeach
                                    @endif

                                </select>
                                <p></p>

                                <!-- <div class="col-md-9">
                                    <input type="text" name="name" id="name" placeholder="enter your first name">
                                    <p></p>
                                </div> -->
                            </div>
                            <div class="row-group">

                                <label for="" class="col-md-3">SubCategory Name</label>

                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" placeholder="enter your first name">
                                    <p></p>
                                </div>

                            </div>
                            <div class="row-group">

                                <label for="" class="col-md-3">description</label>

                                <div class="col-md-9">
                                    <textarea type="text" name="description" id="description" placeholder="enter your first name"></textarea>
                                    <p></p>
                                </div>
                            </div>
                            <div class="row-group">

                                <label for="" class="col-md-3">Image</label>

                                <div class="col-md-9">
                                    <input type="file" name="image" id="image" placeholder="enter your first name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row-group">

                                <label for="" class="col-md-3">status</label>

                                <div class="col-md-9">
                                    <input type="radio" name="status" id="status_active" value="1" checked>
                                    <label for="status_active">Active</label>

                                    <input type="radio" name="status" id="status_block" value="0" style="margin-left: 15px;">
                                    <label for="status_block">Block</label>
                                </div>
                            </div>
                            <div class="row-group">
                                <div class="col-md-9">
                                    <button type="submit" href="" class="btn btn-success">submit</button>
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
    $('#subcategoryForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{route('subcategory.create')}}",
            type: 'post',
            contentType: false,
            processData: false,
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: 'json',
            success: function(response) {
                if (response.status == false) {
                    var errors = response.errors;
                    if (errors.category_id) {
                        $('#category_id').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.category_id);
                    } else {
                        $('#category_id').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
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
                    if (errors.image) {
                        $('#image').addClass('is-invalid').siblings('p').addClass('invalid-feedback').html(errors.image);
                    } else {
                        $('#image').removeClass('is-invalid').siblings('p').removeClass('invalid-feedback').html('');
                    }


                } else {
                    window.location.href = "{{route('subcategory')}}"
                }
            },
            error: function(jqXHR, exception) {
                console.log("Something went wrong");
            }
        });

    });
</script>
@endsection
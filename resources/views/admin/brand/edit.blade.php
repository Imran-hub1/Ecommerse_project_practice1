@extends('admin.dashboard.master')
@section('title')
this is a edit page
@endsection
@section('content')

<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <h4>edit form</h4>
                    </div>
                    <form action="" method="POST" id="brandupdateForm" enctype="multipart/form-data">
                        <div class="card-body">
                            <div class="row-group">

                                <label for="" class="col-md-3">Brand Name</label>

                                <div class="col-md-9">
                                    <input type="text" name="name" id="name" placeholder="enter your first name" value="{{$brand->name}}">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row-group">

                                <label for="" class="col-md-3">description</label>

                                <div class="col-md-9">
                                    <textarea type="text" name="description" id="description" placeholder="enter your first name">{{$brand->description}}</textarea>
                                    <p></p>
                                </div>
                            </div>
                            <div class="row-group">

                                <label for="" class="col-md-3">Image</label>

                                <div class="col-md-9">
                                    @if($brand->image)

                                    <div class="mb-2">
                                        <img src="{{ asset('uploads/brandImage/' . $brand->image) }}" width="100" class="img-thumbnail" alt="Current Image">
                                    </div>

                                    @endif
                                    <input type="file" name="image" id="image" placeholder="enter your first name">
                                    <p></p>
                                </div>
                            </div>
                            <div class="row-group">

                                <label for="" class="col-md-3">status</label>

                                <div class="col-md-9">
                                    <input type="radio" name="status" id="status_active" value="1" checked {{$brand->status == 1 ? 'selected':''}}>
                                    <label for="status_active">Active</label>

                                    <input type="radio" name="status" id="status_block" value="0" {{$brand->status == 0 ? 'selected' :''}} style="margin-left: 15px;">
                                    <label for="status_block">Block</label>
                                </div>
                            </div>
                            <div class="row-group">
                                <div class="col-md-9">
                                    <button type="submit" href="" class="btn btn-success">update</button>
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
    $('#brandupdateForm').submit(function(e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            url: "{{route('brand.update', $brand->id)}}",
            type: 'post',
            dataType: 'json',
            data: formData,
            contentType: false,
            processData: false,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') // Ensure CSRF token is sent
            },
            success: function(response) {
                if (response.status == false) {
                    var errors = response.errors;
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
                    window.location.href = "{{route('brand')}}";
                }
            },
            error: function(jqXHR, exception) {
                console.log('something went wrong');
            }

        });
    });
</script>
@endsection
@extends('admin.dashboard.master')
@section('title')
This is a manage page
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="row">
                    <div class="card-body py-4">
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Description</th>
                                        <th>Image</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($categories->isNotEmpty())
                                    @foreach($categories as $category)
                                    <tr>
                                        <td>{{$category->name}}</td>
                                        <td>{{$category->description}}</td>
                                        <td>
                                            @if($category->image)
                                            <img src="{{ asset('uploads/category/' . $category->image) }}" width="70" alt="Category Image" class="img-thumbnail">
                                            @else
                                            <span class="text-muted">No Image</span>
                                            @endif
                                        </td>
                                        <td>

                                            <a href="{{route('edit', $category->id)}}" class="btn btn-primary btn-sm">
                                                <i class="fa fa-edit"></i> Edit
                                            </a>


                                            <a href="#" onclick="deleteCategory({{ $category->id }})" class="btn btn-danger btn-sm">Delete</a>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@section('customjs')
<script>
    function deleteCategory(id) {
        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: "{{ url('/delete') }}/" + id, // Ba route('category.update', ':id') er moto kore route('category.delete', ':id') use korte paren
                type: 'DELETE',
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.status == true) {
                        // Success hole page reload ba list update kore dibe
                        window.location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(jqXHR, exception) {
                    console.log("Something went wrong");
                }
            });
        }
    }
</script>
@endsection
@endsection
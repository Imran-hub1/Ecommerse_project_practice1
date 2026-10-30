@extends('admin.dashboard.master')
@section('title')
this is a subcategoy page
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        subcategory manage page
                    </div>
                    <div class="card-body">
                        <table class="table table-border table-hover">
                            <thead>
                                <tr>
                                    <th>category name</th>
                                    <th>subcategory name</th>
                                    <th>description</th>
                                    <th>image</th>
                                    <th>action</th>

                                </tr>
                            </thead>
                            <tbody>
                                @if($subcategories->isNotEmpty())
                                @foreach($subcategories as $subcategory)
                                <tr>
                                    <td>{{$subcategory->category->name}}</td>
                                    <td>{{$subcategory->name}}</td>
                                    <td>{{$subcategory->description}}</td>
                                    <td>
                                        <img src="{{ asset('uploads/subcategoryImage/' . $subcategory->image) }}" alt="{{ $subcategory->name }}" width="50" height="50">
                                    </td>
                                    <td>
                                        <a href="{{route('subcategory.edit', $subcategory->id)}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>
                                        <a href="" onclick="deleteSubCategory({{$subcategory->id}})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
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
</section>
@endsection
@section("customjs")
<script>
    function deleteSubCategory(id) {
        if (confirm('Are you sure you want to delete this subcategory?')) {
            $.ajax({
                url: '/admin/subcategory/delete/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.error(error);
                    alert('An error occurred while deleting the subcategory.');
                }
            });
        }
    }
</script>
@endsection
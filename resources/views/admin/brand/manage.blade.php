@extends('admin.dashboard.master')
@section('title')
this is a manage page
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h3>this is a manage page</h3>
                    </div>
                    <div class="card-body">
                        <table class="table table-border table-hober">
                            <thead>
                                <tr>
                                    <th>brand name</th>
                                    <th>brand description</th>
                                    <th>image</th>
                                    <th>action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($brands->isNotEmpty())
                                @foreach($brands as $brand)
                                <tr>
                                    <td>{{$brand->name}}</td>
                                    <td>{{$brand->description}}</td>
                                    <td>
                                        @if($brand->image)
                                        <img src="{{ asset('uploads/brandImage/' . $brand->image) }}" width="70" alt="brand Image" class="img-thumbnail">
                                        @else
                                        <span class="text-muted">No Image</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{route('brand.edit', $brand->id)}}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i> Edit
                                        </a>


                                        <a href="#" onclick="confirmDelete({{ $brand->id }})" class="btn btn-danger btn-sm">
                                            <i class="fa fa-trash"></i> Delete
                                        </a>
                                    </td>
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
@section('customjs')
<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this brand?')) {
            $.ajax({
                url: '/admin/brand/delete/' + id,
                type: 'DELETE',
                data: {
                    "_token": "{{ csrf_token() }}"
                },
                success: function(response) {
                    if (response.status) {
                        alert(response.message);
                        location.reload();
                    } else {
                        alert(response.message);
                    }
                }
            });
        }
    }
</script>
@endsection
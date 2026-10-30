@extends('admin.master')
@section('title')
this is a beautiful country
@endsection
@section('content')
<section>
    <div class="row">
        <div class="col-md-12">
            <div class="row py-5">
                <table class="table table-border">
                    <thead>
                        <tr>
                            <td>image</td>
                            <td>qunatity</td>
                            <td>price</td>
                            <td>increase</td>
                            <td>remove</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>image</td>
                            <td>qunatity</td>
                            <td>price</td>
                            <td>increase</td>
                            <td>remove</td>
                        </tr>
                    </tbody>
                </table>
                <a href="{{route('checkout')}}" class="btn btn-success">process to checkout page</a>
            </div>
        </div>
    </div>
</section>
@endsection
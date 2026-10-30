@extends('admin.dashboard.master')
@section('title')
this is a bangladesh
@endsection
@section('content')
<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        card page
                    </div>
                    <div class="card-header">
                        <table class="table table-border table-hover">
                            <div class="tbody">
                                <tr>
                                    <th> Name </th>
                                    <th> Image </th>
                                    <th> Product </th>
                                    <th> Bangladesh</th>
                                </tr>
                            </div>
                            <div class="thead">
                                @foreach($orders as $order)
                                <tr>
                                    <td>{{$order->name}}</td>
                                    <td>{{$order->email}}</td>
                                    <td>{{$order->phone}}</td>
                                    <td>{{$order->delivery_address}}</td>
                                </tr>
                                @endforeach
                            </div>

                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
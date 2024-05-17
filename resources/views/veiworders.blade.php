@extends('layout')

@section('side')



<div class="row justify-content-center">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title">Bordered Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th style="width: 10px">id</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>image</th>
                            <th>quantity</th>
                        </tr>
                    </thead>
                    <tbody>

                        @foreach($orders as $order)
                        <tr>
                            <td>{{ $order->order_id}}</td>
                            <td>{{ $order->name}}</td>
                            <td>{{ $order->price}}</td>
                            <td><img src="{{ $order->image}}" style="width: 50px; height: 50px;"></td>
                            <td>{{ $order->quantity}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <!-- /.card ---->
    </div>
</div>


@endsection
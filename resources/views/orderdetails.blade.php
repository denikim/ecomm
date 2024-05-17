@extends('master')

@section('content')

<div class="page-contain shopping-cart">

    <!-- Main content -->
    <div id="main-content" class="main-content">
        <div class="container">


            <!--Cart Table-->
            <div class="shopping-cart-container">
                <div class="row">
                    <div class="col-lg-9 col-md-12 col-sm-12 col-xs-12">
                        <h3 class="box-title">Your orders</h3>
                        <table class="shop_table cart-form">
                            <thead>
                                <tr>
                                    <th class="product-name">Email</th>
                                    <th class="product-price">Amount</th>
                                    <th class="product-quantity">Status</th>
                                    <th class="product-subtotal">TRnsaction_id</th>
                                </tr>
                            </thead>
                            <tbody>
                         @foreach($orders as $order)
                                <tr class="cart_item">
                                    <td>{{$order->email }}</td>
                                    <td>£{{$order->amount }}
                                    </td>
                                    <td>{{$order->status }}
                                    </td>
                                    <td>{{$order->reference }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
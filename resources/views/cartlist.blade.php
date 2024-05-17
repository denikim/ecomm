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
                        <h3 class="box-title">Your cart items</h3>
                        <table class="shop_table cart-form">
                            <thead>
                                <tr>
                                    <th class="product-name">Product Name</th>
                                    <th class="product-price">Price</th>
                                    <th class="product-quantity">Quantity</th>
                                    <th class="product-subtotal">Total</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($carts as $cart)
                                <tr class="cart_item">
                                    <td class="product-thumbnail" data-title="Product Name">
                                        <a class="prd-thumb" href="#">
                                            <figure><img width="113" height="113" src="{{$cart->image}}" alt="shipping cart"></figure>
                                        </a>
                                        <a class="prd-name" href="#">{{$cart->product_name}}</a>
                                        <div class="action">
                                            <a href="{{ route('deletecart', $cart->id)}}" class="remove"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                        </div>
                                    </td>
                                    <td class="product-price" data-title="Price">
                                        <div class="price price-contain">
                                            <ins><span class="price-amount"><span class="currencySymbol">£</span>{{$cart->product_price}}</span></ins>

                                        </div>
                                    </td>
                                    <form method="POST" action="{{ route('updatecart',$cart->id)}}">

                                        @csrf
                                        <td class="product-quantity" data-title="Quantity">
                                            <div class="quantity-box type1">
                                                <div class="qty-input">
                                                    <input type="text" name="quantity" value="{{$cart->quantity}}" data-max_value="20" data-min_value="1" data-step="1">
                                                    
                                                </div>
                                                <button class="btn btn-primary btn-sm" type="submit">update</button>

                                            </div>
                                        </td>
                                    </form>
                                    <td class="product-subtotal" data-title="Total">
                                        <div class="price price-contain">
                                            <ins><span class="price-amount"><span class="currencySymbol">£</span>{{$cart->product_price*$cart->quantity }}</span></ins>

                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                                <form method="get" action="{{ route('clear')}}">
                                    <tr class="cart_item wrap-buttons">
                                        <td class="wrap-btn-control" colspan="4">
                                            <a href="{{route('index')}}"class="btn back-to-shop">Back to Shop</a>
                                            <button class="btn btn-clear" type="submit">clear all</button>
                                        </td>
                                    </tr>
                                </form>
                            </tbody>
                        </table>

                    </div>
                    <div class="col-lg-3 col-md-12 col-sm-12 col-xs-12">
                        <div class="shpcart-subtotal-block">
                            <div class="subtotal-line">
                                <b class="stt-name">Subtotal <span class="sub">{{ $carts->count()}} items</span></b>
                                <span class="stt-price">£{{ $carttotal }}</span>

                            </div>
                            <div class="subtotal-line">
                                <b class="stt-name">Shipping</b>
                                <span class="stt-price">0.00</span>
                            </div>
                            <div class="tax-fee">
                                <p class="title">Est. Taxes & Fees</p>
                                <p class="desc">Based on 56789</p>
                            </div>
                            @if($carts->count() == 0)
                            <div class="btn-checkout">
                                <a href="{{route('index')}}" class="btn checkout">continue shopping</a>
                            </div>
                            @else
                            <div class="btn-checkout">
                                <a href="{{ route('checkout')}}" class="btn checkout">Check out</a>
                            </div>
                            @endif

                            <div class="biolife-progress-bar">
                                <table>
                                    <tr>
                                        <td class="first-position">
                                            <span class="index">$0</span>
                                        </td>
                                        <td class="mid-position">
                                            <div class="progress">
                                                <div class="progress-bar" role="progressbar" style="width: 25%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                        </td>
                                        <td class="last-position">
                                            <span class="index">$99</span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <p class="pickup-info"><b>Free Pickup</b> is available as soon as today More about shipping and pickup</p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
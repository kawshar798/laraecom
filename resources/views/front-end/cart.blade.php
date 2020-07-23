@php

    @endphp


@extends("layouts.app")
@section('content')

    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Shopping Cart</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Shopping Cart Area Strat-->
    <div class="Shopping-cart-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">

                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="li-product-remove">remove</th>
                                    <th class="li-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="li-product-price">Unit Price</th>
                                    <th class="li-product-quantity">Quantity</th>
                                    <th class="li-product-subtotal">Total</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($contents as $product)
                                    <tr>
                                        <td class="li-product-remove"><a href="{{url('remove/cart/'.$product->rowId)}}"><i class="fa fa-times"></i></a></td>
                                        <td class="li-product-thumbnail"><a href="#"><img  style="width: 80px" src="{{asset($product->options->image)}}" alt="{{$product->name}}"></a></td>
                                        <td class="li-product-name"><a href="#">{{$product->name}}</a></td>
                                        <td class="li-product-price"><span class="amount">৳{{$product->price}}</span></td>
                                        <td class="quantity">
                                            <form action="{{url('update/cart/product')}}" method="post">
                                                @csrf
                                                <div class="d-flex">
{{--                                                    <div class="cart-plus-minus">--}}
                                                        <input  name="id" value="{{$product->rowId}}" type="text">
                                                        <input  name="qty" value={{$product->qty}} type="number">
{{--                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>--}}
{{--                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>--}}
{{--                                                    </div>--}}
                                                    <button type="submit" class="btn btn-sm">Udpate</button>
                                                </div>
                                            </form>


                                        </td>
                                        <td class="product-subtotal"><span class="amount">৳{{$product->price * $product->qty}} </span></td>
                                    </tr>
                                    @endforeach


                                </tbody>
                            </table>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="coupon-all">
                                    <div class="coupon">
                                        <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                        <input class="button" name="apply_coupon" value="Apply coupon" type="submit">
                                    </div>
                                    <div class="coupon2">
                                        <input class="button" name="update_cart" value="Update cart" type="submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-5 ml-auto">
                                <div class="cart-page-total">
                                    <h2>Cart totals</h2>
                                    <ul>
                                        <li>Subtotal <span>৳{{Cart::subtotal()}}</span></li>
                                        <li>Total <span>৳{{Cart::total()}} <span style="font-size: 10px"> (+tax)</span></span></li>
                                    </ul>
                                    <a href="#">Proceed to checkout</a>
                                </div>
                            </div>
                        </div>

                </div>
            </div>
        </div>
    </div>
@endsection

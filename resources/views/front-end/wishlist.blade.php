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
                    <li class="active">Wishlist</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!--Wishlist Area Strat-->
    <div class="wishlist-area pt-60 pb-60">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="#">
                        <div class="table-content table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th class="li-product-remove">remove</th>
                                    <th class="li-product-thumbnail">images</th>
                                    <th class="cart-product-name">Product</th>
                                    <th class="li-product-price">Unit Price</th>
                                    <th class="li-product-price">Color</th>
                                    <th class="li-product-price">Size</th>
                                    <th class="li-product-stock-status">Stock Status</th>
                                    <th class="li-product-add-cart">add to cart</th>
                                </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $product)
                                    <tr>
                                        <td class="li-product-remove"><a href="{{url('remove/product/wishlist/'.$product->id)}}"><i class="fa fa-times"></i></a></td>
                                        <td class="li-product-thumbnail">
                                            <a href="#">
                                                <img src="{{asset($product->image_one)}}" style="width: 50px" alt="">
                                            </a></td>
                                        <td class="li-product-name"><a href="#">{{$product->name}}</a></td>
                                        <td class="li-product-price"><span class="amount">{{$product->selling_price}}</span></td>
                                        <td class="li-product-price"><span class="amount">{{$product->color}}</span></td>
                                        <td class="li-product-price"><span class="amount">{{$product->size}}</span></td>
                                        <td class="li-product-stock-status">
                                            @if($product->quantity > 0)
                                                <span class="in-stock">in stock</span></td>
                                                @else
                                            <span class="out-stock">out stock</span>
                                                @endif
                                        <td class="li-product-add-cart"><a href="#">add to cart</a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

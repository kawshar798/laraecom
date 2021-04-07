@php
$setting = DB::table('settings')->first();
$shipping_charge = $setting->shipping_charge;
$vat = $setting->vat;
    @endphp


@extends("layouts.app")
@section('content')

    <!-- Begin Li's Breadcrumb Area -->
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Checkout Page</li>
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
                                                <input  name="id" value="{{$product->rowId}}" type="hidden">
                                                <input  name="qty" value={{$product->qty}} type="number">
                                                {{--                                                        <div class="dec qtybutton"><i class="fa fa-angle-down"></i></div>--}}
                                                {{--                                                        <div class="inc qtybutton"><i class="fa fa-angle-up"></i></div>--}}
                                                {{--                                                    </div>--}}

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

                                @if(Session::has('coupon'))
                                    @else
                                    <form  action="{{url('apply/coupon')}}" method="post">
                                        @csrf
                                        <div class="coupon">
                                            <input id="coupon_code" class="input-text" name="coupon_code" value="" placeholder="Coupon code" type="text">
                                            <input class="button" name="apply_coupon" value="Apply coupon" type="submit">

                                        </div>
                                    </form>
                                    @endif





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
                                    <li>Coupon <span>৳ @if(Session::has('coupon'))
                                                {{ Session::get('coupon')['discount'] }}
                                            @else
                                                0.00
                                            @endif<span style="font-size: 10px">
                                                (discount)
                                            </span></span></li>
                                    <li>Shipping Charge <span>৳{{isset($shipping_charge)?$shipping_charge:0.00}} </span></li>
                                    <li>Vat <span>৳{{isset($vat)?$vat:0.00}} </span></li>
                                    <li>Total
                                        @if(Session::has('coupon'))
                                            @php
                                               $discount  =  Session::get('coupon')['discount']
                                                @endphp
                                            @else
                                            @php
                                                $discount = 0;
                                            @endphp
                                            @endif
                                        <span>৳{{ (Cart::subtotal() + $vat + $shipping_charge) - $discount }} <span style="font-size: 10px"></span></span></li>
                                </ul>
                                <a href="{{url('user/checkout')}}">Proceed to checkout</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<section class="product-area li-laptop-product Special-product pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Section Area -->
            <div class="col-lg-12">
                <div class="li-section-title">
                    <h2>
                        <span>Hot Deals Products</span>
                    </h2>
                </div>
                <div class="row">
                    <div class="special-product-active owl-carousel">
                        @foreach($hots_daels as $hots_dael)
                            <div class="col-lg-12">
                                <!-- single-product-wrap start -->
                                <div class="single-product-wrap">
                                    <div class="product-image">
                                        <a href="{{url('product/details/'.$hots_dael->id.'/'.$hots_dael->name)}}">
                                            <img src="{{asset($hots_dael->image_one)}}" alt="{{$hots_dael->name}}">
                                        </a>
                                        <span class="sticker">New</span>
                                    </div>
                                    <div class="product_desc">
                                        <div class="product_desc_info">
                                            <div class="product-review">
                                                <h5 class="manufacturer">
                                                    <a href="shop-left-sidebar.html">{{isset($hots_dael->brand->name)?$hots_dael->brand->name:''}}</a>
                                                </h5>
                                                <div class="rating-box">
                                                    <ul class="rating">
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                        <li class="no-star"><i class="fa fa-star-o"></i></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <h4><a class="product_name" href="single-product.html">{{$hots_dael->name}}</a></h4>
                                            <div class="price-box">
                                                <span class="new-price new-price-2">{{$hots_dael->discount_price}}৳</span>
                                                <span class="old-price">{{$hots_dael->selling_price}}৳</span>
                                                @php
                                                    $reuslt = $hots_dael->selling_price - $hots_dael->discount_price;
                                                    $discount = $reuslt/$hots_dael->selling_price*100;
                                                @endphp
                                                <span class="discount-percentage">-{{intval($discount)}} %</span>
                                            </div>
                                            <div class="countersection">
                                                <div class="li-countdown"></div>
                                            </div>
                                        </div>
                                        <div class="add-actions">
                                            <ul class="add-actions-link">
                                                {{--                                                <li class="add-cart active"><a href="#" class="add_cart" data-id="{{$hots_dael->id}}">Add to cart</a></li>--}}
                                                <li class="add-cart active">    <a href="#" title="quick view" class="quick-view-btn"
                                                                                   id="{{$hots_dael->id}}" data-toggle="modal" data-target="#exampleModalCenter"
                                                                                   onclick="productView(this.id)">
                                                        Add to cart
                                                    </a>
                                                </li>
                                                <li>
                                                    <button class="links-details addWishlist" data-id="{{$hots_dael->id}}"  href="{{url('add/wishlist',$hots_dael->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></button>
                                                    {{--                                                    <a class="links-details" href="{{url('add/wishlist',$hots_dael->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></a>--}}
                                                </li>
                                                <li>
                                                    <a href="#" title="quick view" class="quick-view-btn"
                                                       id="{{$hots_dael->id}}" data-toggle="modal" data-target="#exampleModalCenter"
                                                       onclick="productView(this.id)">
                                                        <i class="fa fa-eye"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <!-- single-product-wrap end -->
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
            <!-- Li's Section Area End Here -->
        </div>
    </div>
</section>

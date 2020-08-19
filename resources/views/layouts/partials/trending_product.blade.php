<section class="product-area li-trending-product li-trending-product-2 pt-60 pb-45">
    <div class="container">
        <div class="row">
            <!-- Begin Li's Tab Menu Area -->
            <div class="col-lg-12">
                <div class="li-product-tab li-trending-product-tab">
                    <h2>
                        <span>Products</span>
                    </h2>
                    <ul class="nav li-product-menu li-trending-product-menu">
                        <li><a class="active" data-toggle="tab" href="#home1"><span> Trend</span></a></li>
                        <li><a data-toggle="tab" href="#home2"><span>Featured</span></a></li>
                        <li><a data-toggle="tab" href="#home3"><span>Top Rated</span></a></li>
                    </ul>
                </div>
                <!-- Begin Li's Tab Menu Content Area -->
                <div class="tab-content li-tab-content li-trending-product-content">
                    <div id="home1" class="tab-pane show fade in active">
                        <div class="row">
                            <div class="product-active owl-carousel">
                                @foreach($trends as $trend)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{asset($trend->image_one)}}" alt="{{$trend->name}}">
                                                </a>
                                                @php
                                                    $reuslt = $trend->selling_price - $trend->discount_price;
                                                    $discount = $reuslt/$trend->selling_price*100;
                                                @endphp
                                                @if($discount)
                                                    <span class="sticker">  {{intval($discount)}} %</span>
                                                @endif
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="shop-left-sidebar.html">{{isset($trend->brand->name)?$trend->brand->name:''}}</a>
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
                                                    <h4><a class="product_name" href="single-product.html">{{$trend->name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($trend->discount_price)

                                                            <span class="new-price"> ৳{{$trend->discount_price}}</span>
                                                        @endif
                                                        @if($trend->discount_price)

                                                            <span class="new-price"><del class="text-danger">৳{{$trend->selling_price}}<del></span>
                                                        @else
                                                            <span class="new-price"> ৳{{$trend->selling_price}}</span>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        {{--                                                <li class="add-cart active"><a href="#" class="add_cart" data-id="{{$hots_dael->id}}">Add to cart</a></li>--}}
                                                        <li class="add-cart active">    <a href="#" title="quick view" class="quick-view-btn"
                                                                                           id="{{$trend->id}}" data-toggle="modal" data-target="#exampleModalCenter"
                                                                                           onclick="productView(this.id)">
                                                                Add to cart
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button class="links-details addWishlist" data-id="{{$trend->id}}"  href="{{url('add/wishlist',$trend->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></button>
                                                            {{--                                                    <a class="links-details" href="{{url('add/wishlist',$hots_dael->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></a>--}}
                                                        </li>
                                                        <li>
                                                            <a href="#" title="quick view" class="quick-view-btn"
                                                               id="{{$trend->id}}" data-toggle="modal" data-target="#exampleModalCenter"
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
                    <div id="home2" class="tab-pane fade">
                        <div class="row">
                            <div class="product-active owl-carousel">

                                @foreach($featureds as $featured)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{asset($featured->image_one)}}" alt="{{$featured->name}}">
                                                </a>
                                                @php
                                                    $reuslt = $featured->selling_price - $featured->discount_price;
                                                    $discount = $reuslt/$featured->selling_price*100;
                                                @endphp
                                                @if($discount)
                                                    <span class="sticker">  {{intval($discount)}} %</span>
                                                @endif
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="shop-left-sidebar.html">{{isset($featured->brand->name)?$featured->brand->name:''}}</a>
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
                                                    <h4><a class="product_name" href="single-product.html">{{$featured->name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($featured->discount_price)

                                                            <span class="new-price"> ৳{{$featured->discount_price}}</span>
                                                        @endif
                                                        @if($featured->discount_price)

                                                            <span class="new-price"><del class="text-danger">৳{{$featured->selling_price}}<del></span>
                                                        @else
                                                            <span class="new-price"> ৳{{$featured->selling_price}}</span>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        {{--                                                <li class="add-cart active"><a href="#" class="add_cart" data-id="{{$hots_dael->id}}">Add to cart</a></li>--}}
                                                        <li class="add-cart active">    <a href="#" title="quick view" class="quick-view-btn"
                                                                                           id="{{$featured->id}}" data-toggle="modal" data-target="#exampleModalCenter"
                                                                                           onclick="productView(this.id)">
                                                                Add to cart
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button class="links-details addWishlist" data-id="{{$featured->id}}"  href="{{url('add/wishlist',$featured->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></button>
                                                            {{--                                                    <a class="links-details" href="{{url('add/wishlist',$hots_dael->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></a>--}}
                                                        </li>
                                                        <li>
                                                            <a href="#" title="quick view" class="quick-view-btn"
                                                               id="{{$featured->id}}" data-toggle="modal" data-target="#exampleModalCenter"
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
                    <div id="home3" class="tab-pane fade">
                        <div class="row">
                            <div class="product-active owl-carousel">

                                @foreach($best_rateds as $best_rated)
                                    <div class="col-lg-12">
                                        <!-- single-product-wrap start -->
                                        <div class="single-product-wrap">
                                            <div class="product-image">
                                                <a href="single-product.html">
                                                    <img src="{{asset($best_rated->image_one)}}" alt="{{$best_rated->name}}">
                                                </a>
                                                @php
                                                    $reuslt = $best_rated->selling_price - $best_rated->discount_price;
                                                    $discount = $reuslt/$best_rated->selling_price*100;
                                                @endphp
                                                @if($discount)
                                                    <span class="sticker">  {{intval($discount)}} %</span>
                                                @endif
                                                <span class="sticker">New</span>
                                            </div>
                                            <div class="product_desc">
                                                <div class="product_desc_info">
                                                    <div class="product-review">
                                                        <h5 class="manufacturer">
                                                            <a href="shop-left-sidebar.html">{{isset($best_rated->brand->name)?$best_rated->brand->name:''}}</a>
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
                                                    <h4><a class="product_name" href="single-product.html">{{$best_rated->name}}</a></h4>
                                                    <div class="price-box">
                                                        @if($best_rated->discount_price)

                                                            <span class="new-price"> ৳{{$best_rated->discount_price}}</span>
                                                        @endif
                                                        @if($best_rated->discount_price)

                                                            <span class="new-price"><del class="text-danger">৳{{$best_rated->selling_price}}<del></span>
                                                        @else
                                                            <span class="new-price"> ৳{{$best_rated->selling_price}}</span>
                                                        @endif


                                                    </div>
                                                </div>
                                                <div class="add-actions">
                                                    <ul class="add-actions-link">
                                                        {{--                                                <li class="add-cart active"><a href="#" class="add_cart" data-id="{{$hots_dael->id}}">Add to cart</a></li>--}}
                                                        <li class="add-cart active">    <a href="#" title="quick view" class="quick-view-btn"
                                                                                           id="{{$best_rated->id}}" data-toggle="modal" data-target="#exampleModalCenter"
                                                                                           onclick="productView(this.id)">
                                                                Add to cart
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <button class="links-details addWishlist" data-id="{{$best_rated->id}}"  href="{{url('add/wishlist',$best_rated->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></button>
                                                            {{--                                                    <a class="links-details" href="{{url('add/wishlist',$hots_dael->id)}}" title="Wishlist"><i class="fa fa-heart-o"></i></a>--}}
                                                        </li>
                                                        <li>
                                                            <a href="#" title="quick view" class="quick-view-btn"
                                                               id="{{$best_rated->id}}" data-toggle="modal" data-target="#exampleModalCenter"
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
                </div>
                <!-- Tab Menu Content Area End Here -->
            </div>
            <!-- Tab Menu Area End Here -->
        </div>
    </div>
</section>

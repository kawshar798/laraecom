
@php
$products = DB::table('products')->where('status','Active')->where('main_slider',1)->get();
$categories = DB::table('categories')->where('status','Active')->where('parent_id',0)->get();

@endphp


<div class="slider-with-banner">
    <div class="container">
        <div class="row">
            <!-- Begin Category Menu Area -->
            <div class="col-lg-3">
                <!--Category Menu Start-->
                <div class="category-menu">
                    <div class="category-heading">
                        <h2 class="categories-toggle"><span>categories</span></h2>
                    </div>
                    <div id="cate-toggle" class="category-menu-list">
                        <ul>
                            @foreach($categories as $category)
                                @php
                                    $sub_categories = DB::table('categories')->where('status','Active')->where('parent_id',$category->id)->get();
                                @endphp
                                <li class="right-menu"><a href="shop-left-sidebar.html">{{$category->name}}</a>
                                    @if($sub_categories)
                                <ul class="cat-mega-menu">
                                    <li class="right-menu cat-mega-title">
                                        <a href="shop-left-sidebar.html">{{$category->name}}</a>
                                        <ul>
                                            @foreach($sub_categories as $sub_categorie)
                                                <li><a href="#">{{$sub_categorie->name}}</a></li>
                                            @endforeach
                                        </ul>
                                    </li>
                                </ul>
                                @endif
                            </li>

                            <li><a href="#">Cameras</a></li>

                            @endforeach

                        </ul>
                    </div>
                </div>
                <!--Category Menu End-->
            </div>
            <!-- Category Menu Area End Here -->
            <!-- Begin Slider Area -->
            <div class="col-lg-9">
                <div class="slider-area pt-sm-30 pt-xs-30">
                    <div class="slider-active owl-carousel">
                        <!-- Begin Single Slide Area -->
                        @foreach($products as $product)
                        <div class="single-slide align-center-left animation-style-02 slider_bg" style="background: url({{asset($product->image_one)}})">
                            <div class="slider-progress"></div>
                            <div class="slider-content">
                                @php
                                    $reuslt = $product->selling_price - $product->discount_price;
                                    $discount = $reuslt/$product->selling_price*100;
                                @endphp
                                @if($product->discount_price)
                                <h5>Sale Offer <span>-{{intval($discount)}}% Off</span></h5>
                                @endif
                                <h2>{{$product->name}}</h2>
                                @if($product->discount_price)
                                    <h3 style="margin-bottom: 5px"><span>৳{{$product->discount_price}}</span></h3>
                                @endif
                                @if($product->discount_price)
                                    <h3><span><del class="text-danger">৳{{$product->selling_price}}<del></span></h3>
                                @else
                                    <h3> ৳{{$product->selling_price}}</h3>
                                @endif


                                <div class="default-btn slide-btn">
                                    <a class="links" href="">Shopping Now</a>

                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
            <!-- Slider Area End Here -->
        </div>
    </div>
</div>

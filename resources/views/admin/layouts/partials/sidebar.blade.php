<div class="sidebar sidebar-dark sidebar-main sidebar-expand-md">

    <!-- Sidebar mobile toggler -->
    <div class="sidebar-mobile-toggler text-center">
        <a href="#" class="sidebar-mobile-main-toggle">
            <i class="icon-arrow-left8"></i>
        </a>
        Navigation
        <a href="#" class="sidebar-mobile-expand">
            <i class="icon-screen-full"></i>
            <i class="icon-screen-normal"></i>
        </a>
    </div>
    <!-- /sidebar mobile toggler -->


    <!-- Sidebar content -->
    <div class="sidebar-content">

        <!-- User menu -->
        <div class="sidebar-user">
            <div class="card-body">
                <div class="media">
                    <div class="mr-3">
                        <a href="#"><img src="../../../../global_assets/images/placeholders/placeholder.jpg" width="38" height="38" class="rounded-circle" alt=""></a>
                    </div>

                    <div class="media-body">
                        <div class="media-title font-weight-semibold">Victoria Baker</div>
                        <div class="font-size-xs opacity-50">
                            <i class="icon-pin font-size-sm"></i> &nbsp;Santa Ana, CA
                        </div>
                    </div>

                    <div class="ml-3 align-self-center">
                        <a href="#" class="text-white"><i class="icon-cog3"></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- /user menu -->


        <!-- Main navigation -->
        <div class="card card-sidebar-mobile">
            <ul class="nav nav-sidebar" data-nav-type="accordion">

                <!-- Main -->
                <li class="nav-item-header"><div class="text-uppercase font-size-xs line-height-xs">Main</div> <i class="icon-menu" title="Main"></i></li>
                <li class="nav-item">
                    <a href="index.html" class="nav-link ">
                        <i class="icon-home4"></i>
                        <span>
									Dashboard
								</span>
                    </a>
                </li>

                <li class="nav-item nav-item-submenu @isset($nav)@if($nav=='category_create' || $nav=='category') nav-item-open nav-item-expanded	 @endif @endisset">
                    <a href="#" class="nav-link"><i class="icon-grid"></i> <span>Category</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Basic components">
                        <li class="nav-item "><a href="{{url('admin/category')}}" class="nav-link  @isset($nav)@if($nav=='category') active	 @endif @endisset ">List</a></li>
                        <li class="nav-item "><a href="{{url('admin/category/create')}}" class="nav-link @isset($nav)@if($nav=='category_create') active	 @endif @endisset ">Create</a></li>
                    </ul>
                </li>


                <li class="nav-item">
                    <a href="{{url('admin/brand')}}" class="nav-link @isset($nav)@if($nav=='brand') active	 @endif @endisset">
                        <i class="icon-home4"></i>
                        <span>Brand</span>
                    </a>
                </li>

                <li class="nav-item nav-item-submenu @isset($nav)@if($nav=='product_create' || $nav=='product') nav-item-open nav-item-expanded	 @endif @endisset">
                    <a href="#" class="nav-link"><i class="icon-grid"></i> <span>Product</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Basic components">
                        <li class="nav-item "><a href="{{url('admin/product')}}" class="nav-link  @isset($nav)@if($nav=='product') active	 @endif @endisset ">List</a></li>
                        <li class="nav-item "><a href="{{url('admin/product/create')}}" class="nav-link @isset($nav)@if($nav=='product_create') active	 @endif @endisset ">Create</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/coupon')}}" class="nav-link @isset($nav)@if($nav=='coupon') active	 @endif @endisset">
                        <i class="icon-home4"></i>
                        <span>Coupon</span>
                    </a>
                </li>
                <li class="nav-item nav-item-submenu @isset($nav)@if($nav=='post_category' || $nav=='post') nav-item-open nav-item-expanded	 @endif @endisset">
                    <a href="#" class="nav-link"><i class="icon-grid"></i> <span>Post</span></a>
                    <ul class="nav nav-group-sub" data-submenu-title="Basic components">
                        <li class="nav-item "><a href="{{url('admin/post/category')}}" class="nav-link  @isset($nav)@if($nav=='post_category') active	 @endif @endisset ">Post Category</a></li>
                        <li class="nav-item "><a href="{{url('admin/post')}}" class="nav-link @isset($nav)@if($nav=='post') active	 @endif @endisset ">Post</a></li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{url('admin/newsletter')}}" class="nav-link @isset($nav)@if($nav=='newsletter') active	 @endif @endisset">
                        <i class="icon-home4"></i>
                        <span>Newsletter</span>
                    </a>
                </li>




            </ul>
        </div>
        <!-- /main navigation -->

    </div>
    <!-- /sidebar content -->

</div>

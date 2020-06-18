@extends('layouts.app')
@push('css')
    <style>
        .dashboard-left .block-content {
            border: 1px solid #ddd;
            padding: 15px;
        }
        .dashboard-left .block-content ul li {
            display: flex;
            -webkit-transition: all .5s ease;
            transition: all .5s ease;
            position: relative;
        }
        .dashboard-left .block-content ul li:before {
            content: "\F105";
            display: inline-block;
            font-family: FontAwesome;
            font-style: normal;
            line-height: 1;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            width: 30px;
            height: 30px;
            text-align: center;
            font-size: 18px;
            font-weight: 700;
            margin-top: 3px;
        }
        .dashboard-left .block-content ul li.active, .dashboard-left .block-content ul li.active a {
            color: #ff4c3b;
        }
        .dashboard-right .dashboard {
            border: 1px solid #ddd;
            padding: 30px;
        }
        .dashboard-right .dashboard .page-title h2 {
            font-size: 22px;
            margin-bottom: 15px;
        }
        .dashboard-right .dashboard .welcome-msg p {
            margin-bottom: 0;
        }

        .dashboard-right p {
            color: #5f5f5f;
            line-height: 20px;
        }
        .dashboard .box-head h2 {
            font-size: 22px;
            margin: 20px 0 0;
            text-transform: capitalize;
            color: #333;
        }
    </style>
    @endpush
@section('content')

<div class="pt-5 pb-5">
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="dashboard-left">
                        <div class="block-content">
                            <ul>
                                <li class="active"><a href="#">Account Info</a></li>
                                <li><a href="#">Address Book</a></li>
                                <li><a href="#">My Orders</a></li>
                                <li><a href="#">My Wishlist</a></li>
                                <li><a href="#">Newsletter</a></li>
                                <li><a href="#">My Account</a></li>
                                <li><a href="#">Change Password</a></li>
                                <li class="last"><a href="{{route('logout')}}">Log Out</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="dashboard">
                            <div class="page-title">
                                <h2>My Dashboard</h2>
                            </div>
                            <div class="welcome-msg">
                                <p>Hello, MARK JECNO !</p><p>From your My Account Dashboard you have the ability to view a snapshot of your recent account activity and update your account information. Select a link below to view or edit information.</p>
                            </div>
                            <div class="box-account box-info">
                                <div class="box-head">
                                    <h2>Account Information</h2>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="box">
                                            <div class="box-title"><h3>Contact Information</h3><a href="#">Edit</a></div>
                                            <div class="box-content"><h6>MARK JECNO</h6><h6>MARk-JECNO@gmail.com</h6><h6><a href="#">Change Password</a></h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="box">
                                            <div class="box-title"><h3>Newsletters</h3><a href="#">Edit</a></div>
                                            <div class="box-content"><p>You are currently not subscribed to any newsletter.</p></div>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="box">
                                        <div class="box-title"><h3>Address Book</h3><a href="#">Manage Addresses</a></div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h6>Default Billing Address</h6>
                                                <address>You have not set a default billing address.<br>
                                                    <a href="#">Edit Address</a>
                                                </address>
                                            </div>
                                            <div class="col-sm-6">
                                                <h6>Default Shipping Address</h6>
                                                <address>You have not set a default shipping address.<br><a href="#">Edit Address</a>
                                                </address>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
@endsection

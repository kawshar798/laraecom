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
                @include('user.includes.usermenu')
                <div class="col-lg-9">
                    <div class="dashboard-right">
                        <div class="dashboard">
                            <div class="page-title">
                                <h2>My Dashboard</h2>
                            </div>
                            <div class="welcome-msg">
                                <p>From your account dashboard. you can easily check & view your recent orders, manage your shipping and billing addresses and edit your password and account details.</p>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
@endsection

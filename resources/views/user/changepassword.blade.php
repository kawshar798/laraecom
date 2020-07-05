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
                                    <h2>Change Password</h2>
                                </div>

                                <div class="box-account box-info">
                                    <form method="post" name="enq">
                                        <div class="row">

                                            <div class="form-group col-md-12">
                                                <label>Current Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="password" type="password">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>New Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="npassword" type="password">
                                            </div>
                                            <div class="form-group col-md-12">
                                                <label>Confirm Password <span class="required">*</span></label>
                                                <input required="" class="form-control" name="cpassword" type="password">
                                            </div>
                                            <div class="col-md-12">
                                                <button type="submit" class="btn btn-fill-out" name="submit" value="Submit">Save</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div>
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

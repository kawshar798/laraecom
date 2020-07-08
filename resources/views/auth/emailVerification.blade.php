@extends('layouts.app')

@section('content')
    <div class="breadcrumb-area">
        <div class="container">
            <div class="breadcrumb-content">
                <ul>
                    <li><a href="index.html">Home</a></li>
                    <li class="active">Email Verification</li>
                </ul>
            </div>
        </div>
    </div>
    <!-- Li's Breadcrumb Area End Here -->
    <!-- Begin Login Content Area -->
    <div class="page-section mb-60">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-12 col-md-12 col-xs-12 col-lg-6 mb-30">
                    <!-- Login Form s-->

                    <div class="login-form">
                        <form method="POST" action="{{url('email/verify') }}">
                            @csrf
                            <h4 class="login-title">Email Verify</h4>
                            <div class="row">
                                <div class="col-md-12 col-12 mb-20">
                                    <label>Email Address*</label>
                                    <input id="email" type="email" class="mb-0 form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email"   placeholder="Email Address" autofocus>
                                    @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="col-12 mb-20">
                                    <label>Verify Code</label>
                                    <input  type="text" class="mb-0 form-control @error('code') is-invalid @enderror" name="code" required>

                                    @error('code')
                                    <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>

                                <div class="col-md-12">
                                    <button class="register-button mt-0">Verify</button>
                                </div>
                            </div>
                        </form>

                    </div>


                </div>

            </div>
        </div>
    </div>


@endsection

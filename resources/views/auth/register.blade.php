@extends('layouts.master')

@section('content')
<div class="limiter" style="background-color:#121214;">
    <div class="container-login100 d-flex">
        <!-- Registration form on the right -->
        <div class="col-md-6 d-flex align-items-center justify-content-center order-md-2">
            <div class="card-body">
                <form class="login100-form validate-form" method="POST" action="{{ route('register') }}">
                    @csrf
                    <span class="login100-form-title p-b-43 text-white">
                        Đăng Ký
                    </span>
                    <div class="row mb-4">
                        <label for="name" class="col-md-4 col-form-label">{{ __('Tên') }}</label>
                        <div class="col-md-12">
                            <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                            @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="email" class="col-md-4 col-form-label">{{ __('Email') }}</label>
                        <div class="col-md-12">
                            <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">
                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="password" class="col-md-4 col-form-label">{{ __('Mật khẩu') }}</label>
                        <div class="col-md-12">
                            <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-4">
                        <label for="password-confirm" class="col-md-4 col-form-label">{{ __('Nhập lại mật khẩu') }}</label>
                        <div class="col-md-12">
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        </div>
                    </div>

                    <div class="container-login100-form-btn">
                        <button type="submit" class="login100-form-btn">
                            Đăng ký
                        </button>
                    </div>

                    <div class="text-center p-t-46 p-b-20 text-white">
                        <span class="txt2">
                            <p>Bạn đã có tài khoảng ? <a href="{{ route('login') }}">Đăng nhập</a></p>
                        </span>
                    </div>
                </form>
            </div>
        </div>

        <!-- Image on the left -->
        <div class="col-md-6 d-none d-md-block p-0 order-md-1">
            <img src="{{ asset('images/login_background.jpg') }}" class="img-fluid h-100" alt="Side Image">
        </div>
    </div>
</div>
@endsection

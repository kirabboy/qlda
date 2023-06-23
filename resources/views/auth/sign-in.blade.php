{{-- <!doctype html>
<html lang="en">

<head>
    <title>Login</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

    <link rel="stylesheet" href="auth-css/style.css">

</head> --}}
@extends('layout')
@section('content')

<body class="img js-fullheight" style="background-image: url(auth-images/bg.jpg);">
    <section class="ftco-section">
        @if (count($errors))
            <div class="alert alert-danger">
                @foreach ($errors->all() as $err)
                    {{ $err }} <br>
                @endforeach
            </div>
        @endif
        @if (session('error'))
        {{ session('success') }}
        @endif
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6 col-lg-4">
                    <div class="login-wrap p-0">
                        <h3 class="mb-4 text-center">ĐĂNG NHẬP</h3>
                        <form class="signin-form" action="{{ route('signin') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="email" class="form-control" placeholder="Email" >
                            </div>
                            <div class="form-group">
                                <input id="password-field" type="password" name="password" class="form-control"
                                    placeholder="Password" >
                                <span toggle="#password-field"
                                    class="fa fa-fw fa-eye field-icon toggle-password"></span>
                            </div>

                            @if (session('error'))
                                {{ session('error') }}
                            @endif

                            <div class="form-group">
                                <button type="submit" class="form-control btn btn-primary submit px-3">Sign
                                    In</button>
                            </div>
                            <div class="form-group d-md-flex">
                                <div class="w-50">
                                    <label class="checkbox-wrap checkbox-primary">Ghi Nhớ Đăng Nhập
                                        <input type="checkbox" checked>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                                <div class="w-50 text-md-right">
                                    <a href="#" style="color: #fff">Quên Mật Khẩu?</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="auth-js/jquery.min.js"></script>
    <script src="auth-js/popper.js"></script>
    <script src="auth-js/bootstrap.min.js"></script>
    <script src="auth-js/main.js"></script>

</body>
@stop
{{-- </html> --}}

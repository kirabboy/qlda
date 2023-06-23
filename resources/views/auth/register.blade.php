{{-- <html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <link rel="icon" href="{{ asset('images/logomevivumoi.png') }}">
    <title>Sign in</title>
    <!-- CSS files -->
    <link href="{{ asset('dist/css/tabler-flags.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-payments.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/tabler-vendors.min.css?1674944402') }}" rel="stylesheet" />
    <link href="{{ asset('dist/css/demo.min.css?1674944402') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">

</head> --}}
@extends('layout')
@section('content')
  
<body class=" d-flex flex-column">
    <script src="{{ asset('dist/js/demo-theme.min.js?1674944402') }}"></script>
    <div class="page page-center">
        <div class="container container-tight pt-2">
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Register Now</h2>
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ 
                                        $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form action="{{ route('register') }}" id="validate_form_login" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" name="fullname" class="form-control" placeholder="Full name">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">User Name</label>
                                    <input type="text" name="username" class="form-control" placeholder="User name">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Email</label>
                                    <input type="text" name="email" class="form-control" placeholder="Email">
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Phone</label>
                                    <input type="text" name="phone" class="form-control" placeholder="Phone">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                          <div class="col-xl-6">
                            <div class="mb-3">
                                <label class="form-label">Address</label>
                                <input type="text" name="address" class="form-control" placeholder="Address"
                                    data-parsley-pattern="^[a-zA-Z0-9, ]+$" >
                            </div>
                          </div>
                          <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Birthday</label>
                                    <input type="text" name="birthday" class="form-control" placeholder="Birthday">
                                </div>
                          </div>
                        </div>
                        <div class="row">
                        <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">
                                        Password
                                    </label>
                                    <input type="password" class="form-control" placeholder="Your password"
                                        id="password" name="password" >
                                </div>
                            </div>
                          <div class="col-xl-6">
                                <div class="mb-3">
                                    <label class="form-label">Gender</label>
                                    <!-- <input type="text" name="gender" class="form-control" placeholder="Your Gender"> -->
                                    <select class="form-control" name="gender">
                                        <option value="">Select gender</option>
                                        <option value="0">Male</option>
                                        <option value="1">Female</option>
                                    </select>
                                </div>
                          </div>
                          <div class="col-xl-12">
                            <div class="mb-3">
                                <label class="form-label">Role</label>
                                <!-- <input type="text" name="gender" class="form-control" placeholder="Your Gender"> -->
                                <select class="form-control" name="roles">
                                    <option value="">Select role</option>
                                    <option value="1">Employee</option>
                                    <option value="2">Admin Project</option>
                                    <option value="3">Supper Admin</option>
                                </select>
                            </div>
                      </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </div>
                    </form>
                    <div class="text-center text-muted mt-3">
                        Already have account? <a href="{{route('signin')}}" tabindex="-1">Sign in</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</body>

@stop
{{-- 
</html> --}}

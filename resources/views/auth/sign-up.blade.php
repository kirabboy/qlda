@extends('layouts.layout-auth')
@section('content')

    <body class=" d-flex flex-column">
        <script src="{{ asset('dist/js/demo-theme.min.js?1674944402') }}"></script>
        <div class="page page-center">
            <div class="container pt-5">
                <div class="text-center mb-4">
                    <a href="." class="navbar-brand navbar-brand-autodark"><img
                            src="{{ asset('dist/img/logomevivumoi.png') }}" height="36" alt=""></a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">{{ __('Create new account') }}</h2>
                        <form action="{{ route('sign-up.action') }}" method="POST" data-parsley-validate id="validate_form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-control-label">{{ __('Full Name') }}</label>
                                        <input type="text" name="fullname" class="form-control" placeholder="{{ __('Full Name') }}"
                                            required="required" data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-control-label">{{ __('User Name') }}</label>
                                        <input type="text" name="username" class="form-control" placeholder="{{ __('User Name') }}"
                                            required="required" data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-control-label">{{ __('Email') }}</label>
                                        <input type="text" name="email" class="form-control" placeholder="{{ __('Email') }}"
                                            required="required" data-parsley-required-message="{{ __('required') }}"
                                            data-parsley-type="email"
                                            data-parsley-type-message="{{ __('Invalid email') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-control-label">{{ __('Phone') }}</label>
                                        <input type="text" name="phone" class="form-control" placeholder="{{ __('Phone') }}"
                                            required="required" data-parsley-required-message="{{ __('required') }}"
                                            data-parsley-length="[10, 10]"
                                            data-parsley-length-message="{{ __('Phone validate') }}"
                                            data-parsley-type="digits"
                                            data-parsley-type-message="{{ __('Phone validate length') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-control-label">{{__('Birthday')}}</label>
                                        <input type="date" name="birthday" class="form-control" placeholder="{{__('Birthday')}}"
                                            required data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{__('Gender')}}</label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="0"
                                                name="gender" checked>
                                            <span class="form-check-label">{{__('Male')}}</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="1"
                                                name="gender">
                                            <span class="form-check-label">{{__('Female')}}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label class="form-control-label">{{__('Address')}}</label>
                                <input type="text" name="address" class="form-control" placeholder="{{__('Address')}}" required
                                    data-parsley-required-message="{{ __('required') }}">
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-2">
                                        <label class="form-control-label">
                                            {{__('Password')}}
                                        </label>
                                        <input type="password" class="form-control" placeholder="{{__('Password')}}"
                                            id="password" name="password" required
                                            data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-control-label">{{__('Confirm password')}}</label>
                                        <input type="password" name="confirm_password" class="form-control"
                                            placeholder="{{__('Confirm password')}}" required
                                            data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary float-end">{{__('Register')}}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
                {{__('Do you already have an account ?')}}<a href="{{ route('sign-in') }}" tabindex="-1"> {{__('Sign in')}}</a>
            </div>
        </div>
    @endsection

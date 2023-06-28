@extends('layouts.layout-auth')
@section('content')

    <body class=" d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <a href="." class="navbar-brand navbar-brand-autodark"><img
                            src="{{ asset('dist/img/logomevivumoi.png') }}" height="36" alt=""></a>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">{{ __('Reset password') }}</h2>
                        <form action="" method="POST" autocomplete="off" novalidate data-parsley-validate
                            id="validate_form">
                            @csrf
                            <!--New password-->
                            <div class="mb-3">
                                <label for="newPasswordInput" class="form-control-label">{{ __('New Password') }}</label>
                                <input name="password" type="password" class="form-control" id="newPasswordInput"
                                    placeholder="{{ __('New Password') }}" required
                                    data-parsley-required-message="{{ __('required') }}">
                            </div>
                            <!--Confirm new password-->
                            <div class="mb-3">
                                <label for="confirmNewPasswordInput"
                                    class="form-control-label">{{ __('Confirm New Password') }}</label>
                                <input name="password_confirmation" type="password" class="form-control"
                                    id="confirmNewPasswordInput" placeholder="{{ __('Confirm New Password') }}" required
                                    data-parsley-required-message="{{ __('required') }}"
                                    data-parsley-equalto="#newPasswordInput"
                                    data-parsley-equalto-message="{{ __('This value should be the same') }}">
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">{{ __('Update') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center text-muted mt-3">
                    {{ __('No account?') }} <a href="{{ route('sign-up') }}" tabindex="-1">{{ __('Sign up') }}</a>
                </div>
            </div>
        </div>

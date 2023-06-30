@extends('layouts.layout-auth')
@section('content')

    <body class=" d-flex flex-column">
        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <x-logo/>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <h2 class="h2 text-center mb-4">{{ __('Login to your account') }}</h2>
                        <form action="{{ route('sign-in.action') }}" method="POST" autocomplete="off" novalidate
                            data-parsley-validate id="validate_form">
                            @csrf
                            <div class="mb-3">
                                <label class="form-label">{{ __('Username or Email') }}</label>
                                <input type="text" class="form-control" name="username":value="old('username')"
                                    placeholder="username or email" autocomplete="off" required autofocus
                                    required="required" data-parsley-required-message="{{ __('required') }}">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">
                                    {{ __('Password') }}
                                    <span class="form-label-description">
                                        <a href="{{ route('forgot.password') }}">{{ __('I forgot password') }}</a>
                                    </span>
                                </label>
                                <div class="input-group input-group-flat">
                                    <input type="password" class="form-control" name="password" id="password"
                                        placeholder="Your password" autocomplete="off">
                                    <span class="input-group-text">
                                        <a href="#" class="link-secondary" title="Show password"
                                            onclick="showPassword()" data-bs-toggle="tooltip">
                                            <!-- Download SVG icon from http://tabler-icons.io/i/eye -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24"
                                                height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor"
                                                fill="none" stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M12 12m-2 0a2 2 0 1 0 4 0a2 2 0 1 0 -4 0" />
                                                <path
                                                    d="M22 12c-2.667 4.667 -6 7 -10 7s-7.333 -2.333 -10 -7c2.667 -4.667 6 -7 10 -7s7.333 2.333 10 7" />
                                            </svg>
                                        </a>
                                    </span>
                                </div>
                            </div>
                            {{-- <div class="mb-2">
                <label class="form-check">
                  <input type="checkbox" class="form-check-input"/>
                  <span class="form-check-label">Remember me on this device</span>
                </label>
              </div> --}}
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary w-100">{{ __('Sign in') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="text-center text-muted mt-3">
                    {{ __('No account?') }} <a href="{{ route('sign-up') }}" tabindex="-1">{{ __('Sign up') }}</a>
                </div>
            </div>
        </div>

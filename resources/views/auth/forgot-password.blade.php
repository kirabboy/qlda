@extends('layouts.layout-auth')
@section('content')

    <body class=" d-flex flex-column">
        <script src="{{ asset('dist/js/demo-theme.min.js?1674944402') }}"></script>
        <div class="page page-center">
            <div class="container container-tight py-4">
                <div class="text-center mb-4">
                    <x-logo />
                </div>
                <form class="card card-md" action="{{ route('post.forgot.password') }}" method="POST" data-parsley-validate
                    id="validate_form">
                    @csrf
                    <div class="card-body">
                        <p class="text-muted mb-4">
                            {{ __('Enter your email address and please check your email to set up a new password.') }}</p>
                        <div class="mb-3">
                            <input type="email" name="email" class="form-control"
                                placeholder="{{ __('Email address') }}" required="required"
                                data-parsley-required-message="{{ __('required') }}" data-parsley-type="email"
                                data-parsley-type-message="{{ __('Email validate') }}">
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">
                                <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                    viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                    stroke-linecap="round" stroke-linejoin="round">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M3 5m0 2a2 2 0 0 1 2 -2h14a2 2 0 0 1 2 2v10a2 2 0 0 1 -2 2h-14a2 2 0 0 1 -2 -2z" />
                                    <path d="M3 7l9 6l9 -6" />
                                </svg>
                                {{ __('Send') }}
                            </button>
                        </div>
                    </div>
                </form>
                <div class="text-center text-muted mt-3">
                    {{ __('Forget it') }}, <a href="{{ route('sign-in') }}">{{ __('send me back') }}</a>
                    {{ __('to the sign in screen.') }}
                </div>
            </div>
            <div class="d-inline pt-5">
                @foreach (config('app.available_locales') as $locale => $language)
                    <a href="{{ url('locale', $locale) }}">{{ __($language) }} </a>
                @endforeach
            </div>
        </div>
    @endsection

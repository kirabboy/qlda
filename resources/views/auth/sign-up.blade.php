@extends('layouts.layout-auth')
@section('content')

    <body class=" d-flex flex-column">
        <script src="{{ asset('dist/js/demo-theme.min.js?1674944402') }}"></script>
        <div class="page page-center">
            <div class="container px-5">
                <div class="text-center mb-4">
                    <x-logo/>
                </div>
                <div class="card card-md">
                    <div class="card-body">
                        <form action="{{ route('sign-up.action') }}" method="POST" data-parsley-validate id="validate_form"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <input type="text" name="fullname" class="form-control"
                                            placeholder="{{ __('Fullname') }}" required="required"
                                            data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <input type="text" name="username" class="form-control"
                                            placeholder="{{ __('User name') }}" required="required"
                                            data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <input type="text" name="email" class="form-control"
                                            placeholder="{{ __('Email') }}" required="required"
                                            data-parsley-required-message="{{ __('required') }}" data-parsley-type="email"
                                            data-parsley-type-message="{{ __('Invalid email') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <input type="text" name="phone" class="form-control"
                                            placeholder="{{ __('Phone') }}" required="required"
                                            data-parsley-required-message="{{ __('required') }}"
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
                                        <label class="form-control-label">{{ __('Birthday') }}</label>
                                        <div class="row g-2">
                                            <div class="col-3">
                                                <select name="day" class="form-select" required
                                                    data-parsley-required-message="{{ __('required') }}">
                                                    <option value="">{{ __('Day') }}
                                                    </option>
                                                    @for ($i = 1; $i <= 31; $i++)
                                                        <option value="{{ $i }}">
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                            <div class="col-4">
                                                <select name="month" class="form-select" required
                                                    data-parsley-required-message="{{ __('required') }}">
                                                    <option value="">{{ __('Month') }}</option>
                                                    <option value="1">01 - January</option>
                                                    <option value="2">02 - February</option>
                                                    <option value="3">03 - March</option>
                                                    <option value="4">04 - April</option>
                                                    <option value="5">05 - May</option>
                                                    <option value="6">06 - June</option>
                                                    <option value="7">07 - July</option>
                                                    <option value="8">08 - August</option>
                                                    <option value="9">09 - September</option>
                                                    <option value="10">10 - October</option>
                                                    <option value="11">11 - November</option>
                                                    <option value="12">12 - December</option>
                                                </select>
                                            </div>
                                            <div class="col-5">
                                                <select name="year" class="form-select" required
                                                    data-parsley-required-message="{{ __('required') }}">
                                                    <option value="">{{ __('Year') }}</option>
                                                    @for ($i = 1890; $i <= 2015; $i++)
                                                        <option value="{{ $i }}">
                                                            {{ $i }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <label class="form-label">{{ __('Gender') }}</label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="0" name="gender"
                                                checked>
                                            <span class="form-check-label">{{ __('male') }}</span>
                                        </label>
                                        <label class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" value="1"
                                                name="gender">
                                            <span class="form-check-label">{{ __('female') }}</span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <input type="text" name="address" class="form-control"
                                    placeholder="{{ __('Address') }}" required
                                    data-parsley-required-message="{{ __('required') }}">
                            </div>
                            <div class="row">
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <input name="password" type="password" class="form-control" id="newPasswordInput"
                                            placeholder="{{ __('New Password') }}" required
                                            data-parsley-required-message="{{ __('required') }}">
                                    </div>
                                </div>
                                <div class="col-xl-6">
                                    <div class="mb-3">
                                        <input name="password_confirmation" type="password" class="form-control"
                                            id="confirmNewPasswordInput" placeholder="{{ __('Confirm New Password') }}" required
                                            data-parsley-required-message="{{ __('required') }}"
                                            data-parsley-equalto="#newPasswordInput"
                                            data-parsley-equalto-message="{{ __('This value should be the same') }}">
                                    </div>
                                </div>
                            </div>
                            <div class="form-footer">
                                <button type="submit" class="btn btn-primary float-end">{{ __('Sign up') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="text-center text-muted mt-3">
                {{ __('Do you already have an account ?') }}<a href="{{ route('sign-in') }}" tabindex="-1">
                    {{ __('Sign in') }}</a>
            </div>
            <div class="d-inline">
                @foreach (config('app.available_locales') as $locale => $language)
                    <a href="{{ url('locale', $locale) }}">{{ __($language) }}  </a>
                @endforeach
            </div>
        </div>
    @endsection

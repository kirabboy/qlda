@extends('layouts.layout-main')
@section('content')
    <x-sidebar />
    <div class="page-wrapper">
        <x-top-bar />
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                            style="color: #616f82">{{ __('dashboard') }} </a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('account.index') }}"
                                            style="color: #616f82">{{ __('Account') }} </a></li>
                                    <li class="breadcrumb-item active">{{ __('add') }}</li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('account.store') }}" method="POST" enctype="multipart/form-data"
                                        data-parsley-validate id="validate_form_cr">
                                        @csrf
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-9">
                                                <div class="row">
                                                    <!-- user name-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('User name') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="username"
                                                                placeholder="{{ __('User name') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- full name -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Full name') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="fullname"
                                                                placeholder="{{ __('Full name') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- email -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Email') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                data-parsley-type="email"
                                                                data-parsley-type-message="{{ __('Email validate') }}"
                                                                class="form-control" name="email"
                                                                placeholder="{{ __('Email') }}" />
                                                        </div>
                                                    </div>

                                                    <!-- phone -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Phone') }}:</label>
                                                            <input type="text" name="phone" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                data-parsley-length="[10, 10]"
                                                                data-parsley-length-message="{{ __('Phone validate') }}"
                                                                data-parsley-type="digits"
                                                                data-parsley-type-message="{{ __('Phone validate length') }}"
                                                                class="form-control" placeholder="{{ __('Phone') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- roles -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Role') }}:</label>
                                                            <select name="roles" class="form-select" required
                                                                data-parsley-required-message="{{ __('required') }}">
                                                                <option value="">-- {{ __('Role') }} --</option>
                                                                <option value="1">{{ __('Employee') }}</option>
                                                                <option value="2">{{ __('admin_project') }}</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- birthday-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Brithday') }}:</label>
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
                                                                        <option value="">{{ __('Month') }}
                                                                        </option>
                                                                        @for ($i = 1; $i <= 12; $i++)
                                                                            <option value="{{ $i }}">
                                                                                {{ __($i) }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                                <div class="col-5">
                                                                    <select name="year" class="form-select" required
                                                                        data-parsley-required-message="{{ __('required') }}">
                                                                        <option value="">{{ __('Year') }}
                                                                        </option>
                                                                        @for ($i = 1890; $i <= 2015; $i++)
                                                                            <option value="{{ $i }}">
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- gender -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Gender') }}:</label><br>
                                                            @foreach ($gender as $gender)
                                                                <label class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        value="{{ $gender->value }}" name="gender"
                                                                        required
                                                                        data-parsley-required-message="{{ __('required') }}">
                                                                    <span
                                                                        class="form-check-label">{{ __($gender->key) }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>

                                                    <!-- address -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Address') }}:</label>
                                                            <input type="text" name="address" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" placeholder="{{ __('Address') }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-control-label">
                                                                {{ __('Password') }}
                                                            </label>
                                                            <input name="password" type="password" class="form-control"
                                                                id="newPasswordInput" placeholder="{{ __('Password') }}"
                                                                required
                                                                data-parsley-required-message="{{ __('required') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label
                                                                class="form-control-label">{{ __('Confirm password') }}</label>
                                                            <input name="password_confirmation" type="password"
                                                                class="form-control" id="confirmNewPasswordInput"
                                                                placeholder="{{ __('Confirm Password') }}" required
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                data-parsley-equalto="#newPasswordInput"
                                                                data-parsley-equalto-message="{{ __('This value should be the same') }}">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Post') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <button type="submit" class="btn btn-primary"
                                                            title=" {{ __('add') }}">
                                                            {{ __('add') }}
                                                        </button>
                                                    </div>
                                                </div>
                                                <!-- file upload -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Avatar') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <input type="text" class="d-none" name="avatar"
                                                            value="avatar-user.png" id="input_avatar_account">
                                                        <img src="{{ asset('file-upload/images/default-image.png') }}"
                                                            alt="" id="avatar">
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

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
                                    <li class="breadcrumb-item active">{{ __('Profile') }}</li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header justify-content-between">
                                    <h2 class="mb-0">{{ __('Profile') }}</h2>
                                </div>
                                <form action="{{ route('update.profile', auth()->user()->id) }}" method="POST"
                                    enctype="multipart/form-data" data-parsley-validate>
                                    <div class="card-body">
                                        @csrf
                                        @method('PUT')
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-3">
                                                <div class="col-12">
                                                    <div class="card-body text-center">
                                                        <input type="text" class="d-none" name="avatar"
                                                            value="{{ auth()->user()->avatar }}" id="input_profile">
                                                        <img src="{{ asset('file-upload/images/' . auth()->user()->avatar) }}"
                                                            id="file_upload_profile" alt="avatar"
                                                            class="rounded-circle img-fluid"
                                                            style="width: 150px; height: 150px;"> <br><br>
                                                        <button type="button" id="profile"
                                                            class="btn btn-outline-info">{{ __('File upload') }}</button>
                                                    </div>
                                                </div>
                                                <div class="col-12 pt-3">
                                                    <div class="card-body text-center">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <!-- fullname -->
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Full name') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="fullname"
                                                                value="{{ auth()->user()->fullname }}"
                                                                placeholder="{{ __('Full name') }}" />
                                                        </div>
                                                    </div>
                                                    <!-- user name -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('User name') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" placeholder="{{ __('User name') }}"
                                                                name="username" value="{{ auth()->user()->username }}">
                                                        </div>
                                                    </div>
                                                    <!-- email -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Email') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" placeholder="{{ __('Email') }}"
                                                                data-parsley-type="email"
                                                                data-parsley-type-message="{{ __('Email validate') }}"
                                                                name="email" value="{{ auth()->user()->email }}">
                                                        </div>
                                                    </div>
                                                    <!-- phone -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Phone') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" placeholder="{{ __('Phone') }}"
                                                                data-parsley-length="[10, 10]"
                                                                data-parsley-length-message="{{ __('Phone validate') }}"
                                                                data-parsley-type="digits"
                                                                data-parsley-type-message="{{ __('Phone validate length') }}"
                                                                name="phone" value="{{ auth()->user()->phone }}">
                                                        </div>
                                                    </div>
                                                    <!-- birth day -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Birthday') }}:</label>
                                                            <input type="date" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" placeholder="{{ __('Birthday') }}"
                                                                name="birthday" value="{{ auth()->user()->birthday }}">
                                                        </div>
                                                    </div>
                                                    <!-- gender -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{ __('Gender') }}</label>
                                                            @foreach ($gender as $gender)
                                                                <label class="form-check form-check-inline">
                                                                    <input class="form-check-input" type="radio"
                                                                        value="{{ $gender->value }}" name="gender"
                                                                        {{ $gender->value == auth()->user()->gender->value ? "checked" : '' }}>
                                                                    <span
                                                                        class="form-check-label">{{ __($gender->key) }}</span>
                                                                </label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                    <!-- address -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Address') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" placeholder="{{ __('Address') }}"
                                                                name="address" value="{{ auth()->user()->address }}">
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="card-footer bg-transparent mt-auto">
                                        <div class="btn-list justify-content-center">
                                            <button type="submit" class="btn btn-primary" title="{{ __('Post') }}">
                                                {{ __('Post') }}
                                            </button>
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
@endsection

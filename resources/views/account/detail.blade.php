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
                                            style="color: #616f82">{{ __('Account') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('Account detail') }}</li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header justify-content-between">
                                    <h2 class="mb-0">{{ __('Account detail') }}</h2>
                                </div>
                                <form action="{{ route('account.update', $admin->id) }}" method="POST"
                                    enctype="multipart/form-data" data-parsley-validate>
                                    <div class="card-body">
                                        @csrf
                                        @method('PUT')
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-3">
                                                <div class="col-12">
                                                    <div class="card-body text-center">
                                                        <img src="{{ asset('file-upload/images/' . $admin->avatar) }}"
                                                            id="file_upload_profile" alt="avatar"
                                                            class="avatar avatar-sm"
                                                            style="width: 200px; height: 200px;"><br><br>
                                                        <label class="control-label">{{ __('Avatar') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-9">
                                                <!-- fullname -->
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Full name') }}:</label>
                                                            <input type="text" class="form-control" name="fullname"
                                                                value="{{ $admin->fullname }}"
                                                                placeholder="{{ __('Full name') }}" disabled />
                                                        </div>
                                                    </div>
                                                    <!-- user name -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('User name') }}:</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="{{ __('User name') }}" name="username"
                                                                value="{{ $admin->username }}" disabled>
                                                        </div>
                                                    </div>
                                                    <!-- email -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Email') }}:</label>
                                                            <input type="text" class="form-control" name="email"
                                                                value="{{ $admin->email }}" disabled>
                                                        </div>
                                                    </div>
                                                    <!-- phone -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Phone') }}:</label>
                                                            <input type="text" class="form-control" name="phone"
                                                                value="{{ $admin->phone }}" disabled>
                                                        </div>
                                                    </div>
                                                    <!-- birth day -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Birthday') }}:</label>
                                                            <input type="text" name="phone" class="form-control"
                                                                value={{ date('d-m-Y', strtotime($admin->birthday)) }}
                                                                disabled>
                                                        </div>
                                                    </div>
                                                    <!-- gender -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="form-label">{{ __('Gender') }}</label>
                                                            <input type="text" class="form-control" name="email"
                                                                value="{{ __($admin->gender->key) }}" disabled>
                                                        </div>
                                                    </div>
                                                    <!-- address -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Address') }}:</label>
                                                            <input type="text" class="form-control"
                                                                placeholder="{{ __('Address') }}" name="address"
                                                                value="{{ $admin->address }}" disabled>
                                                        </div>
                                                    </div>
                                                    <!-- address -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Role') }}:</label>
                                                            <select name="roles" class="form-select">
                                                                @foreach ($role as $role)
                                                                    <option value="{{ $role->value }}"
                                                                        {{ $role->value == $admin->roles->value ? 'selected' : '' }}>
                                                                        {{ __($role->key) }}</option>
                                                                @endforeach
                                                            </select>
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

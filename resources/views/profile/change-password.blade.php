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
                                    <li class="breadcrumb-item active">{{ __('Change password') }}</li>
                                </ul>
                            </div>
                            <div class="row justify-content-center">
                                <div class="col-12 col-md-6">
                                    <form action="{{route('update.password')}}" method="POST" enctype="multipart/form-data" data-parsley-validate>
                                        @csrf
                                        @method('PUT')
                                        <div class="card">
                                            <div class="card-header justify-content-center">
                                                <h2 class="mb-0">{{ __('Change password') }}</h2>
                                            </div>
                                            <div class="card-body">
                                                <!--Old password-->
                                                <div class="mb-3">
                                                    <label for="oldPasswordInput"
                                                        class="form-control-label">{{ __('Old Password') }}</label>
                                                    <input name="old_password" type="password" class="form-control"
                                                        id="oldPasswordInput" placeholder="{{ __('Old Password') }}" required
                                                        data-parsley-required-message="{{ __('required') }}">
                                                </div>
                                                @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror
                                                <!--New password-->
                                                <div class="mb-3">
                                                    <label for="newPasswordInput"
                                                        class="form-control-label">{{ __('New Password') }}</label>
                                                    <input name="new_password" type="password"
                                                        class="form-control"
                                                        id="newPasswordInput" placeholder="{{ __('New Password') }}" required
                                                        data-parsley-required-message="{{ __('required') }}">
                                                </div>
                                                <!--Confirm new password-->
                                                <div class="mb-3">
                                                    <label for="confirmNewPasswordInput"
                                                        class="form-control-label">{{ __('Confirm New Password') }}</label>
                                                    <input name="new_password_confirmation" type="password"
                                                        class="form-control" id="confirmNewPasswordInput"
                                                        placeholder="{{ __('Confirm New Password') }}" required
                                                        data-parsley-required-message="{{ __('required') }}"
                                                        data-parsley-equalto="#newPasswordInput"
                                                        data-parsley-equalto-message="{{__('This value should be the same')}}">
                                                </div>
                                            </div>
                                            <div class="card-footer bg-transparent mt-auto">
                                                <div class="btn-list justify-content-center">
                                                    <button type="submit" class="btn btn-primary" title="Cập nhật">
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

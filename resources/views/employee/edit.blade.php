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
                                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}"
                                            style="color: #616f82">{{ __('Employee') }} </a></li>
                                    <li class="breadcrumb-item active">{{ __('update') }}</li>
                                </ul>
                            </div>
                            <div class="card" style="background: #f1f5f9">
                                <div class="card-body">
                                    <form action="{{ route('employee.update', $employee->id) }}" method="POST"
                                        enctype="multipart/form-data" data-parsley-validate id="validate_form_cr">
                                        @csrf
                                        @method('PUT')
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-9">
                                                <div class="row">
                                                    <!-- full name -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Full name') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="fullname"
                                                                placeholder="{{ __('Full name') }}"
                                                                value="{{ $employee->fullname }}" />
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
                                                                placeholder="{{ __('Email') }}"
                                                                value="{{ $employee->email }}" />
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
                                                                class="form-control" placeholder="{{ __('Phone') }}"
                                                                value="{{ $employee->phone }}" />
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
                                                                            <option value="{{ $i }}"
                                                                                {{ date('d', strtotime($employee->birthday)) == $i ? 'selected' : '' }}>
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
                                                                            <option value="{{ $i }}"
                                                                                {{ date('m', strtotime($employee->birthday)) == $i ? 'selected' : '' }}>
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
                                                                            <option value="{{ $i }}"
                                                                                {{ date('Y', strtotime($employee->birthday)) == $i ? 'selected' : '' }}>
                                                                                {{ $i }}</option>
                                                                        @endfor
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <!-- address -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Address') }}:</label>
                                                            <input type="text" name="address" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" placeholder="{{ __('Address') }}"
                                                                value="{{ $employee->address }}" />
                                                        </div>
                                                    </div>
                                                    <!-- user name-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Department') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="department"
                                                                placeholder="{{ __('Department') }}"
                                                                value="{{ $employee->department }}" />
                                                        </div>
                                                    </div>
                                                    <!-- admin_id -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Admin') }}:</label>
                                                            <select required="required" id="admin"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-select" name="admin_id">
                                                                <option></option>
                                                                @foreach ($admin as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == $employee->admin_id ? 'selected' : '' }}>
                                                                        {{ $item->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- project_id -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('project') }}:</label>
                                                            <select required="required" id="project_report"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-select" name="project_id">
                                                                <option></option>
                                                                @foreach ($project as $item)
                                                                    <option value="{{ $item->id }}"
                                                                        {{ $item->id == $employee->project_id ? 'selected' : '' }}>
                                                                        {{ $item->name_project }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <!-- gender -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Gender') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        @foreach ($gender as $gender)
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    value="{{ $gender->value }}" name="gender" required
                                                                    data-parsley-required-message="{{ __('required') }}"
                                                                    {{ $gender->value == $employee->gender->value ? 'checked' : '' }}>
                                                                <span
                                                                    class="form-check-label">{{ __($gender->key) }}</span>
                                                            </label>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Post') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <button type="submit" class="btn btn-primary" title="Cập nhật">
                                                            {{ __('update') }}
                                                        </button>
                                                        <button type="button" data-bs-toggle="modal"
                                                            data-bs-target="#modalDelete"
                                                            class="btn btn-danger open-modal-delete float-end"
                                                            data-route="{{ route('employee.destroy', $employee->id) }}">{{ __('Delete') }}</button>
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
    <x-destroy/>
@endsection

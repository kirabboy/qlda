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
                                    <li class="breadcrumb-item"><a href="{{ route('project.index') }}"
                                            style="color: #616f82">{{ __('ManageProjects') }} </a></li>
                                    <li class="breadcrumb-item active">{{ __('add') }}</li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('project.store') }}" method="POST" enctype="multipart/form-data"
                                        data-parsley-validate id="validate_form_cr">
                                        @csrf
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-9">
                                                <div class="row">
                                                    <!-- name project-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Name project') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="name_project"
                                                                placeholder="{{ __('Name project') }}" />
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
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->fullname }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <!-- desc -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Description') }}:</label>
                                                            <textarea name="description" id="ckeditor-content"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- ref -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Ref') }}:</label>
                                                            <textarea class="form-control" name="ref" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- planning -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Planning') }}:</label>
                                                            <textarea class="form-control" name="planning" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- note -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Note') }}:</label>
                                                            <textarea class="form-control" name="note" rows="3"></textarea>
                                                        </div>
                                                    </div>

                                                    <!-- name CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Name CT') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="name_CT"
                                                                placeholder="{{ __('Name CT') }}" />
                                                        </div>
                                                    </div>

                                                    <!-- company CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Company CT') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="company_CT"
                                                                placeholder="{{ __('Company CT') }}" />
                                                        </div>
                                                    </div>

                                                    <!-- designtion CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Designtion CT') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="designtion_CT"
                                                                placeholder="{{ __('Designtion CT') }}" />
                                                        </div>
                                                    </div>

                                                    <!-- mobile CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Mobile CT') }}:</label>
                                                            <input type="text" name="mobile_CT" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                data-parsley-length="[10, 10]"
                                                                data-parsley-length-message="{{ __('Phone validate') }}"
                                                                data-parsley-type="digits"
                                                                data-parsley-type-message="{{ __('Phone validate length') }}"
                                                                class="form-control"
                                                                placeholder="{{ __('Mobile CT') }}" />
                                                        </div>
                                                    </div>

                                                    <!-- email CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Email CT') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                data-parsley-type="email"
                                                                data-parsley-type-message="{{ __('Email validate') }}"
                                                                class="form-control" name="email_CT"
                                                                placeholder="Email" />
                                                        </div>
                                                    </div>

                                                    <!-- person_in_charge_Ur-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label
                                                                class="control-label">{{ __('Person in charge') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="person_in_charge_Ur"
                                                                placeholder="{{ __('Person in charge') }}" />
                                                        </div>
                                                    </div>

                                                    <!-- lead_time_pro -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Lead time') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="lead_time_Pro"
                                                                placeholder="{{ __('Lead time') }}" />
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

                                                <!-- date_cre-->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Date created') }}:
                                                    </div>
                                                    <div class="card-body p-2 wrap-list-checkbox">
                                                        <input type="date" name="date_cre" class="form-control"
                                                            required
                                                            data-parsley-required-message="{{ __('required') }}"><br>
                                                    </div>
                                                </div>

                                                <!-- version-->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Version') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <input type="text" required="required"
                                                            data-parsley-required-message="{{ __('required') }}"
                                                            class="form-control" name="version"
                                                            placeholder="{{ __('Version') }}" />
                                                    </div>
                                                </div>

                                                <!-- status -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Status') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="{{ __('required') }}"
                                                            class="form-select" name="status">
                                                            @foreach ($status as $status)
                                                                <option value="{{ $status->value }}">
                                                                    {{ __($status->key) }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Sample status -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Sample status') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="{{ __('required') }}"
                                                            class="form-select" name="sample_status_MA">
                                                            @foreach ($status_sample as $status)
                                                                <option value="{{ $status->value }}">
                                                                    {{ __($status->key) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- file upload -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('File upload') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <input type="text" class="form-control" id="name_file"
                                                            disabled>
                                                        <input type="text" class="d-none" name="file_upload"
                                                            value="default-image.png" id="input_img_project">
                                                        <button type="button" id="file_upload_project"
                                                            class="btn btn-outline-info">{{ __('File upload') }}</button>
                                                    </div>
                                                </div>

                                                <!-- Contract status -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('Contract status') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="{{ __('required') }}"
                                                            class="form-select" name="contract_status">
                                                            @foreach ($status_contract as $status)
                                                                <option value="{{ $status->value }}">
                                                                    {{ __($status->key) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- material_delivery_Pro-->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('material delivery pro') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="{{ __('required') }}"
                                                            class="form-select" name="material_delivery_Pro">
                                                            @foreach ($status_material as $status)
                                                                <option value="{{ $status->value }}">
                                                                    {{ __($status->key) }}
                                                                </option>
                                                            @endforeach
                                                        </select>
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

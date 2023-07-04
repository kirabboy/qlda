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
                                    <li class="breadcrumb-item"><a href="{{ route('project.report.index') }}"
                                            style="color: #616f82">{{ __('ManageReports') }}</a></li>
                                    <li class="breadcrumb-item active">{{ __('add') }}</li>
                                </ul>
                            </div>
                            <div class="card" style="background: #f1f5f9">
                                <div class="card-body">
                                    <form action="{{ route('project.report.store') }}" method="POST"
                                        enctype="multipart/form-data" data-parsley-validate id="validate_form_cr">
                                        @csrf
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-9">
                                                <div class="row">
                                                    <!-- title_report -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Title') }}:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-control" name="title_report"
                                                                placeholder="{{ __('Title') }}" />
                                                        </div>
                                                    </div>

                                                    <!-- employee_id -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Employee') }}:</label>
                                                            <select required="required" id="employee_report"
                                                                data-parsley-required-message="{{ __('required') }}"
                                                                class="form-select" name="employee_id">
                                                                <option></option>
                                                                @foreach ($getEmployee as $item)
                                                                    <option value="{{ $item->id }}">
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
                                                                @foreach ($getProject as $item)
                                                                    <option value="{{ $item->id }}">
                                                                        {{ $item->name_project }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <!-- note -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Note') }}:</label>
                                                            <textarea class="form-control" name="note" rows="3"></textarea>
                                                        </div>
                                                    </div>


                                                    <!-- desc -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">{{ __('Description') }}:</label>
                                                            <textarea name="description_report" id="ckeditor-content"></textarea>
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
                                                        <button type="submit" class="btn btn-primary" title="Thêm">
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
                                                        <input type="date" name="date_cre_report" class="form-control"
                                                            required><br>
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
                                                <!-- file upload -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        {{ __('File upload') }}
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <input type="text" class="form-control" name="filename" id="filename" readonly>
                                                        <input type="text" class="d-none" name="file_size" id="file_size">
                                                        <input type="text" class="d-none" name="file_path" id="file_path">
                                                        <input type="text" class="d-none" name="file_type" id="file_type">
                                                        <input type="text" class="d-none" name="file_report"
                                                            id="input_img">
                                                        <button type="button" id="image"
                                                            class="btn btn-outline-info">{{ __('File upload') }}</button>
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

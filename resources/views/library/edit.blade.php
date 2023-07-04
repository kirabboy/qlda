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
                                    <li class="breadcrumb-item"><a href="{{ route('library.index') }}"
                                            style="color: #616f82">{{ __('library') }} </a></li>
                                    <li class="breadcrumb-item active">{{ __('Edit') }}</li>
                                </ul>
                            </div>
                            <div class="card" style="background: #f1f5f9">
                                <div class="card-body">
                                    <form action="{{ route('library.update', $library->id) }}" method="POST"
                                        enctype="multipart/form-data" data-parsley-validate id="validate_form_cr">
                                        @csrf
                                        @method('PUT')
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-9">
                                                <div class="row">
                                                    <!-- project_id -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label d-inline">{{ __('project') }}:  <h2 class="d-inline">{{$library->projects->name_project}}</h2></label>      
                                                           
                                                        </div>
                                                    </div>
                                                    <!-- project_report_id -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label d-inline">{{ __('project report') }}:  <h2 class="d-inline">{{$library->project_report->title_report}}</h2></label>
                                                           <input type="text" class="d-none" value="{{$library->project_report->id}}" name="project_report_id">
                                                        </div>
                                                    </div>
                                                    <!-- file upload -->
                                                    <div class="card mb-3">
                                                        <div class="card-header">
                                                            <button type="button" id="library_file_upload"
                                                                class="btn btn-outline-info">{{ __('File upload') }}
                                                            </button>
                                                        </div>
                                                        <div class="card-body p-2">
                                                            <div class="row">
                                                                <!-- file name -->
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="control-label">{{ __('File name') }}:</label>
                                                                        <input type="text" id="file_name"
                                                                            class="form-control" name="filename" readonly
                                                                            style="background-color:rgb(239, 244, 242); color: #19a842"
                                                                            value="{{ $library->filename }}"
                                                                            required="required"
                                                                            data-parsley-required-message="{{ __('required') }}" />
                                                                    </div>
                                                                </div>
                                                                <!-- file path -->
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="control-label">{{ __('File path') }}:</label>
                                                                        <input type="text" id="file_path"
                                                                            class="form-control" name="file_path" readonly
                                                                            style="background-color:rgb(239, 244, 242); color: #19a842"
                                                                            value="{{ $library->file_path }}"
                                                                            required="required"
                                                                            data-parsley-required-message="{{ __('required') }}" />
                                                                    </div>
                                                                </div>

                                                                <!-- file size -->
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="control-label">{{ __('File size') }}:</label>
                                                                        <input type="text" name="file_size"
                                                                            id="file_size" class="form-control" readonly
                                                                            style="background-color:rgb(239, 244, 242); color: #19a842"
                                                                            value="{{ $library->file_size }}"
                                                                            required="required"
                                                                            data-parsley-required-message="{{ __('required') }}" />
                                                                    </div>
                                                                </div>

                                                                <!-- file type -->
                                                                <div class="col-6">
                                                                    <div class="mb-3">
                                                                        <label
                                                                            class="control-label">{{ __('File type') }}:</label>
                                                                        <input type="text" name="file_type"
                                                                            id="file_type" class="form-control" readonly
                                                                            style="background-color:rgb(239, 244, 242); color: #19a842"
                                                                            value="{{ $library->file_type }}"
                                                                            required="required"
                                                                            data-parsley-required-message="{{ __('required') }}" />
                                                                    </div>
                                                                </div>
                                                            </div>

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
                                                            title=" {{ __('update') }}">
                                                            {{ __('update') }}
                                                        </button>
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

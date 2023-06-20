@extends('layouts.layout-main')
@section('content')
    <x-sidebar />
    <div class="page-wrapper">
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                            style="color: #616f82">Dashboard </a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('project.report.index') }}"
                                            style="color: #616f82">Quản lý báo cáo dự án </a></li>
                                    <li class="breadcrumb-item active">Thêm báo cáo dự án</li>
                                </ul>
                            </div>
                            <div class="card" style="background: #f1f5f9">
                                <div class="card-body">
                                    <form action="{{ route('project.report.store') }}" method="POST" enctype="multipart/form-data"
                                        data-parsley-validate id="validate_form_cr">
                                        @csrf                        
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-9">
                                                <div class="row">
                                                    <!-- title_report -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">Tiêu đề báo cáo:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="title_report"
                                                                placeholder="Tiêu đề báo cáo" />
                                                        </div>
                                                    </div>

                                                    <!-- employee_id -->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">Nhân viên:</label>
                                                            <select required="required" id="employee_report"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
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
                                                            <label class="control-label">Dự án:</label>
                                                            <select required="required" id="project_report"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
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
                                                            <label class="control-label">Ghi chú:</label>
                                                            <textarea class="form-control" name="note" rows="3"></textarea>
                                                        </div>
                                                    </div>


                                                    <!-- desc -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">Mô tả:</label>
                                                            <textarea name="description_report" id="ckeditor-content"></textarea>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                            <div class="col-12 col-md-3">
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Đăng
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <button type="submit" class="btn btn-primary" title="Thêm">
                                                            Thêm
                                                        </button>
                                                    </div>
                                                </div>

                                                <!-- date_cre-->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Ngày tạo:
                                                    </div>
                                                    <div class="card-body p-2 wrap-list-checkbox">
                                                        <input type="date" name="date_cre_report" class="form-control"
                                                            required><br>
                                                    </div>
                                                </div>

                                                <!-- status -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Trạng thái
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="Trường này không được bỏ trống."
                                                            class="form-select" name="status">
                                                            @foreach ($status as $status)
                                                                <option value="{{ $status->value }}">
                                                                    {{ $status->description }}
                                                                </option>
                                                            @endforeach

                                                        </select>
                                                    </div>
                                                </div>
                                                <!-- file upload -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Tải tập tin
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <input type="text" class="form-control" id="name_file" disabled>
                                                        <input type="text" class="d-none" name="file_report"
                                                            value="/assets/images/default-image.png" id="input_img">
                                                            <button type="button" id="image" class="btn btn-outline-info">Tải tập tin</button>
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

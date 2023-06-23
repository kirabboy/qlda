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
                                    <li class="breadcrumb-item"><a href="{{ route('project.index') }}"
                                            style="color: #616f82">Quản lý dự án </a></li>
                                    <li class="breadcrumb-item active">Sửa dự án</li>
                                </ul>
                            </div>
                            <div class="card" style="background: #f1f5f9">
                                <div class="card-body">
                                    <form action="{{ route('project.update', $project->id) }}" method="POST"
                                        enctype="multipart/form-data" data-parsley-validate id="validate_form_cr">
                                        @csrf
                                        @method('PUT')
                                        <div class="row justify-content-center">
                                            <div class="col-12 col-md-9">
                                                <div class="row">
                                                    <!-- name project-->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">Tên dự án:</label>
                                                            <input type="text" required="required"
                                                                value="{{ $project->name_project }}"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="name_project"
                                                                placeholder="Tên dự án" />
                                                        </div>
                                                    </div>

                                                    <!-- desc -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">Mô tả:</label>
                                                            <textarea name="description" id="ckeditor-content">{{ $project->description }}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- ref -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">Giới thiệu:</label>
                                                            <textarea class="form-control" name="ref" rows="3">{{ $project->ref }}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- planning -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">Kế hoạch:</label>
                                                            <textarea class="form-control" name="planning" rows="3">{{ $project->planning }}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- note -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">Ghi chú:</label>
                                                            <textarea class="form-control" name="note" rows="3">{{ $project->note }}</textarea>
                                                        </div>
                                                    </div>

                                                    <!-- name CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">Tên CT:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="name_CT" placeholder="Tên CT"
                                                                value="{{ $project->name_CT }}" />
                                                        </div>
                                                    </div>

                                                    <!-- company CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">Công ty CT:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="company_CT" placeholder="Công ty"
                                                                value="{{ $project->company_CT }}" />
                                                        </div>
                                                    </div>

                                                    <!-- designtion CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">Chỉ định CT:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="designtion_CT"
                                                                placeholder="Chỉ định"
                                                                value="{{ $project->designtion_CT }}" />
                                                        </div>
                                                    </div>

                                                    <!-- mobile CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">Số điện thoại CT:</label>
                                                            <input type="text" name="mobile_CT" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                data-parsley-length="[10, 10]"
                                                                data-parsley-length-message="Số điện thoại không đúng định dạng."
                                                                data-parsley-type="digits"
                                                                data-parsley-type-message="Chỉ được nhập số."
                                                                class="form-control" placeholder="0"
                                                                value="{{ $project->mobile_CT }}" />
                                                        </div>
                                                    </div>

                                                    <!-- email CT-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">Email CT:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="email_CT" placeholder="Email"
                                                                value="{{ $project->email_CT }}" />
                                                        </div>
                                                    </div>

                                                    <!-- person_in_charge_Ur-->
                                                    <div class="col-6">
                                                        <div class="mb-3">
                                                            <label class="control-label">Người phụ trách:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="person_in_charge_Ur"
                                                                placeholder="Người phụ trách"
                                                                value="{{ $project->person_in_charge_Ur }}" />
                                                        </div>
                                                    </div>

                                                    <!-- lead_time_pro -->
                                                    <div class="col-12">
                                                        <div class="mb-3">
                                                            <label class="control-label">lead_time_Pro:</label>
                                                            <input type="text" required="required"
                                                                data-parsley-required-message="Trường này không được bỏ trống."
                                                                class="form-control" name="lead_time_Pro"
                                                                placeholder="lead_time_Pro"
                                                                value="{{ $project->lead_time_Pro }}" />
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
                                                        <button type="submit" class="btn btn-primary" title="Cập nhật">
                                                            Cập nhật
                                                        </button>                                         
                                                    </div>
                                                </div>

                                                <!-- date_cre-->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Ngày tạo:
                                                    </div>
                                                    <div class="card-body p-2 wrap-list-checkbox">
                                                        <input type="date" name="date_cre" class="form-control"
                                                            required="required" value="{{ $project->date_cre }}"><br>
                                                    </div>
                                                </div>

                                                <!-- version-->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Phiên bản
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <input type="text" required="required"
                                                            data-parsley-required-message="Trường này không được bỏ trống."
                                                            class="form-control" name="version" placeholder="Phiên bản"
                                                            value="{{ $project->version }}" />
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
                                                                <option value="{{ $status->value }} "
                                                                    {{ $status->value == $project->status->value ? 'selected' : '' }}>
                                                                    {{ $status->description }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- Sample status -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Trạng thái mẫu
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="Trường này không được bỏ trống."
                                                            class="form-select" name="sample_status_MA">
                                                            @foreach ($status_sample as $status)
                                                                <option value="{{ $status->value }} "
                                                                    {{ $status->value == $project->sample_status_MA->value ? 'selected' : '' }}>
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
                                                        <input type="text" class="form-control" id="name_file"
                                                            disabled
                                                            value="Selected: {{ str_replace('/file-upload/', '', $project->file_upload) }}">
                                                        <input type="text" class="d-none" name="file_upload"
                                                            value="{{ $project->file_upload }}" id="input_img">
                                                            <button type="button" id="image" class="btn btn-outline-info">Tải tập tin</button>
                                                    </div>
                                                </div>

                                                <!-- Contract status -->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Trạng thái hợp đồng
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="Trường này không được bỏ trống."
                                                            class="form-select" name="contract_status">
                                                            @foreach ($status_contract as $status)
                                                                <option value="{{ $status->value }}"
                                                                    {{ $status->value == $project->contract_status->value ? 'selected' : '' }}>
                                                                    {{ $status->description }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <!-- material_delivery_Pro-->
                                                <div class="card mb-3">
                                                    <div class="card-header">
                                                        Vận chuyển
                                                    </div>
                                                    <div class="card-body p-2">
                                                        <select required="required"
                                                            data-parsley-required-message="Trường này không được bỏ trống."
                                                            class="form-select" name="material_delivery_Pro">
                                                            @foreach ($status_material as $status)
                                                                <option value="{{ $status->value }}"
                                                                    {{ $status->value == $project->material_delivery_Pro->value ? 'selected' : '' }}>
                                                                    {{ $status->description }}</option>
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
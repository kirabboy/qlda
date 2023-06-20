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
                                    <li class="breadcrumb-item active">Quản lý dự án</li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header justify-content-between">
                                    <h2 class="mb-0">Quản lý dự án</h2>
                                    <a href="{{ route('project.add') }}" class="btn btn-primary">
                                        <i class="bi bi-plus-circle"></i>&nbsp;Thêm dự án
                                    </a>
                                </div>
                                <div class="toggle-columns-table">
                                    <div class="d-flex justify-content-end">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning" type="button">
                                                Cột
                                            </button> <button type="button"
                                                class="btn btn-warning dropdown-toggle dropdown-toggle-split" type="button"
                                                data-bs-toggle="dropdown" aria-expanded="false">
                                                <span class="visually-hidden">Toggle Dropdown</span>
                                            </button>
                                            <div class="drop-toggle-columns dropdown-menu dropdown-menu-lg" role="menu">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body">
                                    {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
                                </div>
                                <div class="modal modal-blur fade" id="modalDelete" tabindex="-1" role="dialog"
                                    aria-hidden="true">
                                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-body">
                                                <div class="modal-title">Bạn có chắc?</div>
                                                <div>Nếu bạn tiếp tục, bạn sẽ xóa dữ liệu ra khỏi dữ liệu hệ thống.
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-link link-secondary me-auto"
                                                    data-bs-dismiss="modal">Hủy</button>
                                                <form action="#" method="POST" id="modalFormDelete">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    {{ $dataTable->scripts() }}
@endpush

@extends('layouts.layout-main')
@section('content')
    <x-sidebar />
    <div class="page-wrapper">
        <x-top-bar/>
        <!-- Page body -->
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <ul class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"
                                            style="color: #616f82">{{__('dashboard')}} </a></li>
                                    <li class="breadcrumb-item active">{{__('library')}}</li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header justify-content-between">
                                    <h2 class="mb-0">{{__('library')}}</h2>
                                </div>
                                <div class="toggle-columns-table">
                                    <div class="d-flex justify-content-end">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-warning" type="button">
                                               {{__('column')}}
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
                                <x-destroy/>
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

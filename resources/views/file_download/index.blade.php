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
                                    <li class="breadcrumb-item active">{{__('file download')}}</li>
                                </ul>
                            </div>
                            <div class="card">
                                <div class="card-header justify-content-between">
                                    <h2 class="mb-0">{{__('file download')}}</h2>
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

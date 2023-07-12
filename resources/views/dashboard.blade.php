@extends('layouts.layout-main')
@section('content')
    <x-sidebar />

    <div class="page-wrapper">
        <!-- Page body -->
        <x-top-bar />
        <div class="page-body">
            <div class="container-xl">
                <div class="row row-deck row-cards">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="page-title">{{ __('dashboard') }}</h3><br>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xl-4">
                                    <div class="card">
                                        <div class="card-body">
                                            <div id="container" class="highcharts-dashboards-dark">
                                                <figure class="highcharts-figure">
                                                    <div id="pie_gradient"></div>
                                                </figure>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-8">
                                    <div class="card">
                                        <div class="card-body">
                                            <figure class="highcharts-figure">
                                                <div id="column_basic"></div>
                                            </figure>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h3 class="card-title">{{ __('ManageProjects') }}</h3>
                            {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @push('scripts')
        {{ $dataTable->scripts() }}
    @endpush

    <script>
        var count_approved = {!! json_encode($count_approved, JSON_HEX_TAG) !!};
        var count_rejected = {!! json_encode($count_rejected, JSON_HEX_TAG) !!};
        var count_submitted = {!! json_encode($count_submitted, JSON_HEX_TAG) !!};
        var count_month_approved = {!! json_encode($count_month_approved, JSON_HEX_TAG) !!};
        var count_month_rejected = {!! json_encode($count_month_rejected, JSON_HEX_TAG) !!};
        var count_month_submitted = {!! json_encode($count_month_submitted, JSON_HEX_TAG) !!};
    </script>

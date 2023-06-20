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
                                <h3 class="page-title">Dashboard</h3><br>
                                <div class="col-auto ms-auto d-print-none">
                                    <div class="btn-list">
                                        <span class="d-none d-sm-inline">
                                            @auth
                                                <h5>Hi, {{ auth()->user()->fullname }} -- {{ auth()->user()->roles->key }}
                                                    <a href="{{ route('sign.out') }}"><i
                                                            class="fa-solid fa-right-from-bracket"></i></a>
                                                </h5>
                                            @endauth
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-lg-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <figure class="highcharts-figure">
                                                <div id="pie_gradient"></div>
                                            </figure>      
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-xl-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <figure class="highcharts-figure">
                                                <div id="column_basic"></div>
                                            </figure>                                        
                                        </div>
                                    </div>
                                </div>
                            </div>
                       
                            <div class="card">
                                <div class="card-body">
                                    <h3 class="card-title">Manage Projects</h3>
                                    {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
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

<script>
    var count_approved = {!! json_encode($count_approved, JSON_HEX_TAG) !!};
    var count_rejected = {!! json_encode($count_rejected, JSON_HEX_TAG) !!};
    var count_submitted = {!! json_encode($count_submitted, JSON_HEX_TAG) !!};
    var data = {!! json_encode($data, JSON_HEX_TAG)!!}
    var months = {!! json_encode($months, JSON_HEX_TAG)!!}
    var count_month = {!! json_encode($count_month, JSON_HEX_TAG)!!}
</script>

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
                                    <h3 class="card-title">{{ __('ManageProjects') }}</h3>
                                    {!! $dataTable->table(['class' => 'table table-bordered'], true) !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-blur fade" id="modalLogout" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="modal-title">{{__('Are you sure')}}</div>
                    <div>{{__('Accept logout')}}</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-link link-secondary me-auto" data-bs-dismiss="modal">{{__('Cancel')}}</button>
                    <form action="{{ route('sign.out') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">{{__('Logout')}}</button>
                    </form>
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
    var data = {!! json_encode($data, JSON_HEX_TAG) !!};
    var months = {!! json_encode($months, JSON_HEX_TAG) !!};
    var count_month = {!! json_encode($count_month, JSON_HEX_TAG) !!};
    var approved = "@lang('approved')";
    var rejected = "@lang('rejected')";
    var submitted = "@lang('submitted')";
    var pie_gradient = "@lang('pie_gradient')";
    var column_basic = "@lang('column_basic')";
    var project = "@lang('project')";
</script>

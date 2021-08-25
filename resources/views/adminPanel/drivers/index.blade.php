@extends('adminPanel.layouts.app')

@section('breadcrumb')
<ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
    <li class="breadcrumb-item">@lang('models/drivers.plural')</li>
</ul>
@endsection
@section('content')
@include('flash::message')
<!--begin::Card-->
<div class="card card-custom gutter-b">
    <div class="card-header flex-wrap border-0 pt-6 pb-0">
        <div class="card-title">
            <h3 class="card-label">
                @lang('models/drivers.plural')
                <span class="d-block text-muted pt-2 font-size-sm">Descriptions</span>
            </h3>
        </div>
        <div class="card-toolbar">
        </div>
        @can('drivers create')
        <div class="card-toolbar">
            <!--begin::Button-->
            <a href="{{ route('adminPanel.drivers.create')  . '?languages=' . \App::getLocale() }}" class="btn btn-primary font-weight-bolder">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                @lang('crud.add_new')
            </a>
            <!--end::Button-->
            <!--begin::Button-->
            <a href="{{ route('adminPanel.drivers.export')}}" class="btn btn-success font-weight-bolder mx-2">
                <span class="svg-icon svg-icon-md">
                    <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Flatten.svg-->
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24" />
                            <circle fill="#000000" cx="9" cy="15" r="6" />
                            <path d="M8.8012943,7.00241953 C9.83837775,5.20768121 11.7781543,4 14,4 C17.3137085,4 20,6.6862915 20,10 C20,12.2218457 18.7923188,14.1616223 16.9975805,15.1987057 C16.9991904,15.1326658 17,15.0664274 17,15 C17,10.581722 13.418278,7 9,7 C8.93357256,7 8.86733422,7.00080962 8.8012943,7.00241953 Z" fill="#000000" opacity="0.3" />
                        </g>
                    </svg>
                    <!--end::Svg Icon-->
                </span>
                Export
            </a>
            <!--end::Button-->
        </div>
        @endcan
    </div>

    <div class="card-body">
        @include('adminPanel.drivers.table')
    </div>
</div>
<!--end::Card-->
@endsection


{{-- @section('scripts')
<script>
    "use strict";
        // Class definition

        var KTDatatableHtmlTableDemo = function() {
            // Private functions

            // demo initializer
            var demo = function() {

                var datatable = $('#kt_datatable').KTDatatable({
                    data: {
                        saveState: { cookie: false },
                    },
                    search: {
                        input: $('#kt_datatable_search_query'),
                        key: 'generalSearch'
                    },
                    columns: [{
                            field: 'DepositPaid',
                            type: 'number',
                        },
                        {
                            field: 'OrderDate',
                            type: 'date',
                            format: 'YYYY-MM-DD',
                        },
                        {
                            field: 'Status',
                            title: 'Status',
                            autoHide: false,
                            // callback function support for column rendering
                            // 0 => in progress, 1 => Pending, 2 => Approved, 3 => Rejected, 4 => Deactivate
                            template: function(row) {
                                var status = {
                                    0: {
                                        'title': 'In Progress',
                                        'class': ' label-light-primary'
                                    },
                                    1: {
                                        'title': 'Pending',
                                        'class': ' label-light-info'
                                    },
                                    2: {
                                        'title': 'Approved',
                                        'class': ' label-light-success'
                                    },
                                    3: {
                                        'title': 'Rejected',
                                        'class': ' label-light-danger'
                                    },
                                    4: {
                                        'title': 'Deactivated',
                                        'class': ' label-light-danger'
                                    }
                                };
                                return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
                            },
                        },
                        {
                            field: 'action',
                            type: 'Action',
                            format: 'inputs',
                        },
                    ],
                });



                $('#kt_datatable_search_status').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Status');
                });

                $('#kt_datatable_search_type').on('change', function() {
                    datatable.search($(this).val().toLowerCase(), 'Type');
                });

                $('#kt_datatable_search_status, #kt_datatable_search_type').selectpicker();

            };

            return {
                // Public functions
                init: function() {
                    // init dmeo
                    demo();
                },
            };
        }();

        jQuery(document).ready(function() {
            KTDatatableHtmlTableDemo.init();
        });
</script>
@endsection --}}

<!--begin::Search Form-->
<div class="mb-7">
    <div class="row align-items-center">
        <div class="col-lg-9 col-xl-8">
            <div class="row align-items-center">
                <div class="col-md-4 my-2 my-md-0">
                    <div class="input-icon">
                        <input type="text" class="form-control" placeholder="Search..." id="kt_datatable_search_query" />
                        <span><i class="flaticon2-search-1 text-muted"></i></span>
                    </div>
                </div>
                <div class="col-md-4 my-2 my-md-0">
                    <div class="d-flex align-items-center">
                        <label class="mr-3 mb-0 d-none d-md-block">@lang('lang.status'):</label>
                        <select class="form-control" id="kt_datatable_search_status">
                            <option value="">@lang('lang.all')</option>
                            <option value="0">New</option>
                            <option value="1">Picked Up</option>
                            <option value="2">Delivered</option>
                            <option value="3">Not Picked Up</option>
                            <option value="4">Rescheduled</option>
                            <option value="5">InProgress</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Search Form-->

{{-- Date Filter --}}
{!! Form::open(['route' => 'adminPanel.donations.dateFilter']) !!}

<div class="form-group row">
    <div class="col-sm-4">
        <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" placeholder="From" data-target="#kt_datetimepicker_1" name="donation_from" />
            <div class=" input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                <span class="input-group-text">
                    <i class="ki ki-calendar"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" placeholder="To" data-target="#kt_datetimepicker_2" name="donation_to" />
            <div class="input-group-append" data-target="#kt_datetimepicker_2" data-toggle="datetimepicker">
                <span class="input-group-text">
                    <i class="ki ki-calendar"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="col-4">
        {!! Form::submit('Filter', ['class' => 'form-control btn btn-primary']) !!}
    </div>
</div>

{!! Form::close() !!}
{{-- End Date Filter --}}

<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/donations.fields.id')</th>
            <th>@lang('models/donations.fields.customer')</th>
            <th>@lang('models/donations.fields.phone')</th>
            <th>@lang('models/donations.fields.pickup_date')</th>
            <th>@lang('models/donations.fields.state')</th>
            <th>@lang('models/donations.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($donations as $donation)
        <tr>
            <td>{{ $donation->id }}</td>
            <td>{{ $donation->name ?? $donation->customer->name }}</td>
            <td>{{ $donation->customer->user->phone ?? '' }}</td>
            <td>{{ $donation->pickup_date }}</td>
            <td>{{ $donation->state->name ?? '' }}</td>
            <td>{{ $donation->status }}</td>

            <td nowrap>
                @can('donations view')
                <a href="{{ route('adminPanel.donations.show', [$donation->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                @endcan
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->



@section('scripts')
<script>
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
                }, {
                    field: 'Status',
                    title: 'Status',
                    autoHide: false,
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            0: {
                                'title': 'New',
                                'class': ' label-light-info'
                            },
                            1: {
                                'title': 'Picked Up',
                                'class': ' label-light-warning'
                            },
                            2: {
                                'title': 'Delivered',
                                'class': ' label-light-success'
                            },
                            3: {
                                'title': 'Not Delivered',
                                'class': ' label-light-danger'
                            },
                            4: {
                                'title': 'Rescheduled',
                                'class': ' label-light-primary'
                            },
                            5: {
                                'title': 'InProgress',
                                'class': ' label-light-success'
                            },
                        };
                        return '<span class="label font-weight-bold label-lg' + status[row.Status].class + ' label-inline">' + status[row.Status].title + '</span>';
                    },
                }, {
                    field: 'Type',
                    title: 'Type',
                    autoHide: false,
                    // callback function support for column rendering
                    template: function(row) {
                        var status = {
                            1: {
                                'title': 'Online',
                                'state': 'danger'
                            },
                            2: {
                                'title': 'Retail',
                                'state': 'primary'
                            },
                            3: {
                                'title': 'Direct',
                                'state': 'success'
                            },
                        };
                        return '<span class="label label-' + status[row.Type].state + ' label-dot mr-2"></span><span class="font-weight-bold text-' + status[row.Type].state + '">' + status[row.Type].title + '</span>';
                    },
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
</script>
@endsection

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
                            <option value="1">Delivered</option>
                            <option value="2">Not Delivered</option>
                        </select>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!--end::Search Form-->

{{-- Date Filter --}}
{!! Form::open(['route' => 'adminPanel.orders.dateFilter']) !!}

<div class="form-group row">
    <div class="col-sm-4">
        <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" placeholder="From" data-target="#kt_datetimepicker_1" name="order_from" />
            <div class=" input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                <span class="input-group-text">
                    <i class="ki ki-calendar"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" placeholder="To" data-target="#kt_datetimepicker_2" name="order_to" />
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
            <th>@lang('models/orders.fields.id')</th>
            <th>@lang('models/orders.fields.name')</th>
            <th>@lang('models/orders.fields.address')</th>
            <th>@lang('models/orders.fields.phone')</th>
            <th>@lang('models/orders.fields.created_at')</th>
            <th>@lang('models/orders.fields.status')</th>
            <th>@lang('models/orders.fields.payment_method')</th>
            <th>@lang('models/orders.fields.total')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->name }}</td>
            <td>{{ Str::limit($order->address, 40, '...') }}</td>
            <td>{{ $order->phone }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->payment_method }}</td>
            <td>{{ $order->total }} @lang('lang.currency')</td>
            <td nowrap>
                <div class='btn-group'>
                    @can('orders view')
                    <a href="{{ route('adminPanel.orders.show', [$order->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                </div>
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
                                'title': 'Delivered',
                                'class': ' label-light-success'
                            },
                            2: {
                                'title': 'Not Delivered',
                                'class': ' label-light-danger'
                            }
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

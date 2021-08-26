{{-- Date Filter --}}
{!! Form::open(['route' => 'adminPanel.driver_weights.dateFilter']) !!}

<div class="form-group row">
    <div class="col-sm-4">
        <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" placeholder="From" data-target="#kt_datetimepicker_1" name="weight_from" />
            <div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                <span class="input-group-text">
                    <i class="ki ki-calendar"></i>
                </span>
            </div>
        </div>
    </div>

    <div class="col-sm-4">
        <div class="input-group date" id="kt_datetimepicker_2" data-target-input="nearest">
            <input type="text" class="form-control datetimepicker-input" placeholder="To" data-target="#kt_datetimepicker_2" name="weight_to" />
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
            <th>@lang('models/driverWeights.fields.id')</th>
            <th>@lang('models/driverWeights.fields.driver_id')</th>
            <th>@lang('models/driverWeights.fields.date')</th>
            <th>@lang('models/driverWeights.fields.weight')</th>
            <th>@lang('models/driverWeights.fields.update_weight')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($driver_weights as $weight)
        <tr>
            <td>{{ $weight->id }}</td>
            <td>{{ $weight->driver->name ?? '' }}</td>
            <td>{{ $weight->date }}</td>
            <td>{{ $weight->weight }}</td>

            <td nowrap>
                {!! Form::model($weight, ['route' => ['adminPanel.driver_weights.updateDriverWeight', $weight->id], 'method' => 'patch']) !!}

                {!! Form::text('weight', null, ['class' => 'form-control d-inline','placeholder' => 'Weight']) !!}

                {!! Form::submit('Update', ['class' => 'form-control btn btn-primary mt-4 d-inline']) !!}

                {!! Form::close() !!}
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

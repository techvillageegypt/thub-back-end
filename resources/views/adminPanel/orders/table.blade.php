<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/orders.fields.name')</th>
        <th>@lang('models/orders.fields.address')</th>
        <th>@lang('models/orders.fields.housing_type')</th>
        <th>@lang('models/orders.fields.house_number')</th>
        <th>@lang('models/orders.fields.building_number')</th>
        <th>@lang('models/orders.fields.floor_number')</th>
        <th>@lang('models/orders.fields.apartment_number')</th>
        <th>@lang('models/orders.fields.state_id')</th>
        <th>@lang('models/orders.fields.status')</th>
        <th>@lang('models/orders.fields.payment_method')</th>
        <th>@lang('models/orders.fields.subtotal')</th>
        <th>@lang('models/orders.fields.total')</th>
        <th>@lang('models/orders.fields.user_id')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
            <tr>
                <td>{{ $order->name }}</td>
            <td>{{ $order->address }}</td>
            <td>{{ $order->housing_type }}</td>
            <td>{{ $order->house_number }}</td>
            <td>{{ $order->building_number }}</td>
            <td>{{ $order->floor_number }}</td>
            <td>{{ $order->apartment_number }}</td>
            <td>{{ $order->state_id }}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->payment_method }}</td>
            <td>{{ $order->subtotal }}</td>
            <td>{{ $order->total }}</td>
            <td>{{ $order->user_id }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.orders.destroy', $order->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('orders view')
                        <a href="{{ route('adminPanel.orders.show', [$order->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('orders edit')
                        <a href="{{ route('adminPanel.orders.edit', [$order->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('orders destroy')
                        {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->

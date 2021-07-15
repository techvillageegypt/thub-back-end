<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/orders.fields.name')</th>
            <th>@lang('models/orders.fields.address')</th>
            <th>@lang('models/orders.fields.status')</th>
            <th>@lang('models/orders.fields.payment_method')</th>
            <th>@lang('models/orders.fields.total')</th>
            <th>@lang('models/orders.fields.created_at')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($orders as $order)
        <tr>
            <td>{{ $order->name }}</td>
            <td>{{ Str::limit($order->address , 40, '...')}}</td>
            <td>{{ $order->status }}</td>
            <td>{{ $order->payment_method }}</td>
            <td>{{ $order->total }} @lang('lang.currency')</td>
            <td>{{ $order->created_at->diffForHumans() }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.orders.destroy', $order->id], 'method' => 'delete','class' => 'd-inline']) !!}
                <div class='btn-group'>
                    @can('orders view')
                    <a href="{{ route('adminPanel.orders.show', [$order->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    {{-- @can('orders edit')
                    <a href="{{ route('adminPanel.orders.edit', [$order->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('orders destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan --}}
                </div>
                {!! Form::close() !!}

                @if ($order->status != 'Delevered')
                {!! Form::open(['route' => ['adminPanel.orders.delevered', $order->id], 'method' => 'patch','class' => 'd-inline']) !!}
                @can('orders delevered')
                {!! Form::button('Delevered', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-primary']) !!}
                @endcan
                {!! Form::close() !!}
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->

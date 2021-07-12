<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/products.fields.id')</th>
            <th>@lang('models/products.fields.title')</th>
            <th>@lang('models/products.fields.brief')</th>
            <th>@lang('models/products.fields.created_at')</th>
            <th>@lang('models/products.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $product)
        <tr>
            <td>{{ $product->id }}</td>
            <td>{{ $product->title }}</td>
            <td>{{ Str::limit($product->brief, 50, '...') }}</td>
            <td>{{ $product->created_at->diffForHumans() }}</td>
            <td>{{ $product->status ? 'Active' : 'Inactive' }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.products.destroy', $product->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    {{-- @can('products view')
                    <a href="{{ route('adminPanel.products.show', [$product->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan --}}
                    @can('products edit')
                    <a href="{{ route('adminPanel.products.edit', [$product->id]) . '?languages=' . \App::getLocale() }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('products destroy')
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

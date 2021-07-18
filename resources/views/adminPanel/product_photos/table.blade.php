<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/productPhotos.fields.product_id')</th>
        <th>@lang('models/productPhotos.fields.photo')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($productPhotos as $productPhoto)
            <tr>
                <td>{{ $productPhoto->product_id }}</td>
            <td>{{ $productPhoto->photo }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.productPhotos.destroy', $productPhoto->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                    @can('productPhotos view')
                        <a href="{{ route('adminPanel.productPhotos.show', [$productPhoto->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('productPhotos edit')
                        <a href="{{ route('adminPanel.productPhotos.edit', [$productPhoto->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('productPhotos destroy')
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

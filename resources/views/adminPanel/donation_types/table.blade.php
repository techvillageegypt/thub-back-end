<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/donationTypes.fields.icon')</th>
            <th>@lang('models/donationTypes.fields.name')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($donationTypes as $donationType)
        <tr>
            <td>
                <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ $donationType->icon_thumbnail_path }}" alt="{{ $donationType->name }}" width="100">
            </td>
            <td>{{ $donationType->name }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.donationTypes.destroy', $donationType->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('donationTypes view')
                    <a href="{{ route('adminPanel.donationTypes.show', [$donationType->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('donationTypes edit')
                    <a href="{{ route('adminPanel.donationTypes.edit', [$donationType->id]) . '?languages=' . \App::getLocale() }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    {{-- @can('donationTypes destroy')
                    {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("'.__('crud.are_you_sure').'")']) !!}
                    @endcan --}}
                </div>
                {!! Form::close() !!}
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->

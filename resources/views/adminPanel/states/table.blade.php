<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>

            <th>@lang('models/states.fields.name')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($states as $state)
            <tr>
                <td>{{ $state->name }}</td>
                <td nowrap>
                    {!! Form::open(['route' => ['adminPanel.states.destroy', $state->id], 'method' => 'delete']) !!}
                    <div class='btn-group'>
                        @can('states view')
                            <a href="{{ route('adminPanel.states.show', [$state->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                        @endcan
                        @can('states edit')
                            <a href="{{ route('adminPanel.states.edit', [$state->id]) }}"
                                class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                        @endcan
                        {{-- @can('states destroy')
                            {!! Form::button('<i class="fa fa-trash"></i>', ['type' => 'submit', 'class' => 'btn btn-sm btn-shadow mx-1 btn-transparent-danger', 'onclick' => 'return confirm("' . __('crud.are_you_sure') . '")']) !!}
                        @endcan --}}
                    </div>
                    {!! Form::close() !!}
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
<!--end: Datatable-->

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
                            {{-- 0 => in progress, 1 => Pending, 2 => Approved, 3 => Rejected, 4 => Deactivate --}}
                            <option value="">@lang('lang.all')</option>
                            <option value="0">@lang('lang.inactive')</option>
                            <option value="1">@lang('lang.active')</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Search Form-->
<!--end: Search Form-->
<!--begin: Datatable-->
<table class="datatable datatable-bordered datatable-head-custom table-hover" id="kt_datatable">
    <thead>
        <tr>
            <th>@lang('models/drivers.fields.name')</th>
            <th>@lang('models/drivers.fields.phone')</th>
            <th>@lang('models/drivers.fields.verify_code')</th>
            <th>@lang('models/drivers.fields.state')</th>
            <th>@lang('models/drivers.fields.status')</th>
            <th>@lang('crud.action')</th>
        </tr>
    </thead>
    <tbody>
        @foreach($drivers as $driver)
        <tr>
            <td>{{ $driver->name }}</td>
            <td>{{ $driver->user->phone ?? '' }}</td>
            <td>{{ $driver->user->verify_code ?? '' }}</td>
            <td>{{ $driver->state->name ?? '' }}</td>

            <td>{{ $driver->user->status }}</td>
            <td nowrap>
                {!! Form::open(['route' => ['adminPanel.drivers.destroy', $driver->id], 'method' => 'delete']) !!}
                <div class='btn-group'>
                    @can('drivers view')
                    <a href="{{ route('adminPanel.drivers.show', [$driver->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-success'><i class="fa fa-eye"></i></a>
                    @endcan
                    @can('drivers edit')
                    <a href="{{ route('adminPanel.drivers.edit', [$driver->id]) }}" class='btn btn-sm btn-shadow mx-1 btn-transparent-primary'><i class="fa fa-edit"></i></a>
                    @endcan
                    @can('drivers destroy')
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

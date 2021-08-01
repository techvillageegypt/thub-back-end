<!--begin: Datatable-->
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable1">
    <thead>
        <tr>
            <th>@lang('models/donations.fields.id')</th>
            <th>@lang('models/donations.fields.customer')</th>
            <th>@lang('models/donations.fields.phone')</th>
            {{-- <th>@lang('models/donations.fields.driver')</th> --}}
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
            <td>{{ $donation->customer->name ?? '' }}</td>
            <td>{{ $donation->customer->user->phone ?? '' }}</td>
            {{-- <td>{{ $donation->driver->name ?? '' }}</td> --}}
            <td>{{ $donation->pickup_date }}</td>
            <td>{{ $donation->state->name ?? '' }}</td>
            <td>{{ $donation->status_text }}</td>

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

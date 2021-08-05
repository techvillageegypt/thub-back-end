<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/drivers.fields.name').':') !!}
    <b>{{ $driver->name }}</b>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/drivers.fields.phone').':') !!}
    <b>{{ $driver->user->phone ?? '' }}</b>
</div>

<!-- verify_code Field -->
<div class="form-group">
    {!! Form::label('verify_code', __('models/drivers.fields.verify_code').':') !!}
    <b>{{ $driver->user->verify_code ?? '' }}</b>
</div>

<!-- address Field -->
<div class="form-group">
    {!! Form::label('address', __('models/drivers.fields.address').':') !!}
    <b>{{ $driver->address }}</b>
</div>

<!-- housing_type Field -->
<div class="form-group">
    {!! Form::label('housing_type', __('models/drivers.fields.housing_type').':') !!}
    <b>{{ $driver->housing_type == 1 ? 'House' : 'Apartment' }}</b>
</div>

<!-- house_number Field -->
<div class="form-group">
    {!! Form::label('house_number', __('models/drivers.fields.house_number').':') !!}
    <b>{{ $driver->house_number }}</b>
</div>

<!-- state_id Field -->
<div class="form-group">
    {!! Form::label('state_id', __('models/drivers.fields.state').':') !!}
    <b>{{ $driver->state->name ?? '' }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/drivers.fields.status').':') !!}
    @php
    $arrStatus=[
    "0" => __('lang.inactive'),
    "1" => __('lang.active'),
    ];

    @endphp
    <b>{{ $arrStatus[ $driver->user->status ?? '' ] }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/drivers.fields.created_at').':') !!}
    <b>{{ $driver->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/drivers.fields.updated_at').':') !!}
    <b>{{ $driver->updated_at }}</b>
</div>


{{--
    'name',
        'address',
        'housing_type',
        'house_number',
        'state_id',
        'building_number',
        'apartment_number',
    --}}

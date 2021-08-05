<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/customers.fields.name') . ':') !!}
    <b>{{ $customer->name }}</b>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/customers.fields.phone') . ':') !!}
    <b>{{ $customer->user->phone ?? '' }}</b>
</div>

<!-- housing_type Field -->
<div class="form-group">
    {!! Form::label('email', __('models/customers.fields.housing_type') . ':') !!}
    <b>{{ $customer->housing_type == 1 ? 'House' : 'Apartment' }}</b>
</div>

<!-- state Field -->
<div class="form-group">
    {!! Form::label('state_id', __('models/customers.fields.state') . ':') !!}
    <b>{{ $customer->state->name ?? '' }}</b>
</div>

<!-- house_number Field -->
<div class="form-group">
    {!! Form::label('house_number', __('models/customers.fields.house_number') . ':') !!}
    <b>{{ $customer->house_number }}</b>
</div>

<!-- building_number Field -->
<div class="form-group">
    {!! Form::label('building_number', __('models/customers.fields.building_number') . ':') !!}
    <b>{{ $customer->building_number }}</b>
</div>

<!-- apartment_number Field -->
<div class="form-group">
    {!! Form::label('apartment_number', __('models/customers.fields.apartment_number') . ':') !!}
    <b>{{ $customer->apartment_number }}</b>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/customers.fields.status') . ':') !!}
    <b>{{ $customer->user->status ? __('lang.active') : __('lang.inactive') }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/customers.fields.created_at') . ':') !!}
    <b>{{ $customer->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/customers.fields.updated_at') . ':') !!}
    <b>{{ $customer->updated_at }}</b>
</div>

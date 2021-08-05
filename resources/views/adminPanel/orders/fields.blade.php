<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/orders.fields.name').':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Address Field -->
<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/orders.fields.address').':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<!-- Housing Type Field -->
<div class="form-group col-sm-6">
    {!! Form::label('housing_type', __('models/orders.fields.housing_type').':') !!}
    {!! Form::text('housing_type', null, ['class' => 'form-control']) !!}
</div>

<!-- House Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('house_number', __('models/orders.fields.house_number').':') !!}
    {!! Form::text('house_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Building Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('building_number', __('models/orders.fields.building_number').':') !!}
    {!! Form::text('building_number', null, ['class' => 'form-control']) !!}
</div>

<!-- Apartment Number Field -->
<div class="form-group col-sm-6">
    {!! Form::label('apartment_number', __('models/orders.fields.apartment_number').':') !!}
    {!! Form::text('apartment_number', null, ['class' => 'form-control']) !!}
</div>

<!-- State Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('state_id', __('models/orders.fields.state_id').':') !!}
    {!! Form::text('state_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', __('models/orders.fields.status').':') !!}
    {!! Form::text('status', null, ['class' => 'form-control']) !!}
</div>

<!-- Payment Method Field -->
<div class="form-group col-sm-6">
    {!! Form::label('payment_method', __('models/orders.fields.payment_method').':') !!}
    {!! Form::text('payment_method', null, ['class' => 'form-control']) !!}
</div>

<!-- Subtotal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('subtotal', __('models/orders.fields.subtotal').':') !!}
    {!! Form::text('subtotal', null, ['class' => 'form-control']) !!}
</div>

<!-- Total Field -->
<div class="form-group col-sm-6">
    {!! Form::label('total', __('models/orders.fields.total').':') !!}
    {!! Form::text('total', null, ['class' => 'form-control']) !!}
</div>

<!-- User Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('user_id', __('models/orders.fields.user_id').':') !!}
    {!! Form::text('user_id', null, ['class' => 'form-control']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.orders.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

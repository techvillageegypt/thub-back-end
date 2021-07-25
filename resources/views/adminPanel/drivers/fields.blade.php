<div class="form-group col-sm-6">
    {!! Form::label('state_id', 'Driver State') !!}
    {!! Form::select('state_id', $states, null, ['class' => 'form-control', 'placeholder' => 'Select State']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('name', __('models/drivers.fields.name') . ':') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

@if (Request::is('*edit'))
<div class="form-group col-sm-6 d-none">
    {!! Form::label('phone', __('models/drivers.fields.phone') . ':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>
@else
<div class="form-group col-sm-6">
    {!! Form::label('phone', __('models/drivers.fields.phone') . ':') !!}
    {!! Form::text('phone', null, ['class' => 'form-control']) !!}
</div>
@endif

<div class="form-group col-sm-6">
    {!! Form::label('address', __('models/drivers.fields.address') . ':') !!}
    {!! Form::text('address', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('housing_type', 'Housing Type') !!}
    {!! Form::select('housing_type', [1 => 'House', 2 => 'Apartment'], null, ['class' => 'form-control', 'placeholder' => 'Select Type']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('house_number', __('models/drivers.fields.house_number') . ':') !!}
    {!! Form::number('house_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('building_number', __('models/drivers.fields.building_number') . ':') !!}
    {!! Form::number('building_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('floor_number', __('models/drivers.fields.floor_number') . ':') !!}
    {!! Form::number('floor_number', null, ['class' => 'form-control']) !!}
</div>

<div class="form-group col-sm-6">
    {!! Form::label('apartment_number', __('models/drivers.fields.apartment_number') . ':') !!}
    {!! Form::number('apartment_number', null, ['class' => 'form-control']) !!}
</div>


<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.drivers.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

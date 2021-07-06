<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/donations.fields.id').':') !!}
    <b>{{ $donation->id }}</b>
</div>

<!-- customer Field -->
<div class="form-group">
    {!! Form::label('customer', __('models/donations.fields.customer').':') !!}
    <b>{{ $donation->customer->name ?? '' }}</b>
</div>

<!-- driver Field -->
<div class="form-group">
    {!! Form::label('driver', __('models/donations.fields.driver').':') !!}
    <b>{{ $donation->driver->name ?? '' }}</b>
</div>

<!-- pickup_date Field -->
<div class="form-group">
    {!! Form::label('pickup_date', __('models/donations.fields.pickup_date').':') !!}
    <b>{{ $donation->pickup_date }}</b>
</div>

<!-- name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/donations.fields.name').':') !!}
    <b>{{ $donation->name }}</b>
</div>

<!-- address Field -->
<div class="form-group">
    {!! Form::label('address', __('models/donations.fields.address').':') !!}
    <b>{{ $donation->address }}</b>
</div>


<!-- housing_type Field -->
<div class="form-group">
    {!! Form::label('housing_type', __('models/donations.fields.housing_type').':') !!}
    <b>{{ $donation->housing_type == 1 ? 'House' : 'Apartment' }}</b>
</div>

<!-- house_number Field -->
<div class="form-group">
    {!! Form::label('house_number', __('models/donations.fields.house_number').':') !!}
    <b>{{ $donation->house_number }}</b>
</div>

<!-- state_id Field -->
<div class="form-group">
    {!! Form::label('state_id', __('models/donations.fields.state').':') !!}
    <b>{{ $donation->state->name ?? '' }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/donations.fields.created_at').':') !!}
    <b>{{ $donation->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/donations.fields.updated_at').':') !!}
    <b>{{ $donation->updated_at }}</b>
</div>



<hr>

<h3>Assign Driver</h3>
<br>

{{-- {!! Form::model($donation,['route' => ['adminPanel.donations.assign_driver',$donation->id], 'method' => 'patch']) !!} --}}
{!! Form::model($donation, ['route' => ['adminPanel.donations.assign_driver', $donation->id], 'method' => 'patch']) !!}

{!! Form::select('driver_id', $drivers, null, ['class' => 'form-control','placeholder' => 'Select Driver']) !!}

{!! Form::submit('Assign', ['class' => 'form-control btn btn-primary mt-4']) !!}

{!! Form::close() !!}

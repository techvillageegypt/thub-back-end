<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/donations.fields.id') . ':') !!}
    <b>{{ $donation->id }}</b>
</div>

<!-- customer Field -->
<div class="form-group">
    {!! Form::label('customer', __('models/donations.fields.customer') . ':') !!}
    <b>{{ $donation->customer->name ?? '' }}</b>
</div>

<!-- driver Field -->
<div class="form-group">
    {!! Form::label('driver', __('models/donations.fields.driver').':') !!}
    <b>{{ $donation->driver->name ?? 'Not Assigned' }}</b>
</div>

<!-- pickup_date Field -->
<div class="form-group">
    {!! Form::label('pickup_date', __('models/donations.fields.pickup_date') . ':') !!}
    <b>{{ $donation->pickup_date }}</b>
</div>

<!-- name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/donations.fields.name') . ':') !!}
    <b>{{ $donation->name }}</b>
</div>

<!-- address Field -->
<div class="form-group">
    {!! Form::label('address', __('models/donations.fields.address') . ':') !!}
    <b>{{ $donation->address }}</b>
</div>


<!-- housing_type Field -->
<div class="form-group">
    {!! Form::label('housing_type', __('models/donations.fields.housing_type') . ':') !!}
    <b>{{ $donation->housing_type == 1 ? 'House' : 'Apartment' }}</b>
</div>

<!-- house_number Field -->
<div class="form-group">
    {!! Form::label('house_number', __('models/donations.fields.house_number') . ':') !!}
    <b>{{ $donation->house_number }}</b>
</div>

<!-- state_id Field -->
<div class="form-group">
    {!! Form::label('state_id', __('models/donations.fields.state') . ':') !!}
    <b>{{ $donation->state->name ?? '' }}</b>
</div>


<!-- status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/donations.fields.status') . ':') !!}
    <b>{{ $donation->status_text}}</b>
</div>

<!-- driver_notes Field -->
<div class="form-group">
    {!! Form::label('driver_notes', __('models/donations.fields.driver_notes') . ':') !!}
    <b>{{ $donation->driver_notes}}</b>
</div>

<!-- customer_notes Field -->
<div class="form-group">
    {!! Form::label('customer_notes', __('models/donations.fields.customer_notes') . ':') !!}
    <b>{{ $donation->customer_notes}}</b>
</div>

<!-- bags Field -->
<div class="form-group">
    {!! Form::label('bags', __('models/donations.fields.bags') . ':') !!}
    <b>{{ $donation->bags}}</b>
</div>

<!-- plastic_bags Field -->
<div class="form-group">
    {!! Form::label('plastic_bags', __('models/donations.fields.plastic_bags') . ':') !!}
    <b>{{ $donation->plastic_bags}}</b>
</div>

<!-- cartons Field -->
<div class="form-group">
    {!! Form::label('cartons', __('models/donations.fields.cartons') . ':') !!}
    <b>{{ $donation->cartons}}</b>
</div>

<!-- cars Field -->
<div class="form-group">
    {!! Form::label('cars', __('models/donations.fields.cars') . ':') !!}
    <b>{{ $donation->cars}}</b>
</div>

<!-- feedback Field -->
<div class="form-group">
    {!! Form::label('feedback', __('models/donations.fields.feedback') . ':') !!}
    @switch($donation->feedback)
    @case(1)
    <b>Sad</b> <i class="far fa-frown-open fa-2x pl-2"></i>
    @break
    @case(2)
    <b>Good</b> <i class="far fa-smile fa-2x pl-2"></i>
    @break
    @case(3)
    <b>Excellent</b> <i class="far fa-smile-beam fa-2x pl-2"></i>
    @break
    @default

    @endswitch
    {{-- <b>{{ $donation->feedback}}</b> --}}
</div>

<!-- feedback_notes Field -->
<div class="form-group">
    {!! Form::label('feedback_notes', __('models/donations.fields.feedback_notes') . ':') !!}
    <b>{{ $donation->feedback_notes}}</b>
</div>



<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/donations.fields.created_at') . ':') !!}
    <b>{{ $donation->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/donations.fields.updated_at') . ':') !!}
    <b>{{ $donation->updated_at }}</b>
</div>



<hr>

<h3>Donation Photos</h3>
<br>
<div class="donation-photos">
    @if (isset($donation->photos))
    @foreach ($donation->photos as $photo)
    <img src="{{$photo->photo}}" alt="" width="150" class="image-thumbnail">

    @endforeach
    @endif
</div>


<hr>

<div class="row">
    <div class="col-6">
        <h3>Assign Driver</h3>
        <br>


        {!! Form::model($donation, ['route' => ['adminPanel.donations.assign_driver', $donation->id], 'method' => 'patch']) !!}

        {!! Form::select('driver_id', $drivers, null, ['class' => 'form-control','placeholder' => 'Select Driver']) !!}

        {!! Form::submit('Assign', ['class' => 'form-control btn btn-primary mt-4']) !!}

        {!! Form::close() !!}

        <br>
    </div>
    @if ($donation->status == 4)
    <div class="col-6">

        <h3>Update Pickup Date</h3>
        <br>


        {!! Form::model($donation, ['route' => ['adminPanel.donations.updatePickupDate', $donation->id], 'method' => 'patch']) !!}

        <div class="form-group row">
            <div class="col-sm-12">
                <div class="input-group date" id="kt_datetimepicker_1" data-target-input="nearest">
                    <input type="text" class="form-control datetimepicker-input" placeholder="Select date & time" data-target="#kt_datetimepicker_1" name="pickup_date" />
                    <div class="input-group-append" data-target="#kt_datetimepicker_1" data-toggle="datetimepicker">
                        <span class="input-group-text">
                            <i class="ki ki-calendar"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit('Update', ['class' => 'form-control btn btn-primary mt-4']) !!}

        {!! Form::close() !!}
    </div>
    @endif
</div>

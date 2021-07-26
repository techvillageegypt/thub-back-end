<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/orders.fields.id').':') !!}
    <b>{{ $order->id }}</b>
</div>


<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/orders.fields.name').':') !!}
    <b>{{ $order->name }}</b>
</div>


<!-- Address Field -->
<div class="form-group">
    {!! Form::label('address', __('models/orders.fields.address').':') !!}
    <b>{{ $order->address }}</b>
</div>


<!-- Housing Type Field -->
<div class="form-group">
    {!! Form::label('housing_type', __('models/orders.fields.housing_type').':') !!}
    <b>{{ $order->housing_type }}</b>
</div>


<!-- House Number Field -->
<div class="form-group">
    {!! Form::label('house_number', __('models/orders.fields.house_number').':') !!}
    <b>{{ $order->house_number }}</b>
</div>


<!-- Building Number Field -->
<div class="form-group">
    {!! Form::label('building_number', __('models/orders.fields.building_number').':') !!}
    <b>{{ $order->building_number }}</b>
</div>


<!-- Floor Number Field -->
<div class="form-group">
    {!! Form::label('floor_number', __('models/orders.fields.floor_number').':') !!}
    <b>{{ $order->floor_number }}</b>
</div>


<!-- Apartment Number Field -->
<div class="form-group">
    {!! Form::label('apartment_number', __('models/orders.fields.apartment_number').':') !!}
    <b>{{ $order->apartment_number }}</b>
</div>


<!-- State Id Field -->
<div class="form-group">
    {!! Form::label('state_id', __('models/orders.fields.state_id').':') !!}
    <b>{{ $order->state }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/orders.fields.status').':') !!}
    <b>{{ $order->status }}</b>
</div>


<!-- Payment Method Field -->
<div class="form-group">
    {!! Form::label('payment_method', __('models/orders.fields.payment_method').':') !!}
    <b>{{ $order->payment_method }}</b>
</div>


{{-- <!-- Subtotal Field -->
<div class="form-group">
    {!! Form::label('subtotal', __('models/orders.fields.subtotal').':') !!}
    <b>{{ $order->subtotal }}</b>
</div>
--}}

<!-- Total Field -->
<div class="form-group">
    {!! Form::label('total', __('models/orders.fields.total').':') !!}
    <b>{{ $order->total }} @lang('lang.currency')</b>
</div>

{{--
<!-- User Id Field -->
<div class="form-group">
    {!! Form::label('user_id', __('models/orders.fields.user_id').':') !!}
    <b>{{ $order->user_id }}</b>
</div> --}}


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/orders.fields.created_at').':') !!}
    <b>{{ $order->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/orders.fields.updated_at').':') !!}
    <b>{{ $order->updated_at }}</b>
</div>

<br>
<hr><br>

<h3> Order Items </h3>
<div class="order_items">
    <table class="table table-separate table-head-custom table-checkable">
        <thead>
            <tr>
                <th>Title</th>
                <th>Color</th>
                <th>Size</th>
                <th>Price</th>
                <th>Quantity</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($order->items as $item)
            <tr>
                <td>{{$item->title}}</td>
                <td>
                    <div style="background-color:{{$item->color}};
                        width: 25px;
                        height: 25px;
                        border: 2px solid #ddd;
                        border-radius: 50%;">
                    </div>
                </td>
                <td>{{$item->size}}</td>
                <td>{{$item->price}} @lang('lang.currency')</td>
                <td>{{$item->quantity}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

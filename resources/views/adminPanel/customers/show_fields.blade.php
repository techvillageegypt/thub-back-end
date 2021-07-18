<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/customers.fields.photo').':') !!}
    <br>
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ asset('uploads/images/original/' . $customer->photo) }}" width="150px">
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/customers.fields.id').':') !!}
    <b>{{ $customer->id }}</b>
</div>

<!-- Name Field -->
<div class="form-group">
    {!! Form::label('name', __('models/customers.fields.name').':') !!}
    <b>{{ $customer->name }}</b>
</div>

<!-- Phone Field -->
<div class="form-group">
    {!! Form::label('phone', __('models/customers.fields.phone').':') !!}
    <b>{{ $customer->phone }}</b>
</div>

<!-- Email Field -->
<div class="form-group">
    {!! Form::label('email', __('models/customers.fields.email').':') !!}
    <b>{{ $customer->email }}</b>
</div>

<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/customers.fields.status').':') !!}
    <b>{{ $customer->status ? __('lang.active') : __('lang.inactive') }}</b>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/customers.fields.created_at').':') !!}
    <b>{{ $customer->created_at }}</b>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/customers.fields.updated_at').':') !!}
    <b>{{ $customer->updated_at }}</b>
</div>

<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/brands.fields.id').':') !!}
    <b>{{ $brand->id }}</b>
</div>


<!-- Logo Field -->
<div class="form-group">
    {!! Form::label('logo', __('models/brands.fields.logo').':') !!}
    <b>{{ $brand->logo }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/brands.fields.created_at').':') !!}
    <b>{{ $brand->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/brands.fields.updated_at').':') !!}
    <b>{{ $brand->updated_at }}</b>
</div>



@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('text', __('models/brands.fields.text').':') !!}
    <b>{{ $brand->translateOrNew($locale)->text }}</b>
</div>

@endforeach

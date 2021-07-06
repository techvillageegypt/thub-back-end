<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/sizes.fields.id').':') !!}
    <b>{{ $size->id }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/sizes.fields.created_at').':') !!}
    <b>{{ $size->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/sizes.fields.updated_at').':') !!}
    <b>{{ $size->updated_at }}</b>
</div>





@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('name', __('models/sizes.fields.name').':') !!}
    <b>{{ $size->translateOrNew($locale)->name }}</b>
</div>

@endforeach

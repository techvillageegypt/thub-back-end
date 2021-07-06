<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/colors.fields.id').':') !!}
    <b>{{ $color->id }}</b>
</div>

<!-- Hex Field -->
<div class="form-group">
    {!! Form::label('hex', __('models/colors.fields.hex').':') !!}
    <b>{{ $color->hex }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/colors.fields.created_at').':') !!}
    <b>{{ $color->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/colors.fields.updated_at').':') !!}
    <b>{{ $color->updated_at }}</b>
</div>




@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('name', __('models/colors.fields.name').':') !!}
    <b>{{ $color->translateOrNew($locale)->name }}</b>
</div>

@endforeach

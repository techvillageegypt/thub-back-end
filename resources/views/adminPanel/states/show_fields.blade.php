<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/states.fields.id') . ':') !!}
    <b>{{ $state->id }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/states.fields.created_at') . ':') !!}
    <b>{{ $state->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/states.fields.updated_at') . ':') !!}
    <b>{{ $state->updated_at }}</b>
</div>



@foreach (config('langs') as $locale => $name)
    <h3>
        <code> {{ $name }} </code>
    </h3>
    <br>
    <div class="form-group">
        {!! Form::label('name', __('models/states.fields.name') . ':') !!}
        <b>{{ $state->translateOrNew($locale)->name }}</b>
    </div>

@endforeach

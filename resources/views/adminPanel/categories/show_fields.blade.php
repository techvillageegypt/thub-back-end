<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/categories.fields.id').':') !!}
    <b>{{ $category->id }}</b>
</div>


<!-- parent Id Field -->
<div class="form-group">
    {!! Form::label('parent_id', __('models/categories.fields.parent_id').':') !!}
    <b>{{ $category->parent->name ?? '' }}</b>
</div>


<!-- Text Field -->
<div class="form-group">
    {!! Form::label('name', __('models/categories.fields.name').':') !!}
    <b>{{ $category->name }}</b>
</div>


<!-- Brief Field -->
<div class="form-group">
    {!! Form::label('brief', __('models/categories.fields.brief').':') !!}
    <b>{{ $category->brief }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/categories.fields.status').':') !!}
    <b>{{ $category->status }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/categories.fields.created_at').':') !!}
    <b>{{ $category->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/categories.fields.updated_at').':') !!}
    <b>{{ $category->updated_at }}</b>
</div>



@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('name', __('models/categories.fields.name').':') !!}
    <b>{{ $category->translateOrNew($locale)->name }}</b>
</div>

<div class="form-group">
    {!! Form::label('brief', __('models/categories.fields.brief').':') !!}
    <b>{{ $category->translateOrNew($locale)->brief }}</b>
</div>

@endforeach

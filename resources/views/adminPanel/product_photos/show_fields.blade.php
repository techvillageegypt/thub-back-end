<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/productPhotos.fields.id').':') !!}
    <b>{{ $productPhoto->id }}</b>
</div>


<!-- Product Id Field -->
<div class="form-group">
    {!! Form::label('product_id', __('models/productPhotos.fields.product_id').':') !!}
    <b>{{ $productPhoto->product_id }}</b>
</div>


<!-- Photo Field -->
<div class="form-group">
    {!! Form::label('photo', __('models/productPhotos.fields.photo').':') !!}
    <b>{{ $productPhoto->photo }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/productPhotos.fields.created_at').':') !!}
    <b>{{ $productPhoto->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/productPhotos.fields.updated_at').':') !!}
    <b>{{ $productPhoto->updated_at }}</b>
</div>



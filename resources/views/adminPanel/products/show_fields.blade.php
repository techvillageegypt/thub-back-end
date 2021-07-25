<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/products.fields.id').':') !!}
    <b>{{ $product->id }}</b>
</div>

<!-- sale Price Field -->
<div class="form-group">
    {!! Form::label('sale_price', __('models/products.fields.sale_price').':') !!}
    <b>{{ $product->sale_price }}</b>
</div>


<!-- Price Field -->
<div class="form-group">
    {!! Form::label('price', __('models/products.fields.price').':') !!}
    <b>{{ $product->price }}</b>
</div>


<!-- Stock Field -->
<div class="form-group">
    {!! Form::label('stock', __('models/products.fields.stock').':') !!}
    <b>{{ $product->stock }}</b>
</div>


<!-- Status Field -->
<div class="form-group">
    {!! Form::label('status', __('models/products.fields.status').':') !!}
    <b>{{ $product->status }}</b>
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/products.fields.created_at').':') !!}
    <b>{{ $product->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/products.fields.updated_at').':') !!}
    <b>{{ $product->updated_at }}</b>
</div>



@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('title', __('models/colors.fields.title').':') !!}
    <b>{{ $color->translateOrNew($locale)->title }}</b>
</div>
<div class="form-group">
    {!! Form::label('brief', __('models/colors.fields.brief').':') !!}
    <b>{{ $color->translateOrNew($locale)->brief }}</b>
</div>
<div class="form-group">
    {!! Form::label('description', __('models/colors.fields.description').':') !!}
    <b>{{ $color->translateOrNew($locale)->description }}</b>
</div>

@endforeach

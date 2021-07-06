<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', __('models/donationTypes.fields.id').':') !!}
    <b>{{ $donationType->id }}</b>
</div>


<!-- Icon Field -->
<div class="form-group">
    {!! Form::label('icon', __('models/donationTypes.fields.icon').':') !!}
    <img onError="this.onerror=null;this.src='{{asset('uploads/images/original/default.png')}}';" src="{{ $donationType->icon_thumbnail_path }}" alt="{{ $donationType->name }}" width="100">
</div>


<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', __('models/donationTypes.fields.created_at').':') !!}
    <b>{{ $donationType->created_at }}</b>
</div>


<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', __('models/donationTypes.fields.updated_at').':') !!}
    <b>{{ $donationType->updated_at }}</b>
</div>



@foreach ( config('langs') as $locale => $name)
<h3>
    <code> {{ $name }} </code>
</h3>
<br>
<div class="form-group">
    {!! Form::label('name', __('models/donationTypes.fields.name').':') !!}
    <b>{{ $donationType->translateOrNew($locale)->name }}</b>
</div>

@endforeach

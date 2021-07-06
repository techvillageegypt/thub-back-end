<ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

    @foreach ( config('langs') as $locale => $name)

    <li class="nav-item">
        <a class="nav-link {{request('languages') == $locale ?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ request('languages') == $locale  ? 'true' : 'false'}}">{{$name}}</a>
    </li>

    @endforeach
</ul>
<div class="tab-content mt-5" id="myTabContent">
    @foreach ( config('langs') as $locale => $name)
    <div class="tab-pane fade {{request('languages') == $locale?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">

        <!-- Name Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('name', __('models/categories.fields.name').':') !!}
            {!! Form::text($locale . '[name]', isset($category)? $category->translate($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
        </div>

        <!-- brief Field -->
        <div class="form-group col-sm-6">
            {!! Form::label('brief', __('models/categories.fields.brief').':') !!}
            {!! Form::text($locale . '[brief]', isset($category)? $category->translate($locale)->brief : '' , ['class' => 'form-control', 'placeholder' => $name . ' brief']) !!}
        </div>

    </div>
    @endforeach
</div>
<!-- parent Id Field -->
<div class="form-group col-sm-6">
    {!! Form::label('parent_id', __('models/categories.fields.parent_id').':') !!}
    {!! Form::select('parent_id', $parents, null, ['class' => 'form-control','placeholder' => 'Select Parent Category']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-12">
    {!! Form::label('status', __('models/categories.fields.status').':') !!}
    <div class="radio-inline">
        <label class="radio">
            {!! Form::radio('status', "1", 'Active') !!}
            <span></span>
            @lang('lang.active')
        </label>

        <label class="radio">
            {!! Form::radio('status', " 0", null) !!}
            <span></span>
            @lang('lang.inactive')
        </label>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
    <a href="{{ route('adminPanel.categories.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
</div>

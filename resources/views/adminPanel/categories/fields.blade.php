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

<!-- icon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('icon', __('models/categories.fields.icon').':') !!}

    <br>
    <div class="image-input image-input-outline" id="kt_image_1" style="background-image: url({{asset('uploads/images/original/default.png')}})">
        <div class="image-input-wrapper" style="background-image: url({{isset($category) ? asset('uploads/images/original/'. $category->icon) : ''}})"></div>

        <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Icon">
            <i class="fa fa-pen icon-sm text-muted"></i>
            <input type="file" name="icon" accept=".png, .jpg, .jpeg" />
            <input type="hidden" name="icon_remove" />
        </label>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Icon">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>

        <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Icon">
            <i class="ki ki-bold-close icon-xs text-muted"></i>
        </span>
    </div>
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

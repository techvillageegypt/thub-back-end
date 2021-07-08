<div class="row">
    <div class="col nav-tabs-boxed">

        <ul class="nav nav-light-success nav-pills" id="myTab" role="tablist">

            @foreach ( config('langs') as $locale => $name)

            <li class="nav-item">
                <a class="nav-link {{request('languages') == $locale ?'active':''}}" id="{{$name}}-tab" data-toggle="pill" href="#{{$name}}" role="tab" aria-controls="{{$name}}" aria-selected="{{ request('languages') == $locale  ? 'true' : 'false'}}">{{$name}}</a>
            </li>

            @endforeach

        </ul>

        <div class="tab-content mt-5" id="myTabContent">

            @foreach ( config('langs') as $locale => $name)

            <div class="tab-pane fade {{request('languages') == $locale ?'show active':''}}" id="{{$name}}" role="tabpanel" aria-labelledby="{{$name}}-tab">
                <!-- name Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('name', __('models/donationTypes.fields.name').':') !!}
                    {!! Form::text($locale . '[name]', isset($donationType)? $donationType->translateOrNew($locale)->name : '' , ['class' => 'form-control', 'placeholder' => $name . ' name']) !!}
                </div>

            </div>

            @endforeach

            <div class="clearfix"></div>

            <!-- icon Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('icon', __('models/donationTypes.fields.icon').':') !!}

                <br>
                <div class="image-input image-input-outline" id="kt_image_3" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{isset($donationType) ? asset('uploads/images/original/'. $donationType->icon) : ''}})"></div>

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

            <!-- web_icon Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('web_icon', __('models/donationTypes.fields.web_icon').':') !!}

                <br>
                <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{isset($donationType) ? asset('uploads/images/original/'. $donationType->web_icon) : ''}})"></div>

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
            <div class="clearfix"></div>

            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.donationTypes.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>

        </div>
    </div>
</div>

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
                <!-- welcome_message Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('welcome_message', __('models/options.fields.welcome_message').':') !!}
                    {!! Form::text($locale . '[welcome_message]', isset($option)? $option->translateOrNew($locale)->welcome_message : '' , ['class' => 'form-control', 'placeholder' => $name . ' welcome_message']) !!}
                </div>

                <script type="text/javascript">
                    CKEDITOR.replace("{{ $locale . '[welcome_message]' }}", {
                filebrowserUploadUrl: "{{route('adminPanel.ckeditor.upload', ['_token' => csrf_token() ])}}",
                filebrowserUploadMethod: 'form'
                });
                </script>

            </div>

            @endforeach

            <div class="clearfix"></div>

            <!-- Fav Icon Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('fav_icon', __('models/options.fields.fav_icon').':') !!}

                <br>
                <div class="image-input image-input-outline" id="kt_image_2" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{isset($option) ? asset('uploads/images/original/'. $option->fav_icon) : ''}})"></div>

                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Fav Icon">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="fav_icon" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="fav_icon_remove" />
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Fav Icon">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Fav Icon">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>

            <!-- logo Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('logo', __('models/options.fields.logo').':') !!}

                <br>
                <div class="image-input image-input-outline" id="kt_image_3" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{isset($option) ? asset('uploads/images/original/'. $option->logo) : ''}})"></div>

                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change logo">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="logo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="logo_remove" />
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel logo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove logo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>


            <!-- welcome_photo Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('welcome_photo', __('models/options.fields.welcome_photo').':') !!}

                <br>
                <div class="image-input image-input-outline" id="kt_image_4" style="background-image: url({{asset('uploads/images/original/default.png')}})">
                    <div class="image-input-wrapper" style="background-image: url({{isset($option) ? asset('uploads/images/original/'. $option->welcome_photo) : ''}})"></div>

                    <label class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="change" data-toggle="tooltip" title="" data-original-title="Change Welcome Photo">
                        <i class="fa fa-pen icon-sm text-muted"></i>
                        <input type="file" name="welcome_photo" accept=".png, .jpg, .jpeg" />
                        <input type="hidden" name="welcome_photo_remove" />
                    </label>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="cancel" data-toggle="tooltip" title="Cancel Welcome Photo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>

                    <span class="btn btn-xs btn-icon btn-circle btn-white btn-hover-text-primary btn-shadow" data-action="remove" data-toggle="tooltip" title="Remove Welcome Photo">
                        <i class="ki ki-bold-close icon-xs text-muted"></i>
                    </span>
                </div>
            </div>
            <div class="clearfix"></div>


            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.options.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>




        </div>
    </div>
</div>

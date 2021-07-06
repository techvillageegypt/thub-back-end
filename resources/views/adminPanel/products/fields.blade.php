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

                <!-- title Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('title', __('models/products.fields.title').':') !!}
                    {!! Form::text($locale . '[title]', isset($product)? $product->translateOrNew($locale)->title : '' , ['class' => 'form-control', 'placeholder' => $name . ' title']) !!}
                </div>

                <!-- brief Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('brief', __('models/products.fields.brief').':') !!}
                    {!! Form::text($locale . '[brief]', isset($product)? $product->translateOrNew($locale)->brief : '' , ['class' => 'form-control', 'placeholder' => $name . ' brief']) !!}
                </div>

                <!-- description Field -->
                <div class="form-group col-sm-12">
                    {!! Form::label('description', __('models/products.fields.description').':') !!}
                    {!! Form::textarea($locale . '[description]', isset($product)? $product->translateOrNew($locale)->description : '' , ['class' => 'form-control', 'placeholder' => $name . ' description']) !!}
                </div>

            </div>

            @endforeach

            <div class="clearfix"></div>

            <!-- Category Field -->
            <div class="form-group col-sm-6">
                {!! Form::label('category_id', __('models/products.fields.category_id').':') !!}
                {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Select Category']) !!}
            </div>


            <!-- Status Field -->
            <div class="form-group col-sm-12">
                {!! Form::label('status', __('models/products.fields.status').':') !!}
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

            <br>
            <hr><br>

            <h3>Product Photos</h3>
            <br>
            <div id="product-photos">
                <div id="wrapper">
                    <h2>Drop your Files</h2>
                    <span>or</span>
                    <br />
                    {{-- <form action="" id="form"> --}}
                    <label for="file-upload">Choose Manually</label>
                    <input type="file" name="photos[]" id="file-upload" multiple>
                    <br />
                    {{-- <button type="submit" id="submit">Submit</button> --}}
                    {{-- </form> --}}
                    <div id="file-count"></div>
                    <div id="file-preview">

                    </div>
                </div>
            </div>
            <div class="clearfix"></div>
            <br>
            <hr>
            <br>
            <h3>Product Items</h3>
            <br>
            <div id="product-items">
                @php
                $itemCounter = 1
                @endphp
                <div class="item w-100 d-flex my-1">
                    {!! Form::select("item[$itemCounter][size_id]", $sizes, null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Select Size']) !!}
                    {!! Form::select("item[$itemCounter][color_id]", $colors, null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Select Color']) !!}
                    {!! Form::number("item[$itemCounter][sale_price]", null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Sale Price']) !!}
                    {!! Form::number("item[$itemCounter][price]", null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Regular Price']) !!}
                    {!! Form::number("item[$itemCounter][stock]", null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Stock']) !!}
                </div>
                {{-- @php
                $counter++
                @endphp --}}
                {{-- {{dd($counter)}} --}}
            </div>
            <button id="add-item" class="btn btn-success col-2 my-3" itemCounter="{{$itemCounter}}">Add Item</button>
            <div class="clearfix"></div>
            <br>
            <hr>
            <!-- Submit Field -->
            <div class="form-group col-sm-12">
                {!! Form::submit(__('crud.save'), ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('adminPanel.products.index') }}" class="btn btn-default">@lang('crud.cancel')</a>
            </div>



        </div>
    </div>
</div>







@section('styles')
<style>
    button {
        background: green;
        border: none;
        padding: 10px 20px;
        color: #fff;
        border-radius: 20px;
        margin-top: 15px;
    }

    button:hover {
        cursor: pointer;
        background: darkgreen;
    }

    #product-photos #wrapper {
        /* width: 450px;
        height: 400px; */
        padding: 5rem;
        background: #f1f1f1;
        display: flex;
        justify-content: center;
        flex-direction: column;
        border-radius: 20px;
        text-align: center;
        position: relative;
    }

    #product-photos #wrapper:before {
        content: '';
        position: absolute;

        /* width: 110%;
        height: 110%; */
        left: -25px;
        right: 0;
        top: 0;
        bottom: 0;
        margin: auto;
        border-radius: 20px;
        z-index: -1;
        border: 2px dashed #f1f1f1;
    }

    #product-photos #wrapper.highlight:before {
        border: 2px dashed #e1e1e1;
    }

    #product-photos #wrapper.highlight {
        background: #d1d1d1;
    }

    #file-preview img {
        width: 70px;
        height: 70px;
        object-fit: cover;
        display: inline-block;
        position: relative;
        margin: 5px;
    }

    #file-preview img:hover {
        cursor: pointer;
        opacity: .5;
    }

    #file-preview img:after {
        content: 'asfa';
        position: absolute;
        width: 100%;
        height: 100%;
        margin: auto;
        background: rgba(0, 0, 0, .6);
        z-index: 2;
    }

    input[type="file"] {
        display: none;
    }

    label[for="file-upload"] {
        padding: 10px 25px;
        border: 1px solid #a1a1a1;
        border-radius: 20px;
        font-size: 12px;
    }

    label[for="file-upload"]:hover {
        cursor: pointer;
    }
</style>
@endsection


@section('scripts')
<script>
    (function() {
    const wrapper = document.getElementById('wrapper');
    const form = document.getElementById('product-form');
    const fileUpload = document.getElementById('file-upload');
    const fileCount = document.getElementById('file-count');
    const preview = document.getElementById('file-preview');
    const regex = /\.(jpg|png|jpeg)$/;
    let files = [];

    const dragEvents = ['dragstart, dragover', 'dragend', 'dragleave', 'drop'];
    dragEvents.forEach((eventTarget) => {
        wrapper.addEventListener(eventTarget, (e) => {
            e.preventDefault();
            e.stopPropagation();
            console.log('fired');
        });
    });

    window.addEventListener('drop', (e) => {
        e.preventDefault();
        e.stopImmediatePropagation();
    });
    window.addEventListener('dragover', (e) => {
        e.preventDefault();
        e.stopImmediatePropagation();
    });

    function dragstart() {
        wrapper.classList.add('highlight');
        console.log('dragstart');
    }
    function dragover() {
        wrapper.classList.add('highlight');
        console.log('dragover');
    }
    function dragend() {
        wrapper.classList.remove('highlight');
    }
    function dragleave() {
        wrapper.classList.remove('highlight');
    }

    function checkFile(selectedFiles) {
        for(let file of selectedFiles){
            if(regex.test(file.name)) {
                files.push(file);
            } else {alert('You can only upload images');}
        }
        createPreview(files);
    }

    function dropFiles(e) {
        console.log('drop');
        const transferredFiles = e.dataTransfer.files;
        checkFile(transferredFiles);
        console.log(files);
    }

    function createPreview(filelist) {
        preview.innerHTML = "";
        fileCount.innerHTML = "";
        let count = document.createElement('p');
        count.textContent = `${files.length} ${files.length <= 1 ? 'file' : 'files'} selected `;

        fileCount.appendChild(count);
        filelist.forEach((file) => {
            const img = new Image();
            img.setAttribute('src', URL.createObjectURL(file));
            img.addEventListener('click', () => {
                console.log('clicked');
                files = files.filter((file) => file !== files[img.getAttribute('data-file')]);
                createPreview(files);
            });
            img.dataset.file = filelist.indexOf(file);
            preview.appendChild(img);
        });
    }

    wrapper.addEventListener('dragstart', dragstart);
    wrapper.addEventListener('dragover', dragover);
    wrapper.addEventListener('dragend', dragend);
    wrapper.addEventListener('dragleave', dragleave);
    wrapper.addEventListener('drop', dropFiles);

    fileUpload.addEventListener('change', (e) => {
        const files = e.target.files;
        checkFile(files);
    });

})();
</script>


<script>
    $(document).ready(function () {
            let countItem = $(this).attr('itemCounter');
            $('#add-item').click(function () {
            // console.log(countItem);
            $('#product-items').append(`
                        <div class="item w-100 d-flex my-1">
                            {!! Form::select("item[${countItem}][size_id]", $sizes, null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Select Size']) !!}
                            {!! Form::select("item[${countItem}][color_id]", $colors, null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Select Color']) !!}
                            {!! Form::number("item[${countItem}][sale_price]", null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Sale Price']) !!}
                            {!! Form::number("item[${countItem}][price]", null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Regular Price']) !!}
                            {!! Form::number("item[${countItem}][stock]", null, ['class' => 'form-control col-2 mx-1', 'placeholder' => 'Stock']) !!}
                        </div>
            `)
            $(this).attr('itemCounter', ++countItem);
        });
    });

</script>
@endsection

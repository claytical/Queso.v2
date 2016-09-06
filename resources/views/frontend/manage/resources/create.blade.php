@extends('frontend.layouts.master')

@section('content')
    {!! Form::open(['url' => 'manage/resources/create', 'id'=>'resource-create-form']) !!}
<div class="col-lg-12">
    <h2>Create Resource</h2>
</div>

<div class="col-lg-9">
<div class="form-group">
    {{ Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title of Resource', 'id' => 'title']) }}
</div>

    {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}
 
</div>


<div class="col-lg-3">
<label for="tag">Category</label>
<div class="form-group">
    {{ Form::input('text', 'tag', null, ['class' => 'form-control', 'placeholder' => 'Category', 'id' => 'tag']) }}
</div>
<div class="form-group">
<label for="link">Embedded Link</label>
   	{{ Form::input('text', 'link', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch?q=AAAAAAA', 'id' => 'link']) }}
</div>
<div class="form-group">
<label for="link_label">Link Label</label>
    {{ Form::input('text', 'link_label', null, ['class' => 'form-control', 'placeholder' => 'Optional Label', 'id' => 'link_label']) }}
</div>


    <div id="resource_upload" class="dropzone"></div>
    <hr/>
    <button class="btn btn-primary btn-lg btn-block" id="create_resource">Create</button>

</div>
    {!! Form::close() !!}

@endsection

@section('after-scripts-end')
    <script>
    Dropzone.autoDiscover = false;

    $('#create_resource').click(function() {
        $("#resource-create-form").submit();
    });

    var resource_upload = new Dropzone('div#resource_upload',
        {url:'/dropzone/uploadFiles',
        method: "post"
        });

    resource_upload.on('sending', function(file, xhr, formData){
            var tok = $('input[name="_token"]').val();
            console.log("Appending Token " + tok)
            formData.append('_token', tok);
        });

    resource_upload.on("successmultiple", function(event, response) {
        console.log("MULTIPLE");

        for (var i = 0, len = response.files.length; i < len; i++) {
            $('<input>').attr({
                type: 'hidden',
                id: 'files',
                value: response.files[i].id,
                name: 'files[]'
            }).appendTo('form');
        }

    });

    resource_upload.on("success", function(event, response) {
        for (var i = 0, len = response.files.length; i < len; i++) {
            $('<input>').attr({
                type: 'number',
                id: 'file' + i,
                value: parseInt(response.files[i].id),
                name: 'files[]',
                style: 'display:none;'
            }).appendTo('form');
        }

    });

    </script>
@stop
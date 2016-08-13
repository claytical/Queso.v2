@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Update Resource</h2>
</div>

<div class="col-lg-9">
    {!! Form::open(['url' => 'manage/resource/update', 'id'=> 'resource-update-form']) !!}
    {{ Form::input('text', 'title', $resource->title, ['class' => 'form-control', 'placeholder' => 'Syllabus', 'id' => 'title']) }}
    {{ Form::hidden('id', $resource->id) }}

    {!! Form::textarea('description', $resource->description, ['class' => 'field', 'files' => true]) !!}

</div>


<div class="col-lg-3">
    {{ Form::input('text', 'tag', $resource->tag, ['class' => 'form-control', 'placeholder' => 'Category', 'id' => 'tag']) }}

   	{{ Form::input('text', 'link', $resource->link, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch?q=AAAAAAA', 'id' => 'link']) }}

    @foreach($files as $file)
      {!! link_to('public/uploads/' . $file->name, $file->name, ['class' => 'btn btn-default']) !!}
    @endforeach

    <div id="resource_upload">Drop Files Here</div>
    {!! Form::close() !!}
    <button class="btn btn-primary btn-lg btn-block" id="update_resource">Update</button>


</div>
@endsection

@section('after-scripts-end')
    <script>
        $('#update_resource').click(function() {
        $("#resource-update-form").submit();
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
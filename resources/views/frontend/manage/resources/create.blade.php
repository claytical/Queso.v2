@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Create Resource</h2>
</div>

<div class="col-lg-9">
    {!! Form::open(['url' => 'manage/resources/create', 'id'=>'resource-create-form']) !!}
    {{ Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title of Resource', 'id' => 'title']) }}
    {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}
 
</div>


<div class="col-lg-3">
    {{ Form::input('text', 'tag', null, ['class' => 'form-control', 'placeholder' => 'Category', 'id' => 'tag']) }}

   	{{ Form::input('text', 'link', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch?q=AAAAAAA', 'id' => 'link']) }}
    {!! Form::close() !!}

    {!! Form::open(['url' => 'dropzone/uploadFiles', 'class' => 'dropzone', 'files'=>true, 'id'=>'resource-dropzone']) !!}
    {!! Form::close() !!}

    <button class="btn btn-primary btn-lg btn-block" id="create_resource">Create</button>

</div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop
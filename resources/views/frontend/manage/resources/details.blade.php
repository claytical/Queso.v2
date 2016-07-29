@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Update Resource</h2>
</div>

<div class="col-lg-9">
    {!! Form::open(['url' => 'manage/resources/update', 'id'=>'resource-update-form']) !!}
    {{ Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Syllabus', 'id' => 'title']) }}
    {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}

</div>


<div class="col-lg-3">

   	{{ Form::input('text', 'link', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch?q=AAAAAAA', 'id' => 'link']) }}
    {!! Form::close() !!}

                    <a href="#" class="btn btn-default">filename.pdf</a>[x]          
                    <a href="#" class="btn btn-default">filename.pdf</a>[x] 
                    <a href="#" class="btn btn-default">filename.pdf</a>[x] 


    {!! Form::open(['url' => 'dropzone/uploadFiles', 'class' => 'dropzone', 'files'=>true, 'id'=>'my-awesome-dropzone']) !!}
    {!! Form::close() !!}


</div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop
@extends('frontend.layouts.master')

@section('content')
<h2>Quest Name</h2>

        <div class="col-lg-12">
            <div class="row">
                <h4>Points Available</h4>
                <h6>Due 00/00/000</h6>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                {!! Form::open(array('url' => 'quest/submit', 'class' => '', 'id' => 'no-ajax-upload')) !!}
        
                {!! Form::textarea('notes', null, ['class' => 'field', 'files' => true]) !!}

<!--                <input type="file" name="file" multiple /> -->
                {!! Form::submit('Submit') !!}

                {!! Form::close() !!}
                {!! Form::open(['url' => route('dropzone/uploadFiles'), 'class' => 'dropzone', 'files'=>true, 'id'=>'my-awesome-dropzone']) !!}

            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    Dropzone.options.myAwesomeDropzone = {
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    url: '/dropzone/uploadFiles'
};
    </script>
@stop
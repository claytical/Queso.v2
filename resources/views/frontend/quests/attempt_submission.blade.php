@extends('frontend.layouts.master')

@section('content')
        <div class="col-lg-12">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Quest Name</h2>
                    <h4>Points Available</h4>
                    <h6>Due 00/00/000</h6>
                </div>
   
                <div class="col-lg-10">
                    <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-primary btn-lg">Submit</button>
                </div>

                <div class="col-lg-12">
                    {!! Form::open(array('url' => 'quest/submit', 'class' => '', 'id' => 'no-ajax-upload')) !!}
                    {!! Form::textarea('notes', null, ['class' => 'field', 'files' => true]) !!}
                    {!! Form::close() !!}
                </div>
                <div class="col-lg-12">
                    {!! Form::open(['url' => 'dropzone/uploadFiles', 'class' => 'dropzone', 'files'=>true, 'id'=>'my-awesome-dropzone']) !!}
                </div>
            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    Dropzone.options.myAwesomeDropzone = {
    init: function() {
        this.on("successmultiple", function(file, response){
            response.forEach(function(entry) {
                console.log(entry);
            });
        });
    },
    parallelUploads: 10000,
    method: "post",
    addRemoveLinks: false,
    uploadMultiple: true,
    paramName: "file", // The name that will be used to transfer the file
    maxFilesize: 2, // MB
    url: '/dropzone/uploadFiles'
};
    </script>
@stop
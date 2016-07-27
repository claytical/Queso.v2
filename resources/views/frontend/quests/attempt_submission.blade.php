@extends('frontend.layouts.master')

@section('content')
<h2>Quest Name</h2>

        <div class="col-lg-12">
            <div class="row">
                <h4>Points Available</h4>
                <h6>Due 00/00/000</h6>
                <p>Morbi leo risus, porta ac consectetur ac, vestibulum at eros. Aenean eu leo quam. Pellentesque ornare sem lacinia quam venenatis vestibulum. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec sed odio dui.</p>
                {!! Form::open(array('url' => 'quest/submit', 'class' => 'dropzone', 'id' => 'no-ajax-upload')) !!}
        
                {!! Form::textarea('notes', null, ['class' => 'field', 'files' => true]) !!}
                <div class="dropzone-previews"></div>
<!--                <input type="file" name="file" multiple /> -->
                {!! Form::submit('Submit') !!}

                {!! Form::close() !!}

<form action="/dropzone/uploadFiles"
      class="dropzone"
      id="my-awesome-dropzone"></form>
      
                  <div class="dropzone" id="dropzoneFileUpload">

                    </div>

            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop
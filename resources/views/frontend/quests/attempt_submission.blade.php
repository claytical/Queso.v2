@extends('frontend.layouts.master')

@section('content')
        <div class="col-lg-12">
            <div class="col-lg-9">
                <h2>{!! $quest->name !!}</h2>
                {!! $quest->instructions !!}
                {!! Form::open(array('url' => 'quest/submit', 'class' => 'form-inline', 'id' => 'submission-form')) !!}
                {!! Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) !!}
                {!! Form::hidden('revision', 0) !!}
                {!! Form::hidden('quest_id', $quest->id) !!}
                <div class="form-group">
                    @if($quest->submissions)
                        {!! Form::textarea('submission', ''); !!}
                    @endif

                    @if($quest->uploads)
                        <div id="submission_upload">Drop Files Here</div>
                    @endif
                </div>

                {!! Form::submit('Submit', ['class' => 'btn btn-default']) !!}

                {!! Form::close() !!}
            </div>
            <div class="col-lg-3">
            <ul class="list-unstyled">
                @foreach($skills as $skill)
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-9">
                                {!! $skill->name !!}
                            </div>
                            <div class="col-lg-3">
                                {!! $skill->pivot->amount !!}
                            </div>
                        </div>
                    </li>
                @endforeach
                    <li role="separator" class="divider"></li>
                    <li>
                        <div class="col-lg-12">
                            <div class="col-lg-9">
                            Points Total
                            </div>
                            <div class="col-lg-3">
                                {!! $quest->skills()->sum('amount') !!}
                            </div>
                        </div>
                    </li>
            </ul>
                @if($quest->expires_at)
                <h4>Due {!! date('m-d-Y', strtotime($quest->expires_at) !!}</h4>
                @endif


            </div>
            
        </div>

@endsection

@section('after-scripts-end')
    <script>
    var submission_upload = new Dropzone('div#submission_upload',
        {url:'/dropzone/uploadFiles',
        method: "post"
        });

    submission_upload.on('sending', function(file, xhr, formData){
            var tok = $('input[name="_token"]').val();
            console.log("Appending Token " + tok)
            formData.append('_token', tok);
        });

    submission_upload.on("successmultiple", function(event, response) {
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

    submission_upload.on("success", function(event, response) {
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
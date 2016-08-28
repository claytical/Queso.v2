@extends('frontend.layouts.master')

@section('content')
                {!! Form::open(array('url' => 'quest/submit', 'class' => 'form-inline', 'id' => 'submission-form')) !!}
<div class="col-lg-12">
            <div class="col-lg-9">
                <div class="col-lg-12">
                    <h2>{!! $quest->name !!}</h2>
                    {!! $quest->instructions !!}
                    @if($files)
                    <h6>Attached Files</h6>
                        @foreach($files as $file)
                          {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'btn btn-default preview', 'download' => substr($file->name,5)]) !!}
                        @endforeach
                    @endif
                    {!! Form::hidden('csrf-token', csrf_token(), ['id' => 'csrf-token']) !!}
                    {!! Form::hidden('revision', 0) !!}
                    {!! Form::hidden('quest_id', $quest->id) !!}
                    <hr/>
                </div>
            </div>
            <div class="col-lg-3">
                    @if($quest->expires_at)
                    <h2>Due in {!! \Carbon\Carbon::parse($quest->expires_at)->diffForHumans() !!}</h2>
                    <h6>On {!! date('m-d-Y', strtotime($quest->expires_at)) !!}</h6>
                    @endif
            </div>
<div class="col-lg-12">
    <div class="col-lg-9">
                @if($quest->submissions)
                    {!! Form::textarea('submission', ''); !!}
                @endif
    </div>
            <div class="col-lg-3">
                @if($quest->uploads)
                    <div id="submission_upload" class="dropzone"></div>
                    <hr/>
                @endif

                <div class="panel panel-default">
                  <div class="panel-heading"> {!! $quest->skills()->sum('amount') !!} Points Available</div>
                  <div class="panel-body">            

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
                    </ul>
                </div>
                </div>
 
                {!! Form::submit('Submit Quest', ['class' => 'btn btn-primary btn-block']) !!}
            </div>
</div>
                {!! Form::close() !!}
@endsection

@section('after-scripts-end')
    <script>
    Dropzone.autoDiscover = false;
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
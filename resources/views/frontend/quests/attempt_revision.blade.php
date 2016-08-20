@extends('frontend.layouts.master')

@section('content')

{!! Form::open(array('url' => 'quest/submit', 'class' => 'form-inline')) !!}

<div class="col-lg-12">
            <div class="col-lg-9">
                    <h2>{!! $quest->name !!}</h2>
                        {!! $quest->instructions !!}
                        @if($quest->expires_at)
                            <h4>Due {!! date('m-d-Y', strtotime($quest->expires_at)) !!}</h4>
                        @endif
                {!! Form::hidden('revision', $previous_attempt->revision + 1) !!}
                {!! Form::hidden('quest_id', $quest->id) !!}
            </div>
            <div class="col-lg-3">
                @if(empty($existing_skills[0]))
                    <h3><span class="label label-danger">UNGRADED</span></h3>
                    <p>By submitting this revision, your previously submitted and ungraded attempt will be discarded.</p>
                @endif
                @if(!empty($existing_skills[0]))
                    <h3>Current Grade <a href="#" data-toggle="modal" data-target="#feedbackModal" class="pull-right"><span class="glyphicon glyphicon-info-sign"></span></a></h3>

                    <ul class="list-unstyled">
                        @foreach($skills as $index => $skill)
                            <li>
                                    <div class="col-lg-6">
                                        {!! $skill->name !!}
                                    </div>
                                    <div class="col-lg-6">                                
                                        {!! $existing_skills[$index]->pivot->amount !!} / {!! $skill->pivot->amount !!}
                                    </div>
                            </li>
                        @endforeach
                            <li>
                                    <div class="col-lg-12">
                                    <br/>
                                    </div>
                                    <div class="col-lg-6">
                                        Total
                                    </div>
                                    <div class="col-lg-6">
                                        {!! $total !!} / {!! $quest->skills()->sum('amount') !!}
                                    </div>
                            </li>
                    </ul>
                    @endif

            </div> 
    <div class="col-lg-12">
    <hr/>
    </div>
    <div class="col-lg-9">
            @if($quest->quest_type_id == 1)           
                @if($quest->submissions)
                    {!! Form::textarea('submission', $previous_attempt->submission); !!}
                @endif
            @endif

            @if($quest->quest_type_id == 4)
                <div class="form-group">
                {!! Form::text('link', null); !!}
                </div>
            @endif
    </div>

    <div class="col-lg-3">
            @if($quest->uploads)                        
                <div id="submission_upload" class="dropzone"></div>
            @endif

            @if(!$files->isEmpty())
                <h4>Previously Submitted Files</h4>
                @foreach($files as $file)
                    {!! link_to('public/uploads/' . $file->name, $file->name, ['class' => 'btn btn-default']) !!}
                @endforeach
                
            @endif


    
            <hr/>
            {!! Form::submit('Submit Revision', ['class' => 'btn btn-primary btn-block']) !!}
            
</div>
<!-- Modal -->
<div class="modal fade" id="feedbackModal" tabindex="-1" role="dialog" aria-labelledby="feedbackModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Feedback</h4>
      </div>
      <div class="modal-body">
            @if($positive)
                <h4>What Your Peers Liked</h4>
                @foreach($positive as $feedback)            
                    <div class="col-lg-12">

                        <h6>{!! $feedback->user_from->name !!}</h6>
                        <a class="pull-right give-feedback" href="{!! url('feedback/like', [$feedback->id])!!}" role="button"><span class="glyphicon glyphicon-heart"></span></a>                        {!! $feedback->note !!}


                    </div>
                @endforeach
            @endif
            @if($negative)
                <h4>Suggestions From Your Peers</h4>
                @foreach($negative as $feedback)
                    <div class="col-lg-12">
                        <h6>{!! $feedback->user_from->name !!}</h6>
                          <a class="pull-right give-feedback" href="{!! url('feedback/like', [$feedback->id])!!}" role="button"><span class="glyphicon glyphicon-heart"></span></a>
                        {!! $feedback->note !!}

                    </div>    
                @endforeach
            @endif
            
            @if(empty($existing_skills[0]))
            <div class="col-lg-12">
                <h4>From The Professor</h4>
                @foreach($instructor_feedback as $feedback)
                    {!! $feedback->note !!}
                @endforeach
            </div>
            @endif

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
{!! Form::close() !!}

@endsection

@section('after-scripts-end')
    <script>
    Dropzone.autoDiscover = false;

    var submission_upload = new Dropzone('div#submission_upload',
        {url:'dropzone/uploadFiles',
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
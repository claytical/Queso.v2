@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
    <h2>Quest Details</h2>
</div>
<div class="col-lg-9">

    <div>

      <!-- Nav tabs -->
      <ul class="nav nav-pills" role="tablist">
        <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">General</a></li>
        <li role="presentation"><a href="#skills" aria-controls="skills" role="tab" data-toggle="tab">Skills</a></li>
        <li role="presentation"><a href="#thresholds" aria-controls="thresholsd" role="tab" data-toggle="tab">Thresholds</a></li>
        @if($quest->instant)
          <li role="presentation"><a href="#codes" aria-controls="codes" role="tab" data-toggle="tab">Redemption Codes</a></li>
        @endif
        <li role="presentation"><a href="#files" aria-controls="files" role="tab" data-toggle="tab">Files</a></li>
      </ul>
      {!! Form::open(['url' => 'manage/quest/update', 'id'=>'quest-update-form']) !!}

      <!-- Tab panes -->
      <div class="tab-content">
        <div role="tabpanel" class="tab-pane active" id="home">
        <div class="extra-top-padding">
          <div class="form-group">
            {{ Form::input('text', 'name', $quest->name, ['class' => 'form-control', 'placeholder' => 'A New Adventure', 'id' => 'quest_title']) }}
            </div>
            {!! Form::hidden('id', $quest->id) !!}
            {!! Form::textarea('description', $quest->instructions, ['class' => 'field']) !!}
          </div>
        </div>
        <div role="tabpanel" class="tab-pane" id="skills">
        @foreach($skills as $skill)
            <div class="form-group">
              <label for="skill{!! $skill->id!!}" class="col-sm-2 control-label">{!! $skill->name !!}</label>
              <div class="col-sm-10">
                <input type="number" class="form-control" id="skill{!! $skill->id!!}" name="skill[]" value={!! $skill->pivot->amount!!}>
                <input type="hidden" name="skill_id[]" class="" value={!! $skill->id !!}>
              </div>
            </div>

        @endforeach
        </div>
        @if($quest->instant)
          <div role="tabpanel" class="tab-pane" id="codes">
            <div class="extra-top-padding">
            </div>
            <div class="col-md-12">
                {!! link_to('manage/quest/'.$quest->id.'/qrcodes', 'Manage Codes', ['class' => 'btn btn-default']) !!}
            </div>
              @if($codes)
                @foreach($codes as $code)
                  <div class="col-md-3">
                  <h6>{!! $code->code !!}</h6>
                    @if($code->user_id)
                      <span class="label">Redeemed</span>
                    @endif
                  </div>
                @endforeach
              @else
                <p>There are no redemption codes currently.
              @endif
          </div>
        @endif
        <div role="tabpanel" class="tab-pane" id="thresholds">
          <div class="extra-top-padding col-md-12">
          @if($thresholds->isEmpty())
            <p>This quest has no thresholds.</p>
          @else

            @foreach($thresholds as $threshold)
                <div class="form-group">
                  <label for="threshold{!! $threshold->id!!}" class="col-sm-2 control-label">{!! $threshold->skill->name !!}</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" id="threshold{!! $threshold->id!!}" name="threshold[]" value={!! $threshold->amount!!}>
                    <input type="hidden" name="threshold_id[]" class="threshold-input" value={!! $threshold->id !!}>
                  </div>
                </div>

            @endforeach
          @endif
          </div>
        </div>
        <div role="files" class="tab-pane" id="files">
          <div class="extra-top-padding col-md-12">
          @if($files->isEmpty())
            <p>This quest has no files.</p>
          @else
            @foreach($files as $file)
              <div class="input-group-btn">
              {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'btn btn-default preview', 'download' => substr($file->name,5)]) !!}
              {!! link_to('file/remove/' . $file->id, "x", ['class' => 'btn btn-danger']) !!}

              </div>
            @endforeach
          @endif
          </div>
        </div>        
     </div>

    </div>


</div>

<div class="col-lg-3">
    <h4>Options</h4>

    @if($quest->quest_type_id == 3)
<!-- VIDEO -->
    {{ Form::input('text', 'youtube_url', $quest->youtube_id, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?q=AAAAAAAA', 'id' => 'quest_url']) }}
    @endif

<!-- GENERALIZED -->
    {{ Form::input('date', 'expiration', date('Y-m-d', strtotime($quest->expires_at)), ['class' => 'form-control', 'id' => 'quest_expiration']) }}
    
    @if($quest->quest_type_id == 2)
<!-- ACTIVITY -->
        <div class="checkbox">
          <label>
            {!! Form::checkbox('instant', 1, $quest->instant) !!}
            Instant Credit
          </label>
        </div>

    @endif
<!-- LINK OR SUBMISSION -->
    @if($quest->quest_type_id == 4 || $quest->quest_type_id == 1)
        <div class="checkbox">
          <label>
            {!! Form::checkbox('peer_feedback', 1, $quest->peer_feedback) !!}
            Peer Feedback
          </label>
        </div>

        <div class="checkbox">
          <label>
            {!! Form::checkbox('group_submission', 1, $quest->groups) !!}
            Peer Feedback
          </label>
        </div>


    @endif
<!-- SUBMISSION -->
    @if($quest->quest_type_id == 1)
        <div class="checkbox">
          <label>
            {!! Form::checkbox('revisions', 1, $quest->revisions) !!}
            Revisions
          </label>
        </div>
    @endif

<!-- GENERALIZED -->
    <div id="quest_upload" class="dropzone"></div>

    <div>
      <hr/>
      {!! Form::submit('Update', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    </div>
</div>
        
 


@endsection

@section('after-scripts-end')
    <script>
      Dropzone.autoDiscover = false;

    var quest_upload = new Dropzone('div#quest_upload',
        {url:'/dropzone/uploadFiles',
        method: "post"
        });

    quest_upload.on('sending', function(file, xhr, formData){
            var tok = $('input[name="_token"]').val();
            console.log("Appending Token " + tok)
            formData.append('_token', tok);
        });

    quest_upload.on("successmultiple", function(event, response) {
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

    quest_upload.on("success", function(event, response) {
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
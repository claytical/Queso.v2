@extends('frontend.layouts.master')

@section('content')

<div class="col-lg-9">
    <h2>{!! $quest->name !!}, {!! $student->name !!}</h2>
    <h6>Submitted {!! date('m-d-Y', strtotime($attempt->created_at)) !!}</h6>
</div>
<div class="col-lg-3">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#information">More Information</button>
  @if($revision_count > 1)
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
   {!! date('m-d-Y', strtotime($attempt->created_at)) !!} <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    @foreach($revisions as $revision)
        <li>{{ link_to('grade/quest/'.$quest->id . '/' . $revision->id, '#'. $revision->revision . ' ' . date('m-d-Y', strtotime($revision->created_at))) }}</li>
    @endforeach
  </ul>
  @endif

</div>              
</div>
<div class="modal fade" id="information" tabindex="-1" role="dialog" aria-labelledby="information">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="information">Quest Information</h4>
      </div>
      <div class="modal-body">
          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#description" aria-controls="home" role="tab" data-toggle="tab">Instructions</a></li>
            @if($revision_count > 1)
              <li role="presentation"><a href="#previous_feedback" aria-controls="profile" role="tab" data-toggle="tab">Previous Feedback</a></li>
            @endif
          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="description">
            <div class="extra-top-padding">
              {!! $quest->instructions !!}
            </div>
            </div>
            @if($revision_count > 1)
              <div role="tabpanel" class="tab-pane" id="previous_feedback">
                  @foreach($previous_feedback as $feedback)
                  <blockquote>
                    {!! $feedback->note !!}
                    <footer>Revision #{!! $feedback->revision !!} <cite title="Source Title">{!! date('m-d-Y', strtotime($feedback->created_at)) !!}</cite></footer>
                    }
                  </blockquote>
                  @endforeach
              </div>
            @endif
          </div>


      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

    <div class="col-lg-12">
        @if($quest->quest_type_id == 1)
          {!! $attempt->submission !!}
          @if(!$files->isEmpty())
            <h5>Attached Files</h5>
            @foreach($files as $file)
              {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => 'btn btn-default preview', 'download' => substr($file->name,5)]) !!}
            @endforeach
          @endif
        @endif

        @if($quest->quest_type_id == 4)
          <a href="{{ $attempt->url }}" target="_blank">{{ $attempt->url }}</a>
        @endif
          @if(!$positive_feedback->isEmpty() || !$negative_feedback->isEmpty())
            <h4>Peer Feedback</h4>
          @endif
          @if(!$positive_feedback->isEmpty())
            <h5>Positives</h5>    
            @foreach($positive_feedback as $feedback)

              <blockquote>
                {!! $feedback->note !!}
                <footer><cite title="Source Title">{!! $feedback->user_from->name !!}</cite></footer>
              </blockquote>
            @endforeach
        @endif

        @if(!$negative_feedback->isEmpty())
          <h5>Areas for Improvement</h5>

            @foreach($negative_feedback as $feedback)

              <blockquote>
                {!! $feedback->note !!}
                <footer><cite title="Source Title">{!! $feedback->user_from->name !!}</cite></footer>
              </blockquote>
            @endforeach
        @endif
        <hr/>
        <h4>Feedback to Student</h4>
            {!! Form::open(array('url' => 'grade/confirm')) !!}
            {!! Form::hidden('quest_id', $quest->id) !!}
            {!! Form::hidden('attempt_id', $attempt->id) !!}
        <div class="row">
            <div class="col-lg-9">
                {!! Form::textarea('feedback', null, ['class' => 'field', 'files' => true]) !!}
            </div>
            <div class="col-lg-3">

                @foreach($skills as $skill)
                  <div class="col-lg-5">
                      <label>{!! $skill->name !!}</label>
                  </div>
                  <div class="col-lg-7">
                     <div class="input-group">
                        <input type="number" class="form-control point-val" name="skills[]" max="{!! $skill->pivot->amount !!}">
                      {!! Form::hidden('skill_id[]', $skill->id) !!}
                         <div class="input-group-addon"> / {!! $skill->pivot->amount !!}</div>
                      </div>
                  </div>                    
                  @endforeach

                <div class="col-lg-12">
                    <div class="pull-right">
                        <h3><span id="total">0</span> / {!! $quest->skills()->sum('amount') !!}</h3>
                    </div>
                </div>
                  <div class="col-lg-12">
                    {!! Form::submit('Grade', ['class' => 'btn btn-primary btn-lg btn-block']) !!}

                  </div>
            </div>


        </div>
        {!! Form::close() !!}

    </div>
@endsection

@section('after-scripts-end')
    <script>
    $('.point-val').change(function() {
        var totz = 0;
        $( ".point-val" ).each(function( index ) {
            if($(this).val()) {
              totz = totz + parseInt($(this).val());
            }
          });
        $("span#total").html(totz);
    });
    $(document).ready(function () {
        $(window).on('beforeunload', function(){
            return "You have unsaved changes!";
        });
        $(document).on("submit", "form", function(event){
            $(window).off('beforeunload');
        });
    });


    </script>
@stop
@extends('frontend.layouts.master')

@section('content')

<div class="col-lg-9">
    <h2>{!! $quest->name !!}, {!! $user->name !!}</h2>
    <h4>Submitted {!! $attempt->created_at !!}</h4>
</div>
<div class="col-lg-3">
<div class="btn-group pull-right">
  <button type="button" class="btn btn-default" data-toggle="modal" data-target="#information">More Information</button>
  @if($revision_count > 1)
  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Original <span class="caret"></span>
  </button>
  <ul class="dropdown-menu">
    @foreach($revisions as $revision)
      @if($revision->revision == 0)
        <li>{{ link_to('grade/quest/'.$quest->id . '/'. $list['attempt']->id, 'Original') }}</li>
      @else
        <li>{{ link_to('grade/quest/'.$quest->id . '/'. $list['attempt']->id, '#'. $revision->revision . ' ' . $revision->created_at) }}</li>
      @endif
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
            <div role="tabpanel" class="tab-pane active" id="description">{!! $quest->instructions !!}
            </div>
            @if($revision_count > 1)
              <div role="tabpanel" class="tab-pane" id="previous_feedback">
                  <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Joan Ridley</cite></footer>
                  </blockquote>

                  <blockquote>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
                    <footer>Someone famous in <cite title="Source Title">Michael Scott</cite></footer>
                  </blockquote>

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
          {!! $submission->submission !!}
        <h6>Attached Files</h6>
        <a href="#" class="btn btn-default">filename.pdf</a>         
        <a href="#" class="btn btn-default">filename.pdf</a>
        <a href="#" class="btn btn-default">filename.pdf</a>
        @endif

        @if($quest->quest_type_id == 4)
          <a href="{{ $attempt->url }}" data-iframely-url>{{ $attempt->url }}</a>
        @endif
        

        <h4>Peer Feedback</h4>
        <h5>Positives</h5>
        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Joan Ridley</cite></footer>
        </blockquote>

        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Michael Scott</cite></footer>
        </blockquote>

        <h5>Areas for Improvement</h5>

        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Joan Ridley</cite></footer>
        </blockquote>

        <blockquote>
          <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer posuere erat a ante.</p>
          <footer>Someone famous in <cite title="Source Title">Michael Scott</cite></footer>
        </blockquote>

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
                  <div class="col-lg-6">
                      <label>{!! $skill->name !!}</label>
                  </div>
                  <div class="col-lg-6">
                      <input type="number" class="form-control" name="skills[]" max="{!! $skill->pivot->amount !!}">
                      {!! Form::hidden('skill_id[]', $skill->id) !!}

                  </div>                    
                  @endforeach

                <hr/>

                <div class="col-lg-12">
                    <div class="pull-right">
                            <span>xx</span> / {!! $quest->skills()->sum('amount') !!}
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
    </script>
@stop
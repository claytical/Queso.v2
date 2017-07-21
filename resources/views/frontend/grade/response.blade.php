@extends('frontend.layouts.master')

@section('content')

<section class="section dark-section" id="attempt_response">
        <div class="container is-fluid">        
            {!! Form::open(array('url' => 'grade/confirm')) !!}

            <div class="tile">
                <div class="tile is-parent">
                    <div class="tile is-child box">
                        <div class="container is-fluid">
                          <h2 class="title headline is-uppercase">{!! $quest->name !!}, {!! $student->name !!}</h2>
                          <h3 class="subtitle">{!! $quest->instructions !!}</h3>
                          <div class="content">
                          @if($quest->quest_type_id == 1)
                            {!! $attempt->submission !!}
                          @endif
                          
                          @if(!$files->isEmpty())
                              @foreach($files as $file)
                                {!! link_to('uploads/' . $file->name, substr($file->name,5), ['class' => '', 'download' => substr($file->name,5)]) !!}
                              @endforeach
                          @endif
                          </div>
                          @if($revision_count > 1)
                            <h4 class="subtitle">Previous Feedback</h4>
                              <div class="content">
                            @foreach($previous_feedback as $feedback)
                                  <blockquote>
                                    <h5>{!! date('m/d/Y', strtotime($feedback->created_at)) !!}</h5>
                                    {!! $feedback->note !!}                                    
                                  </blockquote>
                            @endforeach
                              </div>
                          @endif
              
                          @if(!$positive_feedback->isEmpty() || !$negative_feedback->isEmpty())
                            <h4 class="subtitle">Peer Feedback</h4>
                          @endif
                          @if(!$positive_feedback->isEmpty())
                            <h5 class="subtitle">Positives</h5>
                            <div class="content">    
                            @foreach($positive_feedback as $feedback)
                              <blockquote>
                              <h6>{!! $feedback->user_from->name !!}</h6>
                                {!! $feedback->note !!}
                              </blockquote>
                            @endforeach
                            </div>
                        @endif

                        @if(!$negative_feedback->isEmpty())
                          <h5 class="subtitle">Areas for Improvement</h5>
                            <div class="content">
                            @foreach($negative_feedback as $feedback)
                              <blockquote>
                                <h6>{!! $feedback->user_from->name !!}</h6>
                                {!! $feedback->note !!}
                              </blockquote>
                            @endforeach
                            </div>
                        @endif

                        <hr/>
                        <h4>Feedback to Student</h4>
                            {!! Form::hidden('quest_id', $quest->id) !!}
                            {!! Form::hidden('attempt_id', $attempt->id) !!}
                            {!! Form::textarea('feedback', null, ['class' => 'field', 'files' => true]) !!}
                        </div>
                    </div>
                </div>
            <div class="tile is-4 is-parent">
              <div class="tile is-child box">
                <h4 class="title headline is-uppercase">{!! date('m-d-Y', strtotime($attempt->created_at)) !!}</h4>
                @if($revision_count > 1)
                  <h4 class="title headline is-uppercase">{!! date('m/d/Y', strtotime($attempt->created_at)) !!}</h4>
                  <nav class="navbar">
                    <div class="navbar-menu">
                      <div class="navbar-end">
                        <div class="navbar-item has-dropdown is-hoverable">
                          <a class="navbar-link  is-active" href="/documentation/overview/start/">
                            Previous Submissions
                          </a>
                          @if(count($revisions) > 0)
                            <div class="navbar-dropdown ">
                              @foreach($revisions as $revision)
                                {{ link_to('grade/quest/'.$quest->id . '/' . $revision->id, '#'. $revision->revision . ' ' . date('m/d/Y', strtotime($revision->created_at)), ['class' => 'navbar-item']) }}
                              @endforeach
                            </div>
                          @endif
                        </div>
                      </div>
                    </div>
                  </nav>

                @endif

                @foreach($skills as $skill)
                  <div class="field">
                    <label class="label">{!! $skill->name !!}</label>                  
                    <div class="control">
                      <input type="range" min="0" step="1" class="rangeslider rangeslider--horizontal point-val" value="0" name="skills[]" max="{!! $skill->pivot->amount !!}" id="skill-input-{{ $skill->id }}">
                      {!! Form::hidden('skill_id[]', $skill->id) !!}
                    </div>
                  </div>
                @endforeach
                <h5>Total Points Awarded 
                    <div class="is-pulled-right"><span id="total">0</span> of {!! $quest->skills()->sum('amount') !!}
                    </div>
                  </h5>
                  <hr/>
                  {!! Form::submit('Grade', ['class' => 'button is-primary is-large is-fullwidth']) !!}
            </div>
          </div>
        </div>
            {!! Form::close() !!}
      </div>
</section>

@endsection

@section('after-scripts-end')
<style>
.rangeslider__handle {
    text-align: center;
    font-weight: bold;
    font-size: 1.5em;
}
</style>
    <script>
        function updateHandle(el, val) {
          el.html(val);
        }
            @foreach($skills as $skill)
              $("#skill-input-{{ $skill->id }}").rangeslider({
                  polyfill: false,
                  onInit: function() {
                    updateHandle($('#skill-input-{{ $skill->id }}+.rangeslider .rangeslider__handle'), 0);
                  }
                  })
                .on('input', function() {
                    updateHandle($('#skill-input-{{ $skill->id }}+.rangeslider .rangeslider__handle'), this.value);
                });

            @endforeach



    $('.point-val').change(function() {
        var totz = 0;
        $( ".point-val" ).each(function( index ) {
            if($(this).val()) {
              totz = totz + parseInt($(this).val());
            }
          });
        $("span#total").html(totz);
    });
/*
    $(document).ready(function () {
        $(window).on('beforeunload', function(){
            return "You have unsaved changes!";
        });
        $(document).on("submit", "form", function(event){
            $(window).off('beforeunload');
        });
    });
*/
    </script>
@stop
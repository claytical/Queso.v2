@extends('frontend.layouts.master')

@section('content')

{!! Form::open(['url' => 'manage/quest/update', 'id'=>'quest-update-form', 'class' => 'msf']) !!}
                    {{ Form::hidden('quest_type_id', 3, ['id' => 'quest_type_id']) }}
                    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                    {{ Form::hidden('submissions_allowed', false, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('uploads_allowed', false, ['id' => 'uploads_allowed']) }}
                    {{ Form::hidden('groups', false, ['id' => 'groups_allowed']) }}
                    {{ Form::hidden('feedback', false, ['id' => 'feedback_allowed']) }}
                    {{ Form::hidden('revisions', false, ['id' => 'revisions_allowed']) }}
                    {{ Form::hidden('instant', false, ['id' => 'instant_allowed']) }}


<section class="hero" id="choose_quest">
  <div class="hero-body">
    <div class="container is-fluid">
        <div class="msf-header">
          <div class="has-text-centered">
            <div class="columns">
              <div class="msf-step column"><i class="fa fa-info"></i> <p>Information</p></div>
              <div class="msf-step column"><i class="fa fa-trophy"></i><p>Skills &amp; Thresholds</p></div>

            </div>
          </div>
        </div>
        <div class="msf-content">
        <div class="msf-view">
            <div class="tile">
                <div class="tile is-8 is-parent">
                  <div class="tile is-child">
                  <!-- Title and Description -->                
                    <div class="field">
                      <p class="control">
                        {{ Form::input('text', 'name', $quest->name, ['class' => 'input is-large', 'placeholder' => 'Quest Title', 'id' => 'quest_title']) }}
                      </p>
                    </div>

                    <div class="field">
                      <p class="control">
                        {!! Form::textarea('description', $quest->instructions, ['class' => 'input', 'placeholder' => 'Enter an explanation or instructions for the quest here...', 'files' => false, 'id' => 'description']) !!}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="tile is-4 is-parent">
                    <div class="tile is-child notification">
                      <h4 class="subtitle">YouTube URL</h4>
                        <div class="field">
                          <p class="control">
                            {{ Form::input('text', 'youtube_url', "http://youtube.com/watch/?v=".$quest->youtube_id, ['class' => 'input', 'placeholder' => 'http://youtube.com/watch/?v=AAAAAAA', 'id' => 'video_url']) }}

                          </p>
                        </div>
                    </div>
                </div>
              </div>
            </div>
            <div class="msf-view">

              <div class="tile is-6 is-parent">
                  <div class="container is-fluid">
                      <p>You can set a maximum amount of points you're able to award to a student for completing this quest for each skill.</p>
                  </div>
              </div>

              <div class="tile">
                  <div class="tile is-6 is-parent">
                    <div class="tile is-child">
                    <!-- Skills -->            
                      <h4 class="subtitle has-text-centered">Points Awarded</h4>

                      @foreach($skills as $skill)
                        <div class="field is-horizontal">
                          <div class="field-label is-normal">
                            <label class="label">{!! $skill->name !!}</label>
                          </div>
                          <div class="field-body">
                            <div class="field is-grouped">
                              <p class="control is-expanded has-icons-left">
                                <input class="input is-large" type="number" name="skill[]" placeholder="Maximum Points" value="{!! $skill->pivot->amount !!}">
                                <input type="hidden" name="skill_id[]" class="skills-input" value={!! $skill->id !!}>
                              </p>
                            </div>
                          </div>
                        </div>
                    
                      @endforeach

                    </div>
                  </div>
                  <div class="tile is-6 is-parent">
                      <div class="tile is-child">
                        <h4 class="subtitle has-text-centered">Minimum Skill Level Required</h4>
                          @foreach($thresholds as $threshold)
                            <div class="field is-horizontal">
                              <div class="field-label is-normal">
                                <label class="label">{!! $threshold->skill->name !!}</label>
                              </div>
                              <div class="field-body">
                                <div class="field is-grouped">
                                  <p class="control is-expanded has-icons-left">
                                    <input class="input is-large" name="threshold[]" type="number" placeholder="Maximum Points" value="{!! $threshold->amount !!}">
                                    <input type="hidden" name="threshold_skill_id[]" class="thresholds-input" value={!! $threshold->id !!}>
                                  </p>
                                </div>
                              </div>
                            </div>

                          @endforeach                       
                      </div>
                  </div>
                </div>

                </div>

              </div>
          </div>
          <div class="msf-navigation">
                <button data-type="back" class="button is-large msf-nav-button" type="button">Previous</button>
                <button data-type="next" class="button is-large msf-nav-button" type="button">Next</button>
                <button data-type="submit" class="button msf-nav-button is-primary is-large" type="submit">Update Quest</button>
          </div>
    </div>
  </div>
</section>
      {!! Form::close() !!}


@endsection

@section('after-scripts-end')
    <script>

    $(".msf:first").multiStepForm({
        activeIndex: 0,
        hideBackButton : false,
        validate: {
          rules: {
            name: "required",
            description: "required"
          }
        }
    });

    </script>

@stop
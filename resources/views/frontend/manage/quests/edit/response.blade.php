@extends('frontend.layouts.master')

@section('content')

{!! Form::open(['url' => 'manage/quest/update', 'id'=>'quest-form', 'class' => 'msf']) !!}
                    {{ Form::hidden('quest_type_id', 1, ['id' => 'submission_type_id']) }}
                    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                    {{ Form::hidden('submissions_allowed', true, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('uploads_allowed', false, ['id' => 'uploads_allowed']) }}
                    {{ Form::hidden('groups', false, ['id' => 'groups_allowed']) }}
                    {{ Form::hidden('instant', false, ['id' => 'instant_allowed']) }}
                    {{ Form::hidden('id', $quest->id, ['id' => 'quest_type_id']) }}


<section class="hero" id="choose_quest">
  <div class="hero-body">
    <div class="container is-fluid">
        <div class="msf-header">
          <div class="has-text-centered">
            <div class="columns">
              <div class="msf-step column"><i class="fa fa-info"></i> <p>Information</p></div>
              <div class="msf-step column"><i class="fa fa-trophy"></i><p>Skills &amp; Thresholds</p></div>
              <div class="msf-step column"><i class="fa fa-paperclip"></i><p>File Attachments</p></div>
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
                      <h4 class="subtitle">Allow Revisions</h4>
                        <div class="field">
                          <p class="control">
                            <label class="radio">
                              <input type="radio" name="revisions" value="1" 
                              @if($quest->revisions)
                                checked
                              @endif
                              >
                              Yes
                            </label>
                            <label class="radio">
                              <input type="radio" name="revisions" value="0"
                              @if(!$quest->revisions)
                                checked
                              @endif
                              >
                              No
                            </label>
                          </p>
                        </div>                      
                      
                      <h4 class="subtitle">Peer Feedback</h4>
                        <div class="field">
                          <p class="control">
                            <label class="radio">
                              <input type="radio" name="feedback" value="1"
                              @if($quest->peer_feedback)
                                checked
                              @endif 
                              >
                              Yes
                            </label>
                            <label class="radio">
                              <input type="radio" name="feedback" value="0"
                              @if($quest->peer_feedback)
                                checked
                              @endif
                              >
                              No
                            </label>
                          </p>
                        </div>   
                  
                      <h4 class="subtitle">Due Date</h4>
                        <div class="field">
                          <p class="control">
                            <label class="radio">
                              <input type="radio" name="expires" value="0"
                              @if(!$quest->expires_at)
                                checked
                              @endif
                              >
                              Anytime
                            </label>
                            <label class="radio">
                              <input type="radio" name="expires" value="1"
                              @if($quest->expires_at)
                                checked
                              @endif
                              >
                              Specific Date
                            </label>
                          </p>
                        </div>
                        <div class="field">
                          <p class="control">
                              {{ Form::input('date', 'expiration', date('Y-m-d', strtotime($quest->expires_at)), ['class' => 'input', 'id' => 'expiration_date']) }}
                          </p>
                        </div>

                    </div>
                </div>
              </div>
            </div>
            <div class="msf-view">

              <div class="tile is-12 is-parent">
                  <div class="container is-fluid">
                      <p>You can set a maximum amount of points you're able to award to a student for completing this quest for each skill. If you set a minimum point value for a skill, the student will only be able to see this quest when they have been awarded at least that amount of points for that specific skill.</p>
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
                                <input class="input is-large" type="number" name="skill[]" placeholder="Maximum Points" value={!! $skill->pivot->amount !!}>
                                <input type="hidden" name="skill_id[]" class="skills-input" value={!! $skill->id !!}>
                              </p>
                            </div>
                          </div>
                        </div>
                    
                      @endforeach
                      @if(count($other_skills))
                      <div id="new_skills" class="field"></div>
                      <div class="field is-horizontal" id="additional_skills_parent">
                        <div class="field-label is-normal">
                          <label class="label">Add Skill</label>
                        </div>
                        <div class="field-body">
                          <div class="select is-large">
                            <select class="valid" aria-invalid="false" placeholder="Select Skill..." id="additional_skills">
                              @foreach($other_skills as $os)
                                <option value="{!! $os->id !!}">{!! $os->name !!}</option>
                              @endforeach
                            </select>
                          </div>
                          <a class="button is-pulled-right is-large" id="add_skill">Add</a>                          
                        </div>
                      @endif
                      </div>
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
                                    <input class="input is-large" name="threshold[]" type="number" placeholder="Maximum Points" value={!! $threshold->amount !!}>
                                    <input type="hidden" name="threshold_id[]" class="thresholds-input" value={!! $threshold->id !!}>
                                    <input type="hidden" name="threshold_skill_id[]" class="thresholds-input" value={!! $threshold->skill->id !!}>

                                  </p>
                                </div>
                              </div>
                            </div>

                          @endforeach
                      <div id="new_thresholds" class="field"></div>
                      @if(count($other_thresholds))
                      <div class="field is-horizontal" id="additional_thresholds_parent">
                        <div class="field-label is-normal">
                          <label class="label">Add Threshold</label>
                        </div>
                        <div class="field-body">
                          <div class="select is-large">
                            <select class="valid" aria-invalid="false" placeholder="Select Skill..." id="additional_thresholds">
                              @foreach($other_thresholds as $ot)
                                <option value="{!! $ot->id !!}">{!! $ot->name !!}</option>
                              @endforeach
                            </select>
                          </div>
                          <a class="button is-pulled-right is-large" id="add_threshold">Add</a>                          
                        </div>
                      @endif
                      </div>                                         
                                               
                      </div>
                  </div>
                </div>

              </div>

            <div class="msf-view">


             <div class="tile">
                  <div class="tile is-6 is-parent">
                    <div class="tile is-child">
                       <div id="quest_uploads" class="dropzone"></div>
                    </div>
                  </div>

                  <div class="tile is-6 is-parent">
                      <div class="tile is-child notification">
                        <h4 class="subtitle">Attached Files</h4>
                          <div id="attached_files">
                            @if(!$files->isEmpty())
                              @foreach($files as $file)
                                <article class='media'>
                                  <div class='media-content'>
                                    <div class='content'>
                                      <p>{!! link_to('uploads/' . $file->name, substr($file->name,5), ['download' => substr($file->name,5)]) !!}</p>
                                    </div>
                                  </div>
                                  <div class='media-right'>
                                    {!! link_to('file/remove/' . $file->id, "", ['class' => 'delete']) !!}
                                  </div>
                                </article>
                              @endforeach
                            @else
                              <p id="no_attached_files">No files have been attached yet.</p>
                            @endif
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
    if($('input[name=expires]:checked').val() == "0") {
          $("#expiration_date").hide();      
    }

    $('input[name=expires]').change(function() {
        if($(this).val() == "0") {
          $("#expiration_date").hide();
        }
        else {
          $("#expiration_date").show();
        }
      });


    $("#add_skill").click(function() {
      var s_id = $("#additional_skills").val();
      var s_name = $("#additional_skills :selected").text();
      $("#additional_skills option[value="+s_id+"]").remove();
      var skillHtml = '<div class="field is-horizontal"><div class="field-label is-normal"><label class="label">';
          skillHtml += s_name;
          skillHtml += "</label></div><div class='field-body'><div class='field is-grouped'><p class='control is-expanded has-icons-left'>";
          skillHtml += "<input class='input is-large' type='number' name='skill[]' placeholder='Maximum Points'>";
          skillHtml += "<input type='hidden' name='skill_id[]' class='skills-input' value=" + s_id + ">";
          skillHtml += "</p></div></div></div>";
          $("#new_skills").append(skillHtml);
          if($("#additional_skills option").length == 0) {
             $("#additional_skills_parent").remove();
          }
    });

    $("#add_threshold").click(function() {
      var s_id = $("#additional_thresholds").val();
      var s_name = $("#additional_thresholds :selected").text();
      $("#additional_thresholds option[value="+s_id+"]").remove();
      var skillHtml = '<div class="field is-horizontal"><div class="field-label is-normal"><label class="label">';
          skillHtml += s_name;
          skillHtml += "</label></div><div class='field-body'><div class='field is-grouped'><p class='control is-expanded has-icons-left'>";
          skillHtml += "<input class='input is-large' type='number' name='threshold[]' placeholder='Maximum Points'>";
          skillHtml += "<input type='hidden' name='threshold_id[]' class='thresholds-input' value=0>";

          skillHtml += "<input type='hidden' name='threshold_skill_id[]' class='thresholds-input' value=" + s_id + ">";
          skillHtml += "</p></div></div></div>";
          $("#new_thresholds").append(skillHtml);
          if($("#additional_thresholds option").length == 0) {
             $("#additional_thresholds_parent").remove();
          }
    });



    </script>
    {{ Html::script('js/manage.quest.files.js')}}

@stop
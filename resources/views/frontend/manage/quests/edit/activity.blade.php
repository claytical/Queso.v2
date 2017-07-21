@extends('frontend.layouts.master')

@section('content')

{!! Form::open(['url' => 'manage/quest/update', 'id'=>'quest-form', 'class' => 'msf']) !!}
                    {{ Form::hidden('quest_type_id', 2, ['id' => 'quest_type_id']) }}
                    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                    {{ Form::hidden('submissions_allowed', false, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('uploads_allowed', false, ['id' => 'uploads_allowed']) }}
                    {{ Form::hidden('groups', false, ['id' => 'groups_allowed']) }}
                    {{ Form::hidden('feedback', false, ['id' => 'feedback_allowed']) }}
                    {{ Form::hidden('revisions', false, ['id' => 'revisions_allowed']) }}
                    {{ Form::hidden('id', $quest->id, ['id' => 'quest_type_id']) }}
                    

<section class="section dark-section" id="create_quest">
  <div class="columns">
    <div class="column is-2">
            @include('frontend.includes.admin')
    </div>
    <div class="column">
      <div class="box">

        <div class="container is-fluid">
            <div class="msf-header">
              <div class="has-text-centered">
                <div class="columns">
                  <div class="msf-step column"><i class="fa fa-info"></i> <p>Information</p></div>
                  <div class="msf-step column"><i class="fa fa-trophy"></i><p>Skills</p></div>
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
                          <h4 class="subtitle">Instant Credit</h4>
                          <div>
                            <p>Queso will generate unique one time use codes that students can redeem for points immediately. The QR code generator can also place these codes onto a sheet that you can print out and use as handouts.</p>
                          </div>
                            <div class="field">
                              <p class="control">
                                <label class="radio">                            
                                  <input type="radio" name="instant" value="1" 
                                  @if($quest->instant)
                                    checked
                                  @endif
                                  >
                                  Yes
                                </label>
                                <label class="radio">
                                  <input type="radio" name="instant" value="0"
                                  @if(!$quest->instant)
                                    checked
                                  @endif
                                  >
                                  No
                                </label>
                              </p>
                            </div>
                          <div id="generate_codes">
                            <p>{!! count($codes) !!} Codes</p>
                            <h4 class="subtitle">Number of New Codes to Generate</h4>
                            <div class="field">
                              <p class="control">
                                {{ Form::input('number', 'number_of_codes', null, ['class' => 'input is-large', 'placeholder' => 'Amount', 'id' => 'generate_qrcodes']) }}
                              </p>
                            </div>
                          </div>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="msf-view">

                  <div class="tile is-12 is-parent">
                      <div class="container is-fluid">
                          <p>You can set a maximum amount of points you're able to award to a student for completing this quest for each skill.</p>
                      </div>
                  </div>

                  <div class="tile">
                      <div class="tile is-12 is-parent">
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
                                    <input class="input is-large" type="number" value="{!! $skill->pivot->amount !!}" name="skill[]" placeholder="Maximum Points">
                                    <input type="hidden" name="skill_id[]" class="skills-input" value={!! $skill->id !!}>
                                  </p>
                                </div>
                              </div>
                            </div>
                        
                          @endforeach

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

              </div>
              <div class="msf-navigation">
                    <button data-type="back" class="button is-large msf-nav-button" type="button">Previous</button>
                    <button data-type="next" class="button is-large msf-nav-button" type="button">Next</button>
                    <button data-type="submit" class="button msf-nav-button is-primary is-large" type="submit">Update Quest</button>
              </div>
        </div>
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
    if($('input[name=instant]:checked').val() == "0") {
          $("#generate_codes").hide();      
    }
    $('input[name=instant]').change(function() {
        if($(this).val() == "0") {
          $("#generate_codes").hide();
        }
        else {
          $("#generate_codes").show();
        }
      });

    </script>
    {{ Html::script('js/manage.quest.files.js')}}

@stop
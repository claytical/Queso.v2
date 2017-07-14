@extends('frontend.layouts.master')

@section('content')

{!! Form::open(['url' => 'manage/quest/create', 'id'=>'quest-create-form', 'class' => 'msf']) !!}
                    {{ Form::hidden('quest_type_id', 3, ['id' => 'quest_type_id']) }}
                    {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                    {{ Form::hidden('submissions_allowed', false, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('uploads_allowed', false, ['id' => 'uploads_allowed']) }}
                    {{ Form::hidden('groups', false, ['id' => 'groups_allowed']) }}
                    {{ Form::hidden('feedback', false, ['id' => 'feedback_allowed']) }}
                    {{ Form::hidden('revisions', false, ['id' => 'revisions_allowed']) }}

<section class="hero" id="choose_quest">
  <div class="hero-body">
    <div class="container is-fluid">
        <div class="msf-header">
          <div class="has-text-centered">
            <div class="columns">
              <div class="msf-step column"><i class="fa fa-info"></i> <p>Information</p></div>
              <div class="msf-step column"><i class="fa fa-trophy"></i><p>Skills</p></div>
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
                        {{ Form::input('text', 'name', null, ['class' => 'input is-large', 'placeholder' => 'Quest Title', 'id' => 'quest_title']) }}
                      </p>
                    </div>

                    <div class="field">
                      <p class="control">
                        {!! Form::textarea('description', null, ['class' => 'input', 'placeholder' => 'Enter an explanation or instructions for the quest here...', 'files' => false, 'id' => 'description']) !!}
                      </p>
                    </div>
                  </div>
                </div>

                <div class="tile is-4 is-parent">
                    <div class="tile is-child notification">
                      <h4 class="subtitle">YouTube URL</h4>
                        <div class="field">
                          <p class="control">
                            {{ Form::input('text', 'video_url', null, ['class' => 'input', 'placeholder' => 'http://youtube.com/watch/?v=AAAAAAA', 'id' => 'video_url']) }}

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
                                <input class="input is-large" type="number" name="skill[]" placeholder="Maximum Points">
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
                          @foreach($skills as $skill)
                            <div class="field is-horizontal">
                              <div class="field-label is-normal">
                                <label class="label">{!! $skill->name !!}</label>
                              </div>
                              <div class="field-body">
                                <div class="field is-grouped">
                                  <p class="control is-expanded has-icons-left">
                                    <input class="input is-large" name="threshold[]" type="number" placeholder="Maximum Points">
                                    <input type="hidden" name="threshold_skill_id[]" class="thresholds-input" value={!! $skill->id !!}>
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
<!--
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


                        <article class="media">
                          <figure class="media-left">
                            <p class="image is-64x64">
                              <img src="http://bulma.io/images/placeholders/128x128.png">
                            </p>
                          </figure>
                          <div class="media-content">
                            <div class="content">
                              <p>filename.pdf
                              </p>
                            </div>
                          </div>
                          <div class="media-right">
                            <button class="delete"></button>
                          </div>
                        </article>

                        <article class="media">
                          <figure class="media-left">
                            <p class="image is-64x64">
                              <img src="http://bulma.io/images/placeholders/128x128.png">
                            </p>
                          </figure>
                          <div class="media-content">
                            <div class="content">
                              <p>filename.pdf
                              </p>
                            </div>
                          </div>
                          <div class="media-right">
                            <button class="delete"></button>
                          </div>
                        </article>


                    </div>
                </div>
              </div>



            </div>
-->
          </div>
          <div class="msf-navigation">
                <button data-type="back" class="button is-large msf-nav-button" type="button">Previous</button>
                <button data-type="next" class="button is-large msf-nav-button" type="button">Next</button>
                <button data-type="submit" class="button msf-nav-button is-primary is-large" type="submit">Create Quest</button>
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
    $('input[name=instant]').change(function() {
        if($(this).val() == "0") {
          $("#generate_codes").hide();
        }
        else {
          $("#generate_codes").show();
        }
      });

/*
    Dropzone.autoDiscover = false;
    var quest_upload = new Dropzone('div#quest_uploads',
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
            }).appendTo(qf);
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
            }).appendTo(qf);
        }

    });

    */



    </script>
@stop
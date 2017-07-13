@extends('frontend.layouts.master')

@section('content')

{!! Form::open(['url' => 'manage/quest/create', 'id'=>'quest-create-form']) !!}

<section class="hero is-dark is-bold" id="choose_quest">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        New Quest
      </h1>
        <h2 class="subtitle">What kind of quest is this?</h2>

            <div class="tile is-ancestor">
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Online Submission</p>
                  <p class="subtitle">Students send a link or upload a file through Queso</p>
                  <a href="#" class="button is-info is-large">Create</a>
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Group Submission</p>
                  <p class="subtitle">One student sends a link or uploads a file through Queso on behalf of a group of students</p>
                  <a href="#" class="button is-info is-large">Create</a>
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Watch a Video</p>
                  <p class="subtitle">A student watches a video through Queso and receives credit automatically</p>
                  <a href="#" class="button is-info is-large">Create</a>
                </article>
              </div>
              <div class="tile is-parent">
                <article class="tile is-child box">
                  <p class="title">Classroom Activity</p>
                  <p class="subtitle">An activity that happened outside of Queso</p>
                  <a href="#" class="button is-info is-large">Create</a>
                </article>
              </div>
            </div>
    </div>
  </div>
</section>




<section class="hero is-dark is-bold" id="quest_name">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        New Quest
      </h1>
        <h2 class="subtitle">What's the name of this quest?</h2>

        <div class="field">
          <p class="control">
            {{ Form::input('text', 'name', null, ['class' => 'input', 'placeholder' => 'A New Adventure', 'id' => 'quest_title']) }}
          </p>
        </div>

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="quest_type_style">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        Quest Type
      </h1>
        <h2 class="subtitle">Do students need to submit something online to complete this quest?</h2>
                    <button type="button" class="btn btn-default btn-lg" id="submit_something_next">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="no_submission_next">No</button>

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="quest_type_submission">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        Submission Method
      </h1>
        <h2 class="subtitle">How will the students submit their work?</h2>
                    <button type="button" class="btn btn-default btn-block" id="submission_link">Link to a Website</button> 
                    <button type="button" class="btn btn-default btn-block" id="submission_upload">Upload a File</button>
                    <button type="button" class="btn btn-default btn-block" id="submission_either">Either</button>
                    {{ Form::hidden('submission_type', null, ['id' => 'submission_type_id']) }}
                    {{ Form::hidden('submissions_allowed', true, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('uploads_allowed', true, ['id' => 'uploads_allowed']) }}

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="quest_type_activity">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        Submission Method
      </h1>
        <h2 class="subtitle">How will students get points?</h2>

                    <button type="button" class="btn btn-default btn-block" id="activity_next">In Class Activity, I'll Assign Points</button> <!-- #inclass_instant -->
                    <button type="button" class="btn btn-default btn-block" id="watch_next">Watch a Video Online</button> <!-- #video_url -->
                    {{ Form::hidden('quest_type', null, ['id' => 'quest_type_id']) }}


        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="submission_group">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        Submission Method
      </h1>
        <h2 class="subtitle">Should students submit their work individually or as a group?</h2>

                    <button type="button" class="btn btn-default btn-block" id="individual_next">Individual</button>
                    <button type="button" class="btn btn-default btn-block" id="groups_next">Group</button>
                    {{ Form::hidden('groups_allowed', true, ['id' => 'groups_allowed']) }}

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="submission_revisions">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        Submission Revisions
      </h1>
        <h2 class="subtitle">Should students be able to revise their submission?</h2>

                    <button type="button" class="btn btn-default btn-lg" id="revisions_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="revisions_disallowed">No</button>
                    {{ Form::hidden('revisions', true, ['id' => 'revisions_option']) }}
        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="peer_feedback">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Peer Feedback</h1>
        <h2 class="subtitle">Do you want a student's other team members to provide feedback on their submitted work?</h2>
                    <button type="button" class="btn btn-default btn-lg" id="feedback_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="feedback_disallowed">No</button>
                    {{ Form::hidden('feedback', false, ['id' => 'feedback_option']) }}
        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="inclass_instant">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Instant Credit</h1>
        <h2 class="subtitle">Do you want to allow a student to enter unique code for instant credit on this quest?</h2>
                    <button type="button" class="btn btn-default btn-lg" id="instant_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="instant_disallowed">No</button>
                    {{ Form::hidden('instant', true, ['id' => 'instant_option']) }}

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="video_url">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">What's the URL for the video?</h1>
        <h2 class="subtitle">Please note, for the automatic point assignment to happen, the video needs to be hosted by YouTube.</h2>
                    {{ Form::input('text', 'video_url', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?v=AAAAAAA', 'id' => 'video_url']) }}


        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="expiration">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Should this quest disappear after a certain date?</h1>
        <h2 class="subtitle">Please note, if you use this feature you should set a timezone for the course.</h2>
                    <button type="button" class="btn btn-default btn-lg" id="expiration_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="expiration_disallowed">No</button>


        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="set_expiration">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">When should the quest disappear?</h1>

                    {{ Form::input('date', 'expiration', null, ['class' => 'form-control', 'id' => 'expiration_date']) }}

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="skills">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">What are the maximum point values for each skill?</h1>
        <h2 class="subtitle">Please note, if you use this feature you should set a timezone for the course.</h2>
                    @foreach($skills as $skill)
                      <div class="form-group">
                        <label for="skill{!! $skill->id!!}" class="col-sm-2 control-label">{!! $skill->name !!}</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control skills-input" id="skill{!! $skill->id!!}" name="skill[]">
                          <input type="hidden" name="skill_id[]" class="skills-input" value={!! $skill->id !!}>
                        </div>
                      </div>
                    @endforeach

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="thresholds">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Should a student be required to have a minimum skill level in order to see this quest?</h1>
                    <button type="button" class="btn btn-default btn-lg" id="thresholds_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="thresholds_disallowed">No</button>

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="set_thresholds">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">What are the minimum skill level values in order to see this quest?</h1>
                      @foreach($skills as $skill)
                        <label for="threshold{!! $skill->id!!}" class="col-sm-2 control-label">{!! $skill->name!!}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control thresholds-input" id="threshold{!! $skill->id!!}" name="threshold[]">
                            <input type="hidden" name="threshold_skill_id[]" class="thresholds-input" value={!! $skill->id !!}>

                        </div>
                      @endforeach

        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>

<section class="hero is-dark is-bold" id="attach_files">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Would you like to attach any supporting files to this quest?</h1>
                    <button type="button" class="btn btn-default btn-lg" id="files_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="files_disallowed">No</button>
        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="file_attachments">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Drop the files you would like to upload onto the box below</h1>
                    <div id="quest_uploads" class="dropzone"></div>
        <a href="#" class="button is-primary is-large">Next</a>
    </div>
  </div>
</section>


<section class="hero is-dark is-bold" id="attach_files">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</h1>
        {!! Form::textarea('description', null, ['class' => 'field', 'files' => false, 'id' => 'description']) !!}

        <a href="#" class="button is-primary is-large">Finish</a>
    </div>
  </div>
</section>

{!! Form::submit('Create', ['class' => 'btn btn-primary btn-lg btn-block', 'style' => 'display:none;', 'id' => 'create-button']) !!}

{!! Form::close() !!}

@endsection

@section('after-scripts-end')
    <script>
    var qf = $("#quest-create-form");
    var skipThresholds = false;
    $( "#name_next" ).click(function() {
        $("#quest_name").hide();
        $("#quest_title").hide();
        qf.append($("#quest_title"));
        $("#quest_name_selection h5").html($("#quest_title").val());
        $("#quest_name_selection").show();
        $("#quest_type_style").show();
    });

    //
    $("#submit_something_next").click(function() {
        //what kind of submission?
        $("#quest_type_style").hide();
        $("#quest_type_submission").show();
    });

    $("#no_submission_next").click(function() {
        //what kind of activity?
        $("#quest_type_style").hide();
        $("#quest_type_activity").show();

    });

    $("#submission_link").click(function() {
        $("#quest_type_id").val(4);        
        qf.append($("#quest_type_id"));
        $("#quest_type_selection h5").html("Send a Link");
        $("#quest_type_selection").show();
        $("#submission_group").show();
        $("#quest_type_submission").hide();        

    });

    $("#submission_upload").click(function() {
       $("#quest_type_id").val(1);        
        $("#upload_selection h5").html("Upload File");
        $("#upload_selection").show();
        qf.append($("#quest_type_id"));
        qf.append($("#uploads_allowed"));
        $("#upload_selection").show();        
        $("#quest_type_submission").hide();        
        $("#submission_group").show();
    });

    $("#submission_write").click(function() {
        $("#quest_type_id").val(1);        
        $("#upload_selection h5").html("Text Entry");
        $("#upload_selection").show();
        qf.append($("#quest_type_id"));
        qf.append($("#submissions_allowed"));
        $("#quest_type_submission").hide();        
        $("#submission_group").show();

    });

    $("#submission_either").click(function() {
        $("#quest_type_id").val(1);
        $("#upload_selection").show();
        $("#upload_selection h5").html("Upload File or Text Entry");
        $("#upload_selection").show();
        $("#quest_type_submission").hide();        

        qf.append($("#quest_type_id"));
        qf.append($("#submissions_allowed"));
        qf.append($("#uploads_allowed"));
        $("#submission_group").show();

    });

    $( "#submission_next" ).click(function() {
        $("#quest_type").hide();
        $("#quest_type_selection h5").html("Submission");
        $("#quest_type_selection").show();
        $("#quest_type_id").val(1);
        $("#submission_selection").show();
        qf.append($("#quest_type_id"));
    });

    $( "#activity_next" ).click(function() {
        $("#quest_type_activity").hide();
        //flag to skip minimum thresholds
        skipThresholds = true;
        $("#quest_type_selection h5").html("In Class Activity");
        $("#quest_type_selection").show();
        $("#quest_type").hide();
        $("#quest_type_id").val(2);
        $("#inclass_instant").show();
        qf.append($("#quest_type_id"));
    });

    $( "#instant_allowed" ).click(function() {
        $("#inclass_instant").hide();
        $("#instant_selection h5").html("Enabled");
        $("#instant_selection").show();
        $("#instant_option").val(1);        
        qf.append($("#instant_option")); 
        $("#expiration").show();
    });

    $( "#instant_disallowed" ).click(function() {
        $("#inclass_instant").hide();
//        ("#instant_option").val(0);
//        qf.append($("#instant_option")); 
        $("#expiration").show();
    });

    $( "#watch_next" ).click(function() {

        $("#quest_type_activity").hide();
        $("#quest_type_selection h5").html("Watch Video");
        $("#quest_type_selection").show();

        $("#quest_type_id").val(3);
        qf.append($("#quest_type_id"));
        $("#video_url").show();
    });

    $( "#video_next" ).click(function() {
        $("#video_url").hide();
        $("#url_selection h5").html($("#video_url").val())
        $("#url_selection").show();
        qf.append($("#video_url"));
        $("#expiration").show();
    });
/*
    $( "#link_next" ).click(function() {
        $("#quest_type").hide();
        $("#quest_type_id").val(4);        
        qf.append($("#quest_type_id"));
        $("#quest_type_selection h5").html("Submit Link");
        $("#quest_type_selection").show();
        $("#submission_group").show();
//        $("#submission_revisions").show();

//        $("#peer_feedback").show();
    });
*/
/*
    $( "#written_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_type_id").val(1);
        $("#upload_selection h5").html("Written");
        $("#upload_selection").show();

        qf.append($("#submission_type_id"));
        qf.append($("#submissions_allowed"));
        //written only
//        $("#submission_revisions").show();
        $("#submission_group").show();

    });
*/

/*
    $( "#upload_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_type_id").val(2);
        $("#upload_selection h5").html("Uploads Only");
        $("#upload_selection").show();

        //uploads only
        qf.append($("#submission_type_id"));
        qf.append($("#uploads_allowed"));
        $("#upload_selection").show();
//        $("#submission_revisions").show();
        $("#submission_group").show();

    });
*/
    $( "#either_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_type_id").val(3);
        //both written and upload
        $("#upload_selection").show();
        $("#upload_selection h5").html("Upload or Text Entry");
        $("#upload_selection").show();

        qf.append($("#submissions_allowed"));
        qf.append($("#uploads_allowed"));
        qf.append($("#submission_type_id"));
//        $("#submission_revisions").show();
        $("#submission_group").show();

    });

    $("#individual_next").click(function() {
        $('#submission_group').hide();
        $("#group_selection h5").html("Individually");
        $("#group_selection").show();
        $("#submission_revisions").show();
    });

    $("#groups_next").click(function()  {
        $('#submission_group').hide();
        $("#submission_revisions").show();        
        $("#group_selection h5").html("In Groups");
        $("#group_selection").show();
        qf.append($("#groups_allowed"));

    });

    $( "#revisions_allowed" ).click(function() {
        $("#submission_revisions").hide();
        $("#revisions_option").val(1);
        $("#revision_selection h5").html("Enabled");
        $("#revision_selection").show();
        qf.append($("#revisions_option"));
        $("#peer_feedback").show();
    });

    $( "#revisions_disallowed" ).click(function() {
        $("#submission_revisions").hide();
        $("#revision_selection h5").html("Disabled");
        $("#revision_selection").show();        
        $("#peer_feedback").show();
    });

    $( "#feedback_disallowed" ).click(function() {
        $("#peer_feedback").hide();
        $("#expiration").show();
        $("#feedback_selection h5").html("Disabled");
        $("#feedback_selection").show();
    });

    $( "#feedback_allowed" ).click(function() {
        $("#peer_feedback").hide();
        $("#feedback_selection h5").html("Enabled");
        $("#feedback_selection").show();
        $("#feedback_option").val(1);        
        qf.append($("#feedback_option")); 
        $("#expiration").show();
    });

    $( "#expiration_allowed" ).click(function() {
        $("#expiration").hide();
        $("#set_expiration").show();
    });

    $( "#expiration_disallowed" ).click(function() {
        $("#expiration").hide();
        $("#expires_selection h5").html("Never");
        $("#expires_selection").show();
        $("#skills").show();
//        $("#quest_description").show();
    });

    $( "#expiration_set").click(function() {

          var xd = new Date($("#expiration_date").val());
          if(!isNaN(xd)) {
            $("#set_expiration").hide();
            $("#expiration_date").hide();
            $("#expires_selection h5").html($("#expiration_date").val());
            $("#expires_selection").show();
            qf.append($("#expiration_date"));
            $("#skills").show();
          }
          else {
            alert("Please enter a valid date.");
          }
    });
/*
    $( "#description_set" ).click(function() {
        $("#quest_description").hide();
        qf.append($("#description"));
//        $("#skills").show();
    });
*/
    $( "#skills_set" ).click(function() {
        $("#skills").hide();
        $(".skills-input").hide();
        qf.append($(".skills-input"));
        if (skipThresholds) {
            $("#attach_files").show();

        }
        else {
            $("#thresholds").show();

        }
    });

    $( "#thresholds_allowed" ).click(function() {
        $("#thresholds").hide();
        $("#set_thresholds").show();
    });

    $( "#thresholds_disallowed" ).click(function() {
        $("#thresholds").hide();
        $("#attach_files").show();
    });

    $( "#thresholds_set" ).click(function() {
        $("#set_thresholds").hide();
        $(".thresholds-input").hide();
        qf.append($(".thresholds-input"));
        $("#attach_files").show();
    });

    $( "#files_allowed").click(function() {
        $("#attach_files").hide();
        $("#file_attachments").show();
    });

    $( "#set_files").click(function() {
        $("#file_attachments").hide();
        $("#create-button").show();
        $("#finished").show();
    });

    $( "#files_disallowed" ).click(function() {
        $("#attach_files").hide();
        $("#create-button").show();
        $("#finished").show();
    });
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



    </script>
@stop
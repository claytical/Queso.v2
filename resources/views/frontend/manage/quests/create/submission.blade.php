@extends('frontend.layouts.master')

@section('content')

{!! Form::open(['url' => 'manage/quest/create', 'id'=>'quest-create-form']) !!}

<section class="hero is-dark is-bold" id="choose_quest">
  <div class="hero-body">
    <div class="container is-fluid">
        <h1 class="title">
        New Online Submission Quest
      </h1>
    </div>
  </div>
</section>




<section class="hero is-dark is-bold" id="quest_name">
  <div class="hero-body">
    <div class="container is-fluid">
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
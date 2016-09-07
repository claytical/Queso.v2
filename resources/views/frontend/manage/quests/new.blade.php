@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Create Quest</h2>
    </div>
</div>

<div class="col-lg-8">

    <div id="quest_name">
        <div class="row">
            <div class="col-lg-12">
                <h3>What's the name of this quest?</h3>
                    <div class="input-group">
                        {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'A New Adventure', 'id' => 'quest_title']) }}
                       <span class="input-group-btn">
                        <button type="button" class="btn btn-default" id="name_next" style="margin-left: 10px;">Next</button>
                        </span>
                    </div>
            </div>
        </div>
    </div>

    <div id="quest_type_style" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Do students need to submit something to complete this quest?</h3>
                    <button type="button" class="btn btn-default btn-lg" id="submit_something_next">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="no_submission_next">No</button>
            </div>
        </div>
    </div>

    <div id="quest_type_submission" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>How will the students submit their work?</h3>

                    <button type="button" class="btn btn-default btn-block" id="submission_link">Link to a Website</button> 
                    <button type="button" class="btn btn-default btn-block" id="submission_upload">Upload a File</button>
                    <button type="button" class="btn btn-default btn-block" id="submission_write">Write in a Textbox</button> 
                    <button type="button" class="btn btn-default btn-block" id="submission_either">Write in a Textbox or Upload a File</button>
                    {{ Form::hidden('submission_type', null, ['id' => 'submission_type_id']) }}
                    {{ Form::hidden('uploads_allowed', true, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('submissions_allowed', true, ['id' => 'uploads_allowed']) }}

            </div>
        </div>
    </div>

    <div id="quest_type_activity" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>How will students get points?</h3>
                    <button type="button" class="btn btn-default btn-block" id="activity_next">In Class Activity, I'll Assign Points</button> <!-- #inclass_instant -->
                    <button type="button" class="btn btn-default btn-block" id="watch_next">Watch a Video Online</button> <!-- #video_url -->
                    {{ Form::hidden('quest_type', null, ['id' => 'quest_type_id']) }}

            </div>
        </div>
    </div>

<!--
    <div id="submission_selection" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>How should students submit their work?</h3>
                    <button type="button" class="btn btn-default btn-lg" id="written_next">Write in a Textbox</button>
                    <button type="button" class="btn btn-default btn-lg" id="upload_next">Upload Files</button>
                    <button type="button" class="btn btn-default btn-lg" id="either_next">Either</button>


            </div>
        </div>
    </div>

    -->

    <div id="submission_group" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Should students submit their work individually or as a group?</h3>
                    <button type="button" class="btn btn-default btn-block" id="individual_next">Individual</button>
                    <button type="button" class="btn btn-default btn-block" id="groups_next">Group</button>
                    {{ Form::hidden('groups_allowed', true, ['id' => 'groups_allowed']) }}

            </div>
        </div>
    </div>


    <div id="submission_revisions" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Should a student be able to revise their work after it has been submitted?</h3>
                    <button type="button" class="btn btn-default btn-lg" id="revisions_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="revisions_disallowed">No</button>
                    {{ Form::hidden('revisions', true, ['id' => 'revisions_option']) }}

            </div>
        </div>
    </div>

    <div id="peer_feedback" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Do you want a student's other team members to provide feedback on their submitted work?</h3>
                    <button type="button" class="btn btn-default btn-lg" id="feedback_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="feedback_disallowed">No</button>
                    {{ Form::hidden('feedback', false, ['id' => 'feedback_option']) }}

            </div>
        </div>
    </div>

    <div id="inclass_instant" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Do you want to allow a student to enter unique code for instant credit on this quest?</h3>
                    <button type="button" class="btn btn-default btn-lg" id="instant_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="instant_disallowed">No</button>
                    {{ Form::hidden('instant', true, ['id' => 'instant_option']) }}

            </div>
        </div>
    </div>

    <div id="video_url" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>What's the URL for the video?</h3>
                <p>Please note, for the automatic point assignment to happen, the video needs to be hosted by YouTube.</p>
                    <div class="input-group">
                    {{ Form::input('text', 'video_url', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?v=AAAAAAA', 'id' => 'video_url']) }}
                    <span class="input-group-btn">                    
                    <button type="button" class="btn btn-default btn-lg" id="video_next">Next</button>
                    </span>
                    </div>
            </div>
        </div>
    </div>

    <div id="expiration" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Should this quest disappear after a certain date?</h3>
                <p>Please note, if you use this feature you should set a timezone for the course.</p>
                    <button type="button" class="btn btn-default btn-lg" id="expiration_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="expiration_disallowed">No</button>
            </div>
        </div>
    </div>

    <div id="set_expiration" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>When should the quest disappear?</h3>
                <div class="input-group">                    
                    {{ Form::input('date', 'expiration', null, ['class' => 'form-control', 'id' => 'expiration_date']) }}
                    <span class="input-group-btn">               
                    <button type="button" class="btn btn-default" id="expiration_set">Next</button>
                    </span>
                </div>
            </div>
        </div>
    </div>


    <div id="skills" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>What are the maximum point values for each skill?</h3>
                    <form class="form-horizontal">
                    @foreach($skills as $skill)
                      <div class="form-group">
                        <label for="skill{!! $skill->id!!}" class="col-sm-2 control-label">{!! $skill->name !!}</label>
                        <div class="col-sm-10">
                          <input type="number" class="form-control skills-input" id="skill{!! $skill->id!!}" name="skill[]">
                          <input type="hidden" name="skill_id[]" class="skills-input" value={!! $skill->id !!}>
                        </div>
                      </div>
                    @endforeach
                
                    <button type="button" class="btn btn-default" id="skills_set">Next</button>
                    </form>
            </div>
        </div>
    </div>

    <div id="thresholds" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Should a student be required to have a minimum skill level in order to see this quest?</h3>
                    <button type="button" class="btn btn-default btn-lg" id="thresholds_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="thresholds_disallowed">No</button>
            </div>
        </div>
    </div>

    <div id="set_thresholds" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>What are the minimum skill level values in order to see this quest?</h3>
                    <form class="form-horizontal">
                      <div class="form-group">
                      @foreach($skills as $skill)
                        <label for="threshold{!! $skill->id!!}" class="col-sm-2 control-label">{!! $skill->name!!}</label>
                        <div class="col-sm-10">
                            <input type="number" class="form-control thresholds-input" id="threshold{!! $skill->id!!}" name="threshold[]">
                            <input type="hidden" name="threshold_skill_id[]" class="thresholds-input" value={!! $skill->id !!}>

                        </div>
                      @endforeach
                      </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-default" id="thresholds_set">Next</button>
                      </div>

                    </form>
            </div>
        </div>
    </div>

    <div id="attach_files" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Would you like to attach any supporting files to this quest?</h3>
                    <button type="button" class="btn btn-default btn-lg" id="files_allowed">Yes</button>
                    <button type="button" class="btn btn-default btn-lg" id="files_disallowed">No</button>
            </div>
        </div>
    </div>

    <div id="file_attachments" style="display:none;">
        <div class="row">
                <div class="col-lg-12">
                    <div id="quest_uploads" class="dropzone"></div>
                </div>
                <div class="col-lg-12">
                    <hr/>
                      <div class="form-group">
                        <button type="button" class="btn btn-default btn-lg pull-right" id="set_files">Next</button>

                      </div>
                </div>
        </div>
    </div>

    <div id="finished" style="display:none;">
        <div class="row">
            <div class="col-lg-12">

                <h3>Almost there!</h3>
                    {!! Form::open(['url' => 'manage/quest/create', 'id'=>'quest-create-form']) !!}
                <p class="lead">Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</p>
                   {!! Form::textarea('description', null, ['class' => 'field', 'files' => false, 'id' => 'description']) !!}



            </div>
        </div>
    </div>
</div>

<div class="col-lg-4">
    <div id="quest_name_selection" style="display:none;">
    <label>Quest Name</label>
        <h5></h5>
    </div>
    <div id="quest_type_selection" style="display:none;">
        <label>Quest Type</label>
        <h5></h5>
    </div>

    <div id="url_selection" style="display:none;">
        <label>URL</label>
        <h5></h5>
    </div>

    <div id="instant_selection" style="display:none;">
    <label>Instant Credit</label>
        <h5></h5>
    </div>

    <div id="upload_selection" style="display:none;">
    <label>Method</label>
        <h5></h5>
    </div>
    <div id="group_selection" style="display:none;">
    <label>Submitted</label>
        <h5></h5>
    </div>

    <div id="revision_selection" style="display:none;">
        <label>Revisions</label>
        <h5></h5>
    </div>
    
    <div id="feedback_selection" style="display:none;">
        <label>Peer Feedback</label>
        <h5></h5>
    </div>

    <div id="expires_selection" style="display:none;">
        <label>Expires</label>
        <h5></h5>
    </div>
    
    <div id="file_selection" style="display:none;">
    <label>Files Attached</label>
        <ul id="file-list" class="unstyled-list">
            <li></li>
        </ul>
    </div>

    <div id="skills_selection" style="display:none;">
        <h5>Skills</h5>
        <ul id="skill-list" class="unstyled-list">
            <li></li>
        </ul>
    </div>
    <div id="thresholds_selection" style="display:none;">
        <h5>Thresholds</h5>
       <ul id="threshold-list" class="unstyled-list">
            <li></li>
        </ul>
 
    </div>
    {!! Form::submit('Create', ['class' => 'btn btn-primary btn-lg btn-block', 'style' => 'display:none;', 'id' => 'create-button']) !!}
    {!! Form::close() !!}
</div>
    

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


    $( "#submission_next" ).click(function() {
        $("#quest_type").hide();
        $("#quest_type_selection h5").html("Submission");
        $("#quest_type_selection").show();
        $("#quest_type_id").val(1);
        qf.append($("#quest_type_id"));
        $("#submission_selection").show();
    });

    $( "#activity_next" ).click(function() {
        //flag to skip minimum thresholds
        skipThresholds = true;
        $("#quest_type_selection h5").html("In Class Activity");
        $("#quest_type_selection").show();

        $("#quest_type").hide();
        $("#quest_type_id").val(2);
        qf.append($("#quest_type_id"));
        $("#inclass_instant").show();
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
        $("#quest_type").hide();
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
        $("#set_expiration").hide();
        $("#expiration_date").hide();
        $("#expires_selection h5").html($("#expiration_date").val());
        $("#expires_selection").show();


        qf.append($("#expiration_date"));
        $("#skills").show();
//        $("#quest_description").show();
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
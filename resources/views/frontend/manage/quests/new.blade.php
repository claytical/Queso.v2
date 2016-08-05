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
                    {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'A New Adventure', 'id' => 'quest_title']) }}
                    <button type="button" class="btn btn-default" id="name_next">Next</button>

            </div>
        </div>
    </div>

    <div id="quest_type" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>What kind of quest is this?</h3>
                    <button type="button" class="btn btn-default" id="submission_next">Submission</button> <!-- #submission_selection -->
                    <button type="button" class="btn btn-default" id="activity_next">In Class Activity</button> <!-- #inclass_instant -->
                    <button type="button" class="btn btn-default" id="watch_next">Watch a Video</button> <!-- #video_url -->
                    <button type="button" class="btn btn-default" id="link_next">Link</button> <!-- #peer_feedback -->
                    {{ Form::hidden('quest_type', null, ['id' => 'quest_type_id']) }}

            </div>
        </div>
    </div>


    <div id="submission_selection" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>How should students submit their work?</h3>
                    <button type="button" class="btn btn-default" id="written_next">Write in a Textbox</button>
                    <button type="button" class="btn btn-default" id="upload_next">Upload Files</button>
                    <button type="button" class="btn btn-default" id="either_next">Either</button>
                    {{ Form::hidden('submission_type', null, ['id' => 'submission_type_id']) }}
                    {{ Form::hidden('uploads_allowed', true, ['id' => 'submissions_allowed']) }}
                    {{ Form::hidden('submissions_allowed', true, ['id' => 'uploads_allowed']) }}

            </div>
        </div>
    </div>

    <div id="submission_revisions" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Should a student be able to revise their submission?</h3>
                    <button type="button" class="btn btn-default" id="revisions_allowed">Yes</button>
                    <button type="button" class="btn btn-default" id="revisions_disallowed">No</button>
                    {{ Form::hidden('revisions', true, ['id' => 'revisions_option']) }}

            </div>
        </div>
    </div>

    <div id="peer_feedback" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Do you want to allow peer feedback?</h3>
                    <button type="button" class="btn btn-default" id="feedback_allowed">Yes</button>
                    <button type="button" class="btn btn-default" id="feedback_disallowed">No</button>
                    {{ Form::hidden('feedback', false, ['id' => 'feedback_option']) }}

            </div>
        </div>
    </div>

    <div id="inclass_instant" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Do you want to allow a student to enter unique code for instant credit?</h3>
                    <button type="button" class="btn btn-default" id="instant_allowed">Yes</button>
                    <button type="button" class="btn btn-default" id="instant_disallowed">No</button>
                    {{ Form::hidden('instant', true, ['id' => 'instant_option']) }}

            </div>
        </div>
    </div>

    <div id="video_url" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>What's the URL for the video?</h3>
                    {{ Form::input('text', 'video_url', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?q=AAAAAAA', 'id' => 'video_url']) }}
                <button type="button" class="btn btn-default" id="video_next">Next</button>
            </div>
        </div>
    </div>

    <div id="expiration" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Should this quest disappear after a certain date?</h3>
                    <button type="button" class="btn btn-default" id="expiration_allowed">Yes</button>
                    <button type="button" class="btn btn-default" id="expiration_disallowed">No</button>
            </div>
        </div>
    </div>

    <div id="set_expiration" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>When should the quest disappear?</h3>
                    {{ Form::input('date', 'expiration', null, ['class' => 'form-control', 'id' => 'expiration_date']) }}
                    <button type="button" class="btn btn-default" id="expiration_set">Next</button>

            </div>
        </div>
    </div>

    <div id="quest_description" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</h3>
                {!! Form::textarea('description', null, ['class' => 'field', 'files' => true, 'id' => 'description']) !!}
                <button type="button" class="btn btn-default" id="description_set">Next</button>
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
                    <button type="button" class="btn btn-default" id="thresholds_allowed">Yes</button>
                    <button type="button" class="btn btn-default" id="thresholds_disallowed">No</button>
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
                    <button type="button" class="btn btn-default" id="files_allowed">Yes</button>
                    <button type="button" class="btn btn-default" id="files_disallowed">No</button>
            </div>
        </div>
    </div>

    <div id="file_attachments" style="display:none;">
        <div class="row">
                <div class="col-lg-12">
                    {!! Form::open(['url' => 'dropzone/uploadFiles', 'class' => 'dropzone', 'files'=>true, 'id'=>'my-awesome-dropzone']) !!}
                    {!! Form::close() !!}
                </div>
                      <div class="form-group">
                        <button type="button" class="btn btn-default" id="set_files">Next</button>

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
    <h4 id="quest_name_selection"></h4>
    <h5 id="quest_type_selection"></h5>
    <h5 id="url_selection"></h5>
    <p id="description_selection"></p>
    <div id="instant_selection" style="display:none;">Instant Credit</div>
    <div id="upload_selection" style="display:none;">Uploads Enabled</div>
    <div id="revision_selection" style="display:none;">Revisions Enabled</div>
    <div id="expires_selection" style="display:none;">Expires 00/00/0000</div>
    <div id="feedback_selection" style="display:none;">Peer Feedback Enabled</div>
    <div id="file_selection" style="display:none;">Files Attached</div>
    <div id="skills_selection" style="display:none;">Skill #1 - 50</div>
    <div id="thresholds_selection" style="display:none;">40 Skill #1</div>
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
        $("#quest_name_selection").html($("#quest_title").val());
        $("#quest_type").show();
    });

    $( "#submission_next" ).click(function() {
        $("#quest_type").hide();
        $("#quest_type_id").val(1);
        qf.append($("#quest_type_id"));
        $("#submission_selection").show();
    });

    $( "#activity_next" ).click(function() {
        //flag to skip minimum thresholds
        skipThresholds = true;
        $("#quest_type").hide();
        $("#quest_type_id").val(2);
        qf.append($("#quest_type_id"));
        $("#inclass_instant").show();
    });

    $( "#instant_allowed" ).click(function() {
        $("#inclass_instant").hide();
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
        $("#quest_type_id").val(3);
        qf.append($("#quest_type_id"));
        $("#video_url").show();
    });

    $( "#video_next" ).click(function() {
        $("#video_url").hide();
        qf.append($("#video_url"));
        $("#expiration").show();
    });

    $( "#link_next" ).click(function() {
        $("#quest_type").hide();
        $("#quest_type_id").val(4);        
        qf.append($("#quest_type_id"));
        $("#peer_feedback").show();
    });

    $( "#written_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_type_id").val(1);
        qf.append($("#submission_type_id"));
        qf.append($("#submissions_allowed"));
        //written only
        $("#submission_revisions").show();
    });

    $( "#upload_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_type_id").val(2);
        //uploads only
        qf.append($("#submission_type_id"));
        qf.append($("#uploads_allowed"));
        $("#upload_selection").show();
        $("#submission_revisions").show();
    });

    $( "#either_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_type_id").val(3);
        //both written and upload
        $("#upload_selection").show();
        qf.append($("#submissions_allowed"));
        qf.append($("#uploads_allowed"));
        qf.append($("#submission_type_id"));
        $("#submission_revisions").show();
    });

    $( "#revisions_allowed" ).click(function() {
        $("#submission_revisions").hide();
        $("#revisions_option").val(1);
        $("#revision_selection").show();
        qf.append($("#revisions_option"));
        $("#peer_feedback").show();
    });

    $( "#revisions_disallowed" ).click(function() {
        $("#submission_revisions").hide();
        $("#peer_feedback").show();
    });

    $( "#feedback_disallowed" ).click(function() {
        $("#peer_feedback").hide();
        $("#expiration").show();
    });

    $( "#feedback_allowed" ).click(function() {
        $("#peer_feedback").hide();
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
        $("#skills").show();
//        $("#quest_description").show();
    });

    $( "#expiration_set").click(function() {
        $("#set_expiration").hide();
        $("#expiration_date").hide();
        $("#expiration_selection").show();
        $("#expiration_selection").html($("#expiration_date").val());

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
            $("#files_allowed").show();

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




    </script>
@stop
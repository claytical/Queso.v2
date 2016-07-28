@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Cloning Quest Name</h2>
    </div>
</div>

<div class="col-lg-8">
    <div id="quest_name">
        <div class="row">
            <div class="col-lg-12">
                    {!! Form::open(['url' => 'manage/quest/create', 'id'=>'quest-create-form']) !!}

                <h3>What's the name of this quest?</h3>
                    {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'A New Adventure', 'id' => 'quest_title']) }}

                <h3>Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</h3>
                    {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}




            </div>
        </div>
    </div>

    <div id="finished" style="display:none;">
        <div class="row">
            <div class="col-lg-12">
                <h3>You're all set, ready to create this quest?</h3>

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
    <div id="upload_selection" style="display:none;">Uploads</div>
    <div id="revision_selection" style="display:none;">Revisions</div>
    <div id="expires_selection">Expires {{ Form::input('date', 'expires', null, ['class' => 'form-control', 'id' => 'quest_expiration']) }} <!-- #peer_feedback -->
</div>
    <div id="feedback_selection" style="display:none;">Expires 00/00/0000</div>
    <div id="file_selection" style="display:none;">Files Attached</div>
    <div id="skills_selection">Skill #1 - 50</div>
    <div id="thresholds_selection">40 Skill #1</div>
    {!! Form::submit('Create', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    {!! Form::close() !!}
</div>
@endsection

@section('after-scripts-end')
    <script>
    var skipThresholds = false;
    $( "#name_next" ).click(function() {
        $("#quest_name").hide();
        $("#quest_name_selection").html($("#quest_title").val());
        $("#quest_type").show();
    });

    $( "#submission_next" ).click(function() {
        $("#quest_type").hide();
        $("#submission_selection").show();
    });

    $( "#activity_next" ).click(function() {
        //flag to skip minimum thresholds
        skipThresholds = true;
        $("#quest_type").hide();
        $("#inclass_instant").show();
    });

    $( "#instant_allowed" ).click(function() {
        $("#inclass_instant").hide();
        $("#expiration").show();
    });

    $( "#instant_disallowed" ).click(function() {
        $("#inclass_instant").hide();
        $("#expiration").show();
    });

    $( "#watch_next" ).click(function() {
        $("#quest_type").hide();
        $("#video_url").show();
    });

    $( "#video_next" ).click(function() {
        $("#video_url").hide();
        $("#expiration").show();
    });

    $( "#link_next" ).click(function() {
        $("#quest_type").hide();
        $("#peer_feedback").show();
    });

    $( "#written_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_revisions").show();
    });

    $( "#upload_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_revisions").show();
    });

    $( "#either_next" ).click(function() {
        $("#submission_selection").hide();
        $("#submission_revisions").show();
    });

    $( "#revisions_allowed" ).click(function() {
        $("#submission_revisions").hide();
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
        $("#expiration").show();
    });

    $( "#expiration_allowed" ).click(function() {
        $("#expiration").hide();
        $("#set_expiration").show();
    });

    $( "#expiration_disallowed" ).click(function() {
        $("#expiration").hide();
        $("#quest_description").show();
    });

    $( "#expiration_set" ).click(function() {
        $("#set_expiration").hide();
        $("#quest_description").show();
    });

    $( "#description_set" ).click(function() {
        $("#quest_description").hide();
        $("#skills").show();
    });

    $( "#skills_set" ).click(function() {
        $("#skills").hide();
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
        $("#attach_files").show();
    });

    $( "#files_allowed" ).click(function() {
        $("#attach_files").hide();
        $("#file_attachments").show();
    });

    $( "#set_files" ).click(function() {
        $("#file_attachments").hide();
        $("#finished").show();
    });

    $( "#files_disallowed" ).click(function() {
        $("#attach_files").hide();
        $("#finished").show();
    });




    </script>
@stop
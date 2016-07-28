@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Create Quest</h2>
    </div>
</div>

<div id="quest_name">
    <div class="row">
        <div class="col-lg-12">
            <h3>What's the name of this quest?</h3>
                {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'A New Adventure']) }}
                <button type="button" class="btn btn-default" id="name_next">Next</button>

        </div>
    </div>
</div>

<div id="quest_type" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>What kind of quest is this?</h3>
                <button type="button" class="btn btn-default" id="submission_next">Submission</button> <!-- #submission_selection -->
                <button type="button" class="btn btn-default" id="activity_next">In Class Activity</button> <!-- #inclass_instant -->
                <button type="button" class="btn btn-default" id="watch_next">Watch a Video</button> <!-- #video_url -->
                <button type="button" class="btn btn-default" id="link_next">Link</button> <!-- #peer_feedback -->

        </div>
    </div>
</div>


<div id="submission_selection" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>How should students submit their work?</h3>
                <button type="button" class="btn btn-default" id="written_next">Write in a Textbox</button>
                <button type="button" class="btn btn-default" id="upload_next">Upload Files</button>
                <button type="button" class="btn btn-default" id="either_next">Either</button>

        </div>
    </div>
</div>

<div id="submission_revisions" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>Should a student be able to revise their submission?</h3>
                <button type="button" class="btn btn-default" id="revisions_allowed">Yes</button>
                <button type="button" class="btn btn-default" id="revisions_disallowed">No</button>

        </div>
    </div>
</div>

<div id="peer_feedback" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>Do you want to allow peer feedback?</h3>
                <button type="button" class="btn btn-default" id="feedback_allowed">Yes</button>
                <button type="button" class="btn btn-default" id="feedback_disallowed">No</button>

        </div>
    </div>
</div>

<div id="inclass_instant" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>Do you want to allow a student to enter unique code for instant credit?</h3>
                <button type="button" class="btn btn-default">Yes</button>
                <button type="button" class="btn btn-default">No</button>

        </div>
    </div>
</div>

<div id="video_url" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>What's the URL for the video?</h3>
                {{ Form::input('text', 'video_url', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?q=AAAAAAA']) }}

        </div>
    </div>
</div>

<div id="expiration" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>Should this quest disappear after a certain date?</h3>
                <button type="button" class="btn btn-default" id="expiration_allowed">Yes</button>
                <button type="button" class="btn btn-default" id="expiration_disallowed">No</button>
        </div>
    </div>
</div>

<div id="set_expiration" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>When should the quest disappear?</h3>
                {{ Form::input('date', 'expiration', null, ['class' => 'form-control']) }}
                <button type="button" class="btn btn-default" id="expiration_set">Next</button>

        </div>
    </div>
</div>

<div id="quest_description" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</h3>
            {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}
            <button type="button" class="btn btn-default" id="description_set">Next</button>

        </div>
    </div>

</div>

<div id="skills" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>What are the maximum point values for each skill?</h3>
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="skill1" class="col-sm-2 control-label">Skill #1</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="skill1">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="skill2" class="col-sm-2 control-label">Skill #2</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="skill2">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="skill3" class="col-sm-2 control-label">Skill #3</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="skill3">
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="button" class="btn btn-default" id="skills_set">Next</button>

                  </div>
                </form>
        </div>
    </div>
</div>

<div id="thresholds" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>Should a student be required to have a minimum skill level in order to see this quest?</h3>
                <button type="button" class="btn btn-default" id="thresholds_allowed">Yes</button>
                <button type="button" class="btn btn-default" id="thresholds_disallowed">No</button>
        </div>
    </div>
</div>

<div id="set_thresholds" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>What are the minimum skill level values in order to see this quest?</h3>
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="skill1" class="col-sm-2 control-label">Skill #1</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="skill1">
                    </div>
                  </div>

                  <div class="form-group">
                    <label for="skill2" class="col-sm-2 control-label">Skill #2</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="skill2">
                    </div>
                  </div>


                  <div class="form-group">
                    <label for="skill3" class="col-sm-2 control-label">Skill #3</label>
                    <div class="col-sm-10">
                      <input type="number" class="form-control" id="skill3">
                    </div>
                  </div>

                  <div class="form-group">
                    <button type="button" class="btn btn-default" id="set_thresholds">Next</button>

                  </div>

                </form>
        </div>
    </div>
</div>

<div id="attach_files" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>Would you like to attach any supporting files to this quest?</h3>
                <button type="button" class="btn btn-default" id="files_allowed">Yes</button>
                <button type="button" class="btn btn-default" id="files_disallowed">No</button>
        </div>
    </div>
</div>

<div id="file_attachments" class="hidden">
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

<div id="finished" class="hidden">
    <div class="row">
        <div class="col-lg-12">
            <h3>You're all set, ready to create this quest?</h3>
                <button type="button" class="btn btn-default btn-block">Create Quest</button>
        </div>
    </div>
</div>

@endsection

@section('after-scripts-end')
    <script>

    $( "#name_next" ).click(function() {
        $("#quest_name").hide();
        $("#quest_type").show();
    });

    $( "#submission_next" ).click(function() {
        $("#quest_type").hide();
        $("#submission_selection").show();
    });

    $( "#activity_next" ).click(function() {
        $("#quest_type").hide();
        $("#inclass_instant").show();
    });

    $( "#watch_next" ).click(function() {
        $("#quest_type").hide();
        $("#video_url").show();
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
        $("#thresholds").show();
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
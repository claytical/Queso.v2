@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Create Quest</h2>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>What's the name of this quest?</h3>
            {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'A New Adventure')]) }}
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>What kind of quest is this?</h3>
            <button type="button" class="btn btn-default">Submission</button>
            <button type="button" class="btn btn-default">In Class Activity</button>
            <button type="button" class="btn btn-default">Watch a Video</button>
            <button type="button" class="btn btn-default">Link</button>

    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <h3>How should students submit their work?</h3>
            <button type="button" class="btn btn-default">Write in a Textbox</button>
            <button type="button" class="btn btn-default">Upload Files</button>
            <button type="button" class="btn btn-default">Either</button>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>Should a student be able to revise their submission?</h3>
            <button type="button" class="btn btn-default">Yes</button>
            <button type="button" class="btn btn-default">No</button>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>Do you want to allow a student to enter unique code for instant credit?</h3>
            <button type="button" class="btn btn-default">Yes</button>
            <button type="button" class="btn btn-default">No</button>

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>What's the URL for the video?</h3>
            {{ Form::input('text', 'video_url', null, ['class' => 'form-control', 'placeholder' => 'http://youtube.com/watch/?q=AAAAAAA')]) }}

    </div>
</div>


<div class="row">
    <div class="col-lg-12">
        <h3>Should this quest disappear after a certain date?</h3>
            <button type="button" class="btn btn-default">Yes</button>
            <button type="button" class="btn btn-default">No</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>When should the quest disappear?</h3>
            {{ Form::input('date', 'expiration', null, ['class' => 'form-control']) }}

    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</h3>
        {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}

    </div>
</div>

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

            </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>Should a student be required to have a minimum skill level in order to see this quest?</h3>
            <button type="button" class="btn btn-default">Yes</button>
            <button type="button" class="btn btn-default">No</button>
    </div>
</div>

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

            </form>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>Would you like to attach any supporting files to this quest?</h3>
            <button type="button" class="btn btn-default">Yes</button>
            <button type="button" class="btn btn-default">No</button>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <h3>You're all set, ready to create this quest?</h3>
            <button type="button" class="btn btn-default btn-block">Create Quest</button>
    </div>
</div>
@endsection

@section('after-scripts-end')
    <script>
  /*      var quest_list_options = {
        valueNames: [ 'submission', 'date', 'student' ]
    };
*/
//    var hackerList = new List('submission-list', submission_list_options);
    </script>
@stop
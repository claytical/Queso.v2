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
                    {!! Form::open(['url' => 'manage/quest/clone', 'id' => 'quest-clone-form']) !!}

                <h3>What's the name of this quest?</h3>
                    {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'A New Adventure', 'id' => 'quest_title']) }}

                <h3>Describe this quest for the student. It could be a prompt for writing, guidelines for uploads, or whatever you want them to do in order to get points.</h3>
                    {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}




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
    {!! Form::submit('Clone', ['class' => 'btn btn-primary btn-lg btn-block']) !!}
    {!! Form::close() !!}
</div>
@endsection

@section('after-scripts-end')
    <script>



    </script>
@stop
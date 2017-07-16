@extends('frontend.layouts.master')

@section('content')
<section class="hero is-dark is-bold">
  <div class="hero-body">
    <div class="container">
        <a href="mailto:{!! Form::courseEmailList($course->id) !!}" class="button is-large is-pulled-right is-primary">Email Entire Class</a>
        <h1 class="title">{!! $course->name !!}</h1>
    </div>
  </div>
</section>

<section class="section">

    <div class="columns">
        <div class="column">
            <aside class="menu">
              <p class="menu-label">
                General
              </p>
              <ul class="menu-list">
                <li><a>Dashboard</a></li>
                <li><a>Customers</a></li>
              </ul>
              <p class="menu-label">
                Administration
              </p>
              <ul class="menu-list">
                <li><a>Team Settings</a></li>
                <li>
                  <a class="is-active">Manage Your Team</a>
                  <ul>
                    <li><a>Members</a></li>
                    <li><a>Plugins</a></li>
                    <li><a>Add a member</a></li>
                  </ul>
                </li>
                <li><a>Invitations</a></li>
                <li><a>Cloud Storage Environment Settings</a></li>
                <li><a>Authentication</a></li>
              </ul>
              <p class="menu-label">
                Transactions
              </p>
              <ul class="menu-list">
                <li><a>Payments</a></li>
                <li><a>Transfers</a></li>
                <li><a>Balance</a></li>
              </ul>
            </aside>
        </div>
        <div class="column">
        {!! Form::open(['url' => 'manage/course/update', 'id'=>'resource-form', 'class' => '']) !!}
        <div class="tile">
            <div class="tile is-6 is-parent">
                <div class="tile is-child">
                    <h2 class="subtitle">Course</h2>
                    <div class="field">
                        <p class="control">
                            {{ Form::input('text', 'title', $course->name, ['class' => 'input', 'placeholder' => 'Course Name', 'id' => 'course_name']) }}                    
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            {{ Form::input('text', 'meeting_location', $course->meeting_location, ['class' => 'input', 'placeholder' =>  'Classroom', 'id' => 'classroom']) }}
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            {{ Form::input('text', 'meeting_time', $course->meeting, ['class' => 'input', 'placeholder' => 'Wednesdays @ 3pm', 'id' => 'meeting_time']) }}                    
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            {{ Form::input('text', 'reg_code', $course->code, ['class' => 'input', 'placeholder' => 'Registration Code', 'id' => 'reg_code']) }}        
                        </p>
                    </div>

                </div>
            </div>

            <div class="tile is-6 is-parent">
                <div class="tile is-child notification">
                    <h2 class="subtitle">Instructor</h2>
                    <div class="field">
                        <p class="control">
                            {{ Form::input('text', 'instructor_display_name', $course->instructor_display_name, ['class' => 'input', 'placeholder' =>  'Mr. Fantastic', 'id' => 'instructor_name']) }}
                        </p>
                    </div>                      
                    <div class="field">
                        <p class="control">
                           {{ Form::input('text', 'instructor_contact', $course->instructor_contact, ['class' => 'input', 'placeholder' =>  'Contact Email Address', 'id' => 'instructor_contact']) }}
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                           {{ Form::input('text', 'instructor_office_location', $course->instructor_office_location, ['class' => 'input', 'placeholder' =>  'Office Location', 'id' => 'office_location']) }}
                        </p>
                    </div>

                    <div class="field">
                        <p class="control">
                            {{ Form::input('text', 'office_hours', $course->office_hours, ['class' => 'input', 'placeholder' =>  'Office Hours', 'id' => 'office_hours']) }}
                        </p>
                    </div>
                    <div class="field">
                        <p class="control">
                            <select class="input" name="timezone">
                            @foreach($zones as $zone)
                                @if($zone == $course->timezone)
                                    <option value="{!! $zone !!}" selected>{!! $zone !!}</option>
                                @else
                                    <option value="{!! $zone !!}">{!! $zone !!}</option>
                                @endif
                            @endforeach
                            </select>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::submit('Update Course', ['class' => 'button is-primary is-pulled-right']) !!}
        {!! Form::close() !!}

        <div class="tile">
            <div class="tile is-6 is-parent">
                <div class="tile is-child">
                    @foreach($skills as $skill)
                            {!! $skill->name !!}
                            {!! Form::open(['url' => 'manage/course/remove/skill', 'class' => 'remove-skill']) !!}
                            {!! Form::hidden('skill', $skill->id) !!}
                            {!! Form::submit('Remove', ['class' => 'button']) !!}                  
                            {!! Form::close() !!}

                            {!! Form::open(['url' => 'manage/course/edit/skill', 'class' => 'edit-skill']) !!}
                            {!! Form::hidden('skill_id', $skill->id) !!}
                            {{ Form::input('text', 'skill', $skill->name, ['class' => 'input edit-skill', 'placeholder' => $skill->name, 'id' => 'skill_name']) }}
                            {!! Form::submit('Save', ['class' => 'button']) !!}                  
                            {!! Form::close() !!}
                    @endforeach

                    {!! Form::open(['url' => 'manage/course/add/skill', 'class' => '', 'id' => 'add-skill']) !!}
                    {{ Form::input('text', 'skill', null, ['class' => 'input', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
                    {!! Form::submit('Add Skill', ['class' => 'button']) !!}
                    {!! Form::close() !!}


                </div>
            </div>
            <div class="tile is-6 is-parent">
                <div class="tile is-child">
                    @foreach($levels as $level)
                        {!! $level->name !!} - {!! $level->amount !!}
                        {!! Form::open(['url' => 'manage/course/remove/level', 'class' => 'remove-level']) !!}
                        {!! Form::hidden('level', $level->id) !!}
                        {!! Form::submit('Remove', ['class' => 'button']) !!}
                        {!! Form::close() !!}

                        {!! Form::open(['url' => 'manage/course/edit/level', 'class' => 'edit-level']) !!}
                        {!! Form::hidden('level_id', $level->id) !!}
                        {{ Form::input('text', 'level', $level->name, ['class' => 'input', 'placeholder' => 'Name', 'id' => 'level_name']) }}
                        {{ Form::input('number', 'amount', $level->amount, ['class' => 'input', 'placeholder' => 'Amount', 'id' => 'level_name']) }}
                        {!! Form::submit('Save', ['class' => 'button']) !!}                  
                        {!! Form::close() !!}
                    @endforeach

                {!! Form::open(['url' => 'manage/course/add/level', 'class' => 'form-inline', 'id' => 'add-level']) !!}

                {{ Form::input('text', 'level', null, ['class' => 'input', 'placeholder' => 'Level Name', 'id' => 'level_name']) }}

                {{ Form::input('number', 'amount', null, ['class' => 'input', 'placeholder' => 'Amount', 'id' => 'level_amount']) }}

                {!! Form::submit('Add Level', ['class' => 'button']) !!}

                {!! Form::close() !!}                
                </div>
            </div>

            <div class="tile is-6 is-parent">
                <div class="tile is-child">
                    @foreach($teams as $team)
                        {!! $team->name !!}
                        {!! Form::open(['url' => 'manage/course/remove/team', 'class' => 'remove-team']) !!}
                        {!! Form::hidden('team_id', $team->id) !!}
                        {!! Form::submit('Remove', ['class' => 'button']) !!}                           
                        {!! Form::close() !!}
                        {!! link_to('manage/course/team/' . $team->id, 'Manage', ['class' => 'button']) !!}
                        <a class="button" href="mailto:{!! Form::teamEmailList($team->id) !!}">Mail</a>
                                         
                        {!! Form::open(['url' => 'manage/course/edit/team', 'class' => 'edit-team']) !!}
                        {!! Form::hidden('team_id', $team->id) !!}
                        {!! Form::input('text', 'team', $team->name, ['class' => 'input edit-team', 'placeholder' => $team->name, 'id' => 'team_name']) !!}
                        {!! Form::submit('Save', ['class' => 'button']) !!}                  
                        {!! Form::close() !!}
                    @endforeach

                    {!! Form::open(['url' => 'manage/course/add/team', 'class' => '', 'id' => 'add-team']) !!}
                    {!! Form::input('text', 'team', null, ['class' => 'input', 'placeholder' => 'Team Name', 'id' => 'team_title']) !!}
                    {!! Form::submit('Add This Team', ['class' => 'button']) !!}
                    {!! Form::close() !!}

                    {!! Form::textarea('email_list', null, ['class' => 'input']) !!}

                    {!! Form::submit('Share Course', ['class' => 'button']) !!}

                    {!! Form::close() !!}

                    {!! Form::open(['url' => 'manage/peers', 'class' => '', 'id' => 'peer-form']) !!}
                
                    {{ Form::input('number', 'peer_group_size', null, ['class' => 'input', 'placeholder' => 'Peer Group Size', 'id' => 'peer_group_size']) }}

                    {!! Form::submit('Assign Peer Groups', ['class' => 'button']) !!}

                    {!! Form::close() !!} 
                </div>
                </div>
            </div>
        </div>
    </div>
</section>
                        



@endsection

@section('after-scripts-end')
    <script>
        var skillOptions = { 
            target:        '#output1',   // target element(s) to be updated with server response 
            beforeSubmit:  hideAndUpdateSkill,  // pre-submit callback 
            dataType: 'json'
            }; 

         var teamOptions = { 
            target:        '#output1',   // target element(s) to be updated with server response 
            beforeSubmit:  hideAndUpdateTeam,  // pre-submit callback 
            dataType: 'json'
            };            

        var removeOptions = { 
            target:        '#output1',   // target element(s) to be updated with server response 
            beforeSubmit:  removeParent,  // pre-submit callback 
//            success:       removeParent,  // post-submit callback 
            dataType: 'json'
            }; 

        var levelOptions = { 
            target:        '#output1',   // target element(s) to be updated with server response 
            beforeSubmit:  hideAndUpdateLevel,  // pre-submit callback 
            dataType: 'json'
            }; 


     function hideAndUpdateLevel(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
        var lid = jqForm[0][2].defaultValue;
        console.log(jqForm[0]);
        $("#level" + lid).modal('hide');
        $("td [data-target='#level"+lid+"']").html(jqForm[0][3].value);
        return true; 
    } 


     function hideAndUpdateSkill(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
        var sid = jqForm[0][2].defaultValue;
        $("#skill" + sid).modal('hide');
        $("td [data-target='#skill"+sid+"']").html(jqForm[0][3].value);
        return true; 
    } 

     function hideAndUpdateTeam(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
        var tid = jqForm[0][2].defaultValue;
        $("#team" + tid).modal('hide');
        $("td [data-target='#team"+tid+"']").html(jqForm[0][3].value);
        return true; 
    } 


    function removeParent(formData, jqForm, options) { 
        // formData is an array; here we use $.param to convert it to a string to display it 
        // but the form plugin does this for you automatically when it submits the data 
        jqForm[0].parentNode.parentNode.remove();        
        return true; 
    } 


    $('.edit-skill').ajaxForm(skillOptions);
    $('.remove-skill').ajaxForm(removeOptions);
    $('.edit-level').ajaxForm(levelOptions);
    $('.remove-level').ajaxForm(removeOptions);
    $('.edit-team').ajaxForm(teamOptions);
    $('.remove-team').ajaxForm(removeOptions);

    $( document ).ready(function() {
        if(window.location.hash) {
//            $('a[href='+window.location.hash+']').parent().addClass('active');
//           $(window.location.hash).show();
            $('#courseTabs a[href="'+window.location.hash+'"]').tab('show');

        }
        else {
            $('#courseTabs a[href="#general"]').tab('show');

//            $('a[href=#general]').parent().addClass('active');
//            $('#general').show();            
        }
    });
    </script>
@stop
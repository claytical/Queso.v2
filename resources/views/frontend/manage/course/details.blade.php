@extends('frontend.layouts.master')

@section('content')

    <div class="col-lg-12">
        <h2>Course Settings</h2>
    </div>


    <div class="col-lg-12">
        <div>

          <!-- Nav tabs -->
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active"><a href="#general" aria-controls="general" role="tab" data-toggle="tab">General</a></li>
            <li role="presentation"><a href="#skills" aria-controls="skills" role="tab" data-toggle="tab">Skills</a></li>
            <li role="presentation"><a href="#levels" aria-controls="levels" role="tab" data-toggle="tab">Levels</a></li>
            <li role="presentation"><a href="#teams" aria-controls="teams" role="tab" data-toggle="tab">Teams</a></li>
            <li role="presentation"><a href="#feedback" aria-controls="feedback" role="tab" data-toggle="tab">Peer Feedback</a></li>

            <li role="presentation"><a href="#share" aria-controls="share" role="tab" data-toggle="tab">Share</a></li>

          </ul>

          <!-- Tab panes -->
          <div class="tab-content">
            <div role="tabpanel" class="tab-pane active" id="general">
                {!! Form::open(['url' => 'manage/course/update', 'class' => '', 'id' => 'update-course']) !!}

                {{ Form::input('text', 'name', $course->name, ['class' => 'form-control', 'placeholder' => 'Course Name', 'id' => 'course_name']) }}

                {{ Form::input('text', 'reg_code', $course->code, ['class' => 'form-control', 'placeholder' => 'Registration Code', 'id' => 'reg_code']) }}

                {{ Form::input('text', 'meeting_time', $course->meeting, ['class' => 'form-control', 'placeholder' => 'Wednesdays @ 3pm', 'id' => 'meeting_time']) }}

                {!! Form::submit('Update Course', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

            </div>
            <div role="tabpanel" class="tab-pane" id="skills">
            
            {!! Form::open(['url' => 'course/add/skill', 'class' => 'form-inline', 'id' => 'add-skill']) !!}
            <div class="form-group">
                <label for="skill">Skill Name</label>
                {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
            </div>
            <div class="form-group">
            </div>
            {!! Form::submit('Add Skill', ['class' => 'btn btn-primary btn-lg']) !!}
            {!! Form::close() !!}



                <h4>Current Skills</h4>
                <ul class="list-unstyled list">
                    @foreach($skills as $skill)
                    <li>
                        <div class="col-lg-9">
                            <div class="name">{!! $skill->name !!}
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="pull-right">
                                                {!! Form::open(['url' => 'course/remove/skill', 'class' => 'remove-skill']) !!}
                                                {!! Form::hidden('skill', $skill->id) !!}
                                                {!! Form::submit('Remove', ['class' => 'btn btn-danger btn-xs pull-right']) !!}                           
                                                {!! Form::close() !!}
                            </div>
                        </div>
                    </li>

                </ul>

            </div>
            <div role="tabpanel" class="tab-pane" id="levels">
                {!! Form::open(['url' => 'course/add/level', 'class' => 'form-inline', 'id' => 'add-level']) !!}
                  <div class="form-group">
                    <label for="skill">Level Name</label>
                        {{ Form::input('text', 'level', null, ['class' => 'form-control', 'placeholder' => 'Level Name', 'id' => 'level_name']) }}
                  </div>
                  <div class="form-group">
                    <label for="skill">Level Name</label>
                        {{ Form::input('number', 'amount', null, ['class' => 'form-control', 'placeholder' => 'Amount', 'id' => 'level_amount']) }}
                  </div>

                    {!! Form::submit('Add Level', ['class' => 'btn btn-primary btn-lg']) !!}
                    {!! Form::close() !!}


                <h4>Current Levels</h4>
                <ul class="list-unstyled list">
                    @foreach($levels as $level)
                    <li>
                    <div class="col-lg-4">
                        {!! $level->name !!}
                    </div>
                    <div class="col-lg-4">
                        {!! $level->amount !!}
                    </div>
                    <div class="col-lg-4">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default">Edit</button>
                        </div>
                    </div>
                    </li>
                </ul>


            </div>
            <div role="tabpanel" class="tab-pane" id="teams">
                {!! Form::open(['url' => 'manage/teams/add', 'class' => '', 'id' => 'add-skills']) !!}

                {{ Form::input('text', 'team', null, ['class' => 'form-control', 'placeholder' => 'Points', 'id' => 'skill_title']) }}

                {!! Form::submit('Add This Team', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

                <h4>Current Teams</h4>
                <ul class="list-unstyled list">
                    <li>
                        <div class="col-lg-9">
                            <div class="name">Blue Team
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="pull-right">
                                  <button type="button" class="btn btn-default">Edit</button>
                            </div>
                        </div>
                    <li>
                        <div class="col-lg-9">
                            <div class="name">Red Team
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="pull-right">
                                  <button type="button" class="btn btn-default">Edit</button>
                            </div>
                        </div>

                    </li>
                    <li>
                        <div class="col-lg-9">
                            <div class="name">Yellow Team
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="pull-right">
                                  <button type="button" class="btn btn-default">Edit</button>
                            </div>
                        </div>

                    </li>

                </ul>

            </div>
            <div role="tabpanel" class="tab-pane" id="share">
                <p>Students can sign up for this course by using this link:[URL]</p>
                <p>If you prefer, you can enter their email addresses and send the link directly to their inbox.</p>
                 {!! Form::textarea('email_list', null, ['class' => 'field']) !!}

                {!! Form::submit('Share Course', ['class' => 'btn btn-primary btn-lg']) !!}

                {!! Form::close() !!}
            </div>

            <div role="tabpanel" class="tab-pane" id="feedback">
                {!! Form::open(['url' => 'manage/peers', 'class' => '', 'id' => 'peer-form']) !!}
                
                {{ Form::input('number', 'peer_group_size', null, ['class' => 'form-control', 'placeholder' => 'Peer Group Size', 'id' => 'peer_group_size']) }}

                {!! Form::submit('Assign Peer Groups', ['class' => 'btn btn-primary btn-lg']) !!}

                {!! Form::close() !!}

            </div>

          </div>

        </div>




    </div>
@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
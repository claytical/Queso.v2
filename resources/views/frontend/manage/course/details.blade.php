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

                {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' => 'Course Name', 'id' => 'course_name']) }}

                {{ Form::input('text', 'reg_code', null, ['class' => 'form-control', 'placeholder' => 'Registration Code', 'id' => 'reg_code']) }}

                {{ Form::input('text', 'meeting_time', null, ['class' => 'form-control', 'placeholder' => 'Wednesdays @ 3pm', 'id' => 'meeting_time']) }}

                {{ Form::input('text', 'meeting_location', null, ['class' => 'form-control', 'placeholder' => 'Wolfson Building, Room 1018', 'id' => 'meeting_location']) }}

                {!! Form::submit('Update Course', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

            </div>
            <div role="tabpanel" class="tab-pane" id="skills">
                {!! Form::open(['url' => 'manage/skills/add', 'class' => '', 'id' => 'add-skills']) !!}

                {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Points', 'id' => 'skill_title']) }}
                
                {!! Form::submit('Add This Skill', ['class' => 'btn btn-primary btn-lg']) !!}
                
                {!! Form::close() !!}

                <h4>Current Skills</h4>
                <ul class="list-unstyled list">
                    <li><div class="name">Skill #1
                        </div>
                        <div class="pull-right">
                              <button type="button" class="btn btn-default">Edit</button>
                        </div>
                    </li>

                    <li>
                        <div class="name">Skill #2
                        </div>
                        <div class="pull-right">
                              <button type="button" class="btn btn-default">Edit</button>
                            
                        </div>
                    </li>
                    <li><div class="name">Skill #3
                        </div>
                        <div class="pull-right">
                              <button type="button" class="btn btn-default">Edit</button>
                        </div>
                    </li>

                </ul>

            </div>
            <div role="tabpanel" class="tab-pane" id="levels">
                {!! Form::open(['url' => 'manage/levels/add', 'class' => '', 'id' => 'add-levels']) !!}
                
                {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Points', 'id' => 'skill_title']) }}

                {{ Form::input('number', 'amount', null, ['class' => 'form-control', 'placeholder' => '0', 'id' => 'skill_amount']) }}

                {!! Form::submit('Add This Level', ['class' => 'btn btn-primary btn-lg']) !!}

                {!! Form::close() !!}

                <h4>Current Levels</h4>
                <ul class="list-unstyled list">
                    <li>
                    <div class="col-lg-4">
                        Newbie
                    </div>
                    <div class="col-lg-4">
                        0
                    </div>
                    <div class="col-lg-4">
                        <div class="pull-right">
                            <button type="button" class="btn btn-default">Edit</button>
                        </div>
                    </div>
                    </li>

                    <li>
                        <div class="col-lg-4">
                            Other Rank
                        </div>
                        <div class="col-lg-4">
                            40
                        </div>
                        <div class="col-lg-4">
                            <div class="pull-right">
                                <button type="button" class="btn btn-default">Edit</button>
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="col-lg-4">
                            Higher Rank
                        </div>
                        <div class="col-lg-4">
                            80
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
                {!! Form::open(['url' => 'manage/skills/add', 'class' => '', 'id' => 'add-skills']) !!}

                {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Points', 'id' => 'skill_title']) }}

                {!! Form::submit('Add This Skill', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

                <h4>Current Skills</h4>
                <ul class="list-unstyled list">
                    <li>Blue Team
                        <div class="pull-right">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" class="btn btn-default">Edit</button>
                            </div>
                        </div>
                    </li>

                    <li>Red Team
                        <div class="pull-right">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" class="btn btn-default">Edit</button>
                            </div>
                        </div>
                    </li>
                    <li>Yellow Team
                        <div class="pull-right">
                            <div class="btn-group" role="group" aria-label="...">
                              <button type="button" class="btn btn-default">Edit</button>
                            </div>
                        </div>
                    </li>

                </ul>

            </div>
            <div role="tabpanel" class="tab-pane" id="share">
                <p>Students can sign up for this course by using this link:[URL]</p>
                <p>If you prefer, you can enter their email addresses and send the link directly to their inbox.</p>

                {{ Form::input('textarea', 'email_list', null, ['class' => 'form-control', 'placeholder' => 'Email Addresses', 'id' => 'email_list']) }}

                {!! Form::submit('Share Course', ['class' => 'btn btn-primary btn-lg']) !!}

                {!! Form::close() !!}
            </div>

            <div role="tabpanel" class="tab-pane" id="feedback">
                {!! Form::open(['url' => 'manage/levels/add', 'class' => '', 'id' => 'add-levels']) !!}
                
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
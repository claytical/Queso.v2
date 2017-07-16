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
        <div class="column is-2">
            <aside class="menu">
              <ul class="menu-list">
                <li><a>Quests</a></li>
                <li><a>Resources</a></li>
                <li><a>Announcements</a></li>
              </ul>
              <p class="menu-label">
                Course Management
              </p>
              <ul class="menu-list">
                <li><a class="is-active">Information</a></li>
                <li><a>Students</a></li>
                <li><a>Teams</a></li>
                <li><a>Skills</a></li>
                <li><a>Levels</a></li>
              </ul>
            </aside>
        </div>
        <div class="column">
        {!! Form::open(['url' => 'manage/course/update', 'id'=>'resource-form', 'class' => '']) !!}
        {{ Form::hidden('course_id', $course->id, ['id' => 'course_id']) }}

        <div class="tile">
            <div class="tile is-6 is-parent">
                <div class="tile is-child">
                    <h2 class="subtitle">Course</h2>
                    <div class="field">
                        <p class="control">
                            {{ Form::input('text', 'name', $course->name, ['class' => 'input', 'placeholder' => 'Course Name', 'id' => 'course_name']) }}                    
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
                <div class="tile is-child">
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

        </div>
    </div>
</section>
                        



@endsection

@section('after-scripts-end')
@stop
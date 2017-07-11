@extends('frontend.layouts.unassigned')

@section('content')
<section class="section">
    <div class="container is-fluid">
      <h1 class="title">
        Let's Get Started
      </h1>
    </div>
        {!! Form::open(['url' => 'course/create', 'class' => '', 'id' => 'create-course']) !!}

    <div class="tile">
      <div class="tile is-6 is-parent">
        <div class="tile is-child box notification is-light">
            <p class="title">Course Information</p>
            <div class="field">
              <label class="label">Course Name</label>
              <p class="control">
                {{ Form::input('text', 'name', null, ['class' => 'input', 'placeholder' =>  'My New Course Name', 'id' => 'course_name']) }}
              </p>
            </div>
            <div class="field">
                <label class="label">Physical Location</label>
                <p class="control">
                    {{ Form::input('text', 'meeting_location', null, ['class' => 'input', 'placeholder' =>  'Fantastic HQ, Room 100', 'id' => 'classroom']) }}         
                </p>
            </div>

            <div class="field">
                <label class="label">Meeting Time</label>
                <p class="control">
                    {{ Form::input('text', 'meeting_time', null, ['class' => 'input', 'placeholder' => 'Tuesdays at Midnight', 'id' => 'meeting_time']) }}

                </p>
            </div>

            <div class="field">
                <label class="label">Registration Code</label>
                <p class="control">
                    {{ Form::input('text', 'reg_code', null, ['class' => 'input', 'placeholder' => 'Unique Code for Students to Gain Access', 'id' => 'reg_code']) }}
                </p>
            </div>

        </div>
      </div>
      <div class="tile is-6 is-parent">
        <div class="tile is-child box notification is-light">
            <p class="title">Instructor Information</p>
            <div class="field">
                <label class="label">Instructor Display Name</label>
                <p class="control">
                    {{ Form::input('text', 'instructor_display_name', null, ['class' => 'input', 'placeholder' =>  'Prof. Instructor', 'id' => 'instructor_name']) }}
                </p>
            </div>

            <div class="field">
                <label class="label">Instructor Contact Email</label>
                <p class="control">
                    {{ Form::input('email', 'instructor_contact', null, ['class' => 'input', 'placeholder' =>  'professor.instructor@institution.edu', 'id' => 'instructor_contact']) }}
                </p>
            </div>

            <div class="field">
                <label class="label">Instructor Office Location</label>
                <p class="control">
                    {{ Form::input('text', 'instructor_office_location', null, ['class' => 'input', 'placeholder' =>  'Fantastic HQ, Penthouse Suite', 'id' => 'office_location']) }}

                </p>
            </div>

            <div class="field">
                <label class="label">Instructor Office Hours</label>
                <p class="control">
                    {{ Form::input('text', 'office_hours', null, ['class' => 'input', 'placeholder' =>  'Mondays at 8am', 'id' => 'office_hours']) }}
                </p>
            </div>

        </div>
      </div>

    </div>
    <div class="container is-fluid">

        <p class="control">
            {!! Form::submit('Create Course', ['class' => 'button is-large is-primary is-fullwidth']) !!}
        </p>
    </div>
        {!! Form::close() !!}
</section>

@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
@extends('frontend.layouts.unassigned')

@section('content')
<section class="hero is-dark is-bold is-large">
  <div class="hero-body">
    <div class="container is-fluid">
      <h1 class="title">
        Create a Course
      </h1>
      <h2 class="subtitle">Let's Get Started</h2>
        {!! Form::open(['url' => 'course/create', 'class' => '', 'id' => 'create-course']) !!}

        <div class="field">
          <label class="label">Course Name</label>
          <p class="control">
            {{ Form::input('text', 'name', null, ['class' => 'input', 'placeholder' =>  'My New Course Name', 'id' => 'course_name']) }}
          </p>
        </div>

        <div class="field">
            <label class="label">Instructor Display Name</label>
            <p class="control">
                {{ Form::input('text', 'instructor_display_name', null, ['class' => 'form-control', 'placeholder' =>  'Prof. Instructor', 'id' => 'instructor_name']) }}
            </p>
        </div>

        <div class="field">
            <label class="label">Instructor Contact Email</label>
            <p class="control">
                {{ Form::input('email', 'instructor_contact', null, ['class' => 'input', 'placeholder' =>  'professor.awesome@institution.edu', 'id' => 'instructor_contact']) }}
            </p>
        </div>

        <div class="field">
            <label class="label">Instructor Office Location</label>
            <p class="control">
                {{ Form::input('text', 'instructor_office_location', null, ['class' => 'form-control', 'placeholder' =>  'Fantastic HQ, Penthouse Suite', 'id' => 'office_location']) }}

            </p>
        </div>

        <div class="field">
            <label class="label">Instructor Office Hour</label>
            <p class="control">
                {{ Form::input('text', 'office_hours', null, ['class' => 'form-control', 'placeholder' =>  'Mondays at 8am', 'id' => 'office_hours']) }}
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
                {{ Form::input('text', 'meeting_time', null, ['class' => 'form-control', 'placeholder' => 'Tuesdays at Midnight', 'id' => 'meeting_time']) }}

            </p>
        </div>

        <div class="field">
            <label class="label">Registration Code</label>
            <p class="control">
                {{ Form::input('text', 'reg_code', null, ['class' => 'input', 'placeholder' => 'Unique Code for Students to Gain Access', 'id' => 'reg_code']) }}
            </p>
        </div>
            <p class="control">
                {!! Form::submit('Create Course', ['class' => 'button is-large is-primary']) !!}
            </p>
        {!! Form::close() !!}
        </div>
    </div>
</section>

@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
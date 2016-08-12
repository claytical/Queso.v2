@extends('frontend.layouts.unassigned')

@section('content')

    <div class="col-lg-12">
        <h2>Create a Course</h2>
                {!! Form::open(['url' => 'course/create', 'class' => '', 'id' => 'create-course']) !!}

                {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' =>  'Course Name', 'id' => 'course_name']) }}
            
                {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}

                {{ Form::input('text', 'reg_code', null, ['class' => 'form-control', 'placeholder' => 'Registration Code', 'id' => 'reg_code']) }}

                {{ Form::input('text', 'instructor_display_name', 'Mr. Fantastic', ['class' => 'form-control', 'placeholder' =>  'Instructor Display Name', 'id' => 'course_name']) }}

                {{ Form::input('text', 'instructor_contact', null, ['class' => 'form-control', 'placeholder' =>  'Contact Email Address', 'id' => 'instructor_contact']) }}

                {{ Form::input('text', 'meeting_location', null, ['class' => 'form-control', 'placeholder' =>  'Classroom', 'id' => 'classroom']) }}

                {{ Form::input('text', 'meeting_time', null, ['class' => 'form-control', 'placeholder' => 'Meeting Time', 'id' => 'meeting_time']) }}

                {{ Form::input('text', 'instructor_office_location', null, ['class' => 'form-control', 'placeholder' =>  'Office Location', 'id' => 'office_location']) }}

                {{ Form::input('text', 'office_hours', null, ['class' => 'form-control', 'placeholder' =>  'Office Hours', 'id' => 'office_hours']) }}


                {!! Form::submit('Create Course', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

    </div>
@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
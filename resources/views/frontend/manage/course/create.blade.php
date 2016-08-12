@extends('frontend.layouts.unassigned')

@section('content')

    <div class="col-lg-12">
        <h2>Create a Course</h2>
                {!! Form::open(['url' => 'course/create', 'class' => '', 'id' => 'create-course']) !!}

                {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' =>  'Course Name', 'id' => 'course_name']) }}
            
                {!! Form::textarea('description', null, ['class' => 'field', 'files' => true]) !!}

                {{ Form::input('text', 'reg_code', null, ['class' => 'form-control', 'placeholder' => 'Registration Code', 'id' => 'reg_code']) }}

                {{ Form::input('text', 'instructor_display_name', null, ['class' => 'form-control', 'placeholder' =>  'Mr. Fantastic', 'id' => 'course_name']) }}

                {{ Form::input('text', 'instructor_contact', null, ['class' => 'form-control', 'placeholder' =>  'mr.fantastic@example.com', 'id' => 'instructor_contact']) }}

                {{ Form::input('text', 'meeting_location', null, ['class' => 'form-control', 'placeholder' =>  'Fantastic HQ, Room 100', 'id' => 'classroom']) }}

                {{ Form::input('text', 'meeting_time', null, ['class' => 'form-control', 'placeholder' => 'Tuesdays at Midnight', 'id' => 'meeting_time']) }}

                {{ Form::input('text', 'instructor_office_location', null, ['class' => 'form-control', 'placeholder' =>  'Fantastic HQ, Penthouse Suite', 'id' => 'office_location']) }}

                {{ Form::input('text', 'office_hours', null, ['class' => 'form-control', 'placeholder' =>  'Mondays at 8am', 'id' => 'office_hours']) }}


                {!! Form::submit('Create Course', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

    </div>
@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
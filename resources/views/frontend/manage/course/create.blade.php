@extends('frontend.layouts.unassigned')

@section('content')

    <div class="col-lg-12">
        <h2>Create a Course</h2>
    </div>

            {!! Form::open(['url' => 'course/create', 'class' => '', 'id' => 'create-course']) !!}

    <div class="col-lg-12">
        <div class="col-lg-6">

                <div class="form-group">
                    <label for="name">Course Name</label>

                    {{ Form::input('text', 'name', null, ['class' => 'form-control', 'placeholder' =>  'Course Name', 'id' => 'course_name']) }}
                </div>
                    
                    <div class="form-group">
                        <label for="meeting_location">Location</label>
                        {{ Form::input('text', 'meeting_location', null, ['class' => 'form-control', 'placeholder' =>  'Fantastic HQ, Room 100', 'id' => 'classroom']) }}
                    </div>

                    <div clas="form-group">
                        <label for="meeting_time">Time</label>
                            {{ Form::input('text', 'meeting_time', null, ['class' => 'form-control', 'placeholder' => 'Tuesdays at Midnight', 'id' => 'meeting_time']) }}
                    </div>

                    <div class="form-group">
                        <label for="reg_code">Registration Code</label>
                        {{ Form::input('text', 'reg_code', null, ['class' => 'form-control', 'placeholder' => 'Registration Code', 'id' => 'reg_code']) }}

                    </div>
   
        </div>

        <div class="col-lg-6">
                    <div class="form-group">
                        <label for="instructor_display_name">Instructor Name</label>
                            {{ Form::input('text', 'instructor_display_name', null, ['class' => 'form-control', 'placeholder' =>  'Instructor Name', 'id' => 'instructor_name']) }}
                    </div>

                    <div class="form-group">
                    <label for="instructor_contact">Contact Email</label>
                        {{ Form::input('email', 'instructor_contact', null, ['class' => 'form-control', 'placeholder' =>  'professor.awesome@institution.edu', 'id' => 'instructor_contact']) }}
                    </div>

                    <div class="form-group">
                    <label for="instructor_office_location">Office Location</label>
                        {{ Form::input('text', 'instructor_office_location', null, ['class' => 'form-control', 'placeholder' =>  'Fantastic HQ, Penthouse Suite', 'id' => 'office_location']) }}
                    </div>

                    <div class="form-group">
                        <label for="office_hours">Office Hours</label>
                        {{ Form::input('text', 'office_hours', null, ['class' => 'form-control', 'placeholder' =>  'Mondays at 8am', 'id' => 'office_hours']) }}

                    </div>


                    {!! Form::submit('Create Course', ['class' => 'btn btn-primary btn-lg pull-right']) !!}  
    </div>
</div>
{!! Form::close() !!}  

@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
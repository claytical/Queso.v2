@extends('frontend.layouts.unassigned')

@section('content')

    <div class="col-lg-12">
        <h2>Join a Course</h2>


        <p class="lead">To join a class, you should have been given a registration code. Please enter it below.</p>
               {!! Form::open(['url' => 'course/join', 'class' => '', 'id' => 'add-skill']) !!}
               {{ Form::input('text', 'registration_code', null, ['class' => 'form-control', 'placeholder' => 'Registration Code', 'id' => 'registration_code']) }}
                {!! Form::submit('Join Course', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

    </div>


@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
@extends('frontend.layouts.unassigned')

@section('content')

    <div class="col-lg-12">
        <h2>Levels</h2>
        <p>You probably want more than one level. Traditionally, most classes require over 60% to get a D. That means most of your students will have an F for the majority of the class and make great progress towards the end of the course. To encourage motivation, try creating levels in between levels that correspond to letter grades.</p>

        <p></p>
               {!! Form::open(['url' => 'manage/course/add/level', 'class' => '', 'id' => 'add-level']) !!}
               {{ Form::input('text', 'level', null, ['class' => 'form-control', 'placeholder' => 'Level Name', 'id' => 'level_name']) }}
                {!! Form::submit('Add Level', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

        <ul>
            <li></li>
        </ul>

    </div>
    <div class="col-lg-12">
        {{ link_to('course/instructions', 'Finish!', ['class' => 'btn btn-default btn-block']) }}
    </div>
@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
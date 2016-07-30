@extends('frontend.layouts.master')

@section('content')

    <div class="col-lg-12">
        <h2>Skills</h2>
        <p>Skills allow you to evaluate quests. You can set thresholds of points for specific skills before specific quests are able to be attempted by a student. The combined totals of each skill will be used to assign levels.</p>

        <p>If you prefer to not use sets of skills, you can create just one skill. For example, "Points" or "XP."</p>
               {!! Form::open(['url' => 'manage/course/add/skill', 'class' => '', 'id' => 'add-skill']) !!}
               {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
                {!! Form::submit('Add Skill', ['class' => 'btn btn-primary btn-lg']) !!}
                {!! Form::close() !!}

        <ul>
            <li></li>
        </ul>

        <a href="#" class="btn btn-default">Continue to Levels</a>
    </div>


@endsection

@section('after-scripts-end')
    <script>
 
    </script>
@stop
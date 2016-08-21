@extends('frontend.layouts.unassigned')

@section('content')
    <div class="col-lg-12">
        <h2>Skills</h2>
        <p>Skills allow you to evaluate quests. You can set thresholds of points for specific skills before specific quests are able to be attempted by a student. The combined totals of each skill will be used to assign levels.</p>

        <p>If you prefer to not use sets of skills, you can create just one skill. For example, "Points" or "XP."</p>

        <div id="skills">
            @foreach($skills as $skill)
                <div>
                    {!! Form::open(['url' => 'course/remove/skill', 'class' => 'remove-skill']) !!}
                    {!! Form::hidden('skill', $skill->id) !!}
                    {!! Form::submit('Remove', ['class' => 'btn btn-danger btn-xs pull-right']) !!}                           
                    <h5>{!! $skill->name !!}</h5>
                    {!! Form::close() !!}
                </div>
            @endforeach
        </div>
    </div>

    <div class="col-lg-12">
        {!! Form::open(['url' => 'course/add/skill', 'class' => 'form-inline', 'id' => 'add-skill']) !!}
          <div class="input-group">
                {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
                <span class="input-group-btn">
                {!! Form::submit('Add Skill', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                </span>
          </div>
    </div>


    
    <div class="col-lg-12">
        <hr/>
        {{ link_to('course/add/levels', 'Continue to Levels', ['class' => 'btn btn-default btn-block pull-right']) }}
    </div>



@endsection

@section('after-scripts-end')
    <script>



    </script>
@stop
@extends('frontend.layouts.unassigned')

@section('content')
<section class="hero is-dark is-bold is-large">
  <div class="hero-body">
    <div class="container is-fluid">
      <h1 class="title">
        Skills
      </h1>
      <h2 class="subtitle">Skills allow you to evaluate quests. You can set thresholds of points for specific skills before specific quests are able to be attempted by a student. The combined totals of each skill will be used to assign levels.</h2>

      <p>If you prefer to not use sets of skills, you can create just one skill. For example, "Points" or "XP."</p>


        @foreach($skills as $skill)
                {!! Form::open(['url' => 'course/remove/skill', 'class' => 'remove-skill']) !!}
                {!! Form::hidden('skill', $skill->id) !!}
                <span class="tag is-light is-large">
                    {!! $skill->name !!}
                    {!! Form::submit('', ['class' => 'delete']) !!}                           
                </span>
                {!! Form::close() !!}
        @endforeach

        <div class="box">
            {!! Form::open(['url' => 'course/add/skill', 'class' => '', 'id' => 'add-skill']) !!}
            <p class="control"> 
                {{ Form::input('text', 'skill', null, ['class' => 'input', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
            </p>
            <p class="control">
                {!! Form::submit('Add Skill', ['class' => 'button is-large is-primary']) !!}
            </p>
            {!! Form::close() !!}
        </div>

        {{ link_to('course/add/levels', 'Continue to Levels', ['class' => 'button is-large is-light']) }}


    </div>
  </div>
</section>


@endsection

@section('after-scripts-end')
    <script>



    </script>
@stop
@extends('frontend.layouts.unassigned')

@section('content')

    <div class="col-lg-12">
        <h2>Levels</h2>
        <p>You probably want more than one level. Traditionally, most classes require over 60% to get a D. That means most of your students will have an F for the majority of the class and make great progress towards the end of the course. To encourage motivation, try creating levels in between levels that correspond to letter grades.</p>

        <div id="levels">
            @foreach($levels as $level)
                    {!! $level->name !!}
                    {!! Form::open(['url' => 'course/remove/level', 'class' => 'remove-level']) !!}
                    {!! Form::hidden('level', $level->id) !!}
                    {!! Form::submit('Remove', ['class' => 'btn btn-danger btn-xs pull-right']) !!}                           
                    {!! Form::close() !!}
            @endforeach
        </div>
    </div>

    <div class="col-lg-12">
        {!! Form::open(['url' => 'course/add/level', 'class' => 'form-inline', 'id' => 'add-level']) !!}

          <div class="input-group">
                {{ Form::input('text', 'skill', null, ['class' => 'form-control', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
                <span class="input-group-btn">
                {!! Form::submit('Add Skill', ['class' => 'btn btn-primary']) !!}
                {!! Form::close() !!}
                </span>
          </div>






          <div class="input-group">
                {{ Form::input('text', 'level', null, ['class' => 'form-control', 'placeholder' => 'Level Name', 'id' => 'level_name']) }}
                {{ Form::input('number', 'amount', null, ['class' => 'form-control', 'placeholder' => 'Lowest Point Value For This Level', 'id' => 'level_amount']) }}
                <span class="input-group-btn">
                    {!! Form::submit('Add Level', ['class' => 'btn btn-primary btn-lg']) !!}
                    {!! Form::close() !!}
                </span>

          </div>
    </div>



    <div class="col-lg-12">
        <hr/>
        {{ link_to('course/instructions', 'Finish!', ['class' => 'btn btn-default btn-block']) }}
    </div>
@endsection

@section('after-scripts-end')
    <script>

    </script>
@stop
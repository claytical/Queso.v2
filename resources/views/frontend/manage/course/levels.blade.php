@extends('frontend.layouts.unassigned')

@section('content')


<section class="hero is-dark is-bold is-medium">
  <div class="hero-body">
    <div class="container is-fluid">
      <h1 class="title">
        Levels
      </h1>
      <h2 class="subtitle">You probably want more than one level. Traditionally, most classes require over 60% to get a D. That means most of your students will have an F for the majority of the class and make great progress towards the end of the course. To encourage motivation, try creating levels in between levels that correspond to letter grades. Additionally, you can lock students out of assigments until they reach a specific level.</h2>
        @if(!$levels->isEmpty())
        <table class="table is-narrow">
            <thead>
            </thead>
            <tbody>
            <tr>
                <th>Level Name</th>
                <th>Points Required</th>
            </tr>
            @foreach($levels as $level)
                    <td>
                        {!! Form::open(['url' => 'course/remove/level', 'class' => 'remove-level']) !!}
                        {!! Form::hidden('level', $level->id) !!}
                        {!! $level->name !!}
                        <button type="submit" class="delete"></button>
                    </td>
                    <td>
                        {!! $level->amount !!}
                        {!! Form::close() !!}
                    </td>
            @endforeach
            </tbody>
            <tfoot>
            </tfoot>
        </table>
        @endif
        <div class="box">
<!-- Not continuing setup, using course admin instead-->
            {!! Form::open(['url' => 'course/add/level', 'class' => '', 'id' => 'add-level']) !!}

            <div class="field">
              <label class="label">Level Name</label>
              <p class="control">
                {{ Form::input('text', 'level', null, ['class' => 'input', 'placeholder' => 'Newbie', 'id' => 'level_name']) }}
              </p>
            </div>

            <div class="field">
              <label class="label">Points Required</label>
              <p class="control">
                {{ Form::input('number', 'amount', null, ['class' => 'input', 'placeholder' => '0', 'id' => 'level_amount']) }}
              </p>
            </div>

            <p class="control">
                {!! Form::submit('Add Level', ['class' => 'button is-primary is-medium']) !!}
            </p>

            {!! Form::close() !!}

        </div>

        {{ link_to('course/instructions', 'Finish!', ['class' => 'button is-large is-light']) }}

    </div>
  </div>
</section>


















@endsection

@section('after-scripts-end')
    <script>

    </script>
@stop
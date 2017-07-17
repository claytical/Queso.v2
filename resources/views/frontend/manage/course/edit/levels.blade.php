@extends('frontend.layouts.unassigned')

@section('content')
<section class="section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
            <h1 class="title">Levels</h1>
                {!! Form::open(['url' => 'course/add/level', 'class' => '', 'id' => 'add-level']) !!}
              <div class="field is-horizontal">
                <div class="field-label is-normal">
                  <label class="label">Level Name</label>
                </div>
                <div class="field-body">
                  <div class="field is-grouped">
                    <p class="control is-expanded">
                    {{ Form::input('text', 'level', null, ['class' => 'input is-large', 'placeholder' => 'Name', 'id' => 'level_name']) }}
                    </p>
                  </div>
                  <div class="field">
                    <p class="control is-expanded">
                      {{ Form::input('number', 'amount', null, ['class' => 'input is-large', 'placeholder' => '0', 'id' => 'level_amount']) }}                      
                    </p>
                  </div>
                </div>
              </div>
            <p class="control">
                {{ Form::hidden('course_exists', true, ['id' => 'course_check']) }}
                {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}

                {!! Form::submit('Add Level', ['class' => 'button is-primary is-medium']) !!}
            </p>

            {!! Form::close() !!}

          </div>

            <table class="table">
              <thead>
                <tr>
                  <th>Level</th>
                  <th>Points Required</th>
                </tr>
              </thead>
              <tbody>

              @foreach($levels as $level)
                      <tr>
                        <td>{!! $level->name !!}</td>
                        <td>{!! $level->amount !!}</td>
                        <td>
                          {!! Form::open(['url' => 'course/remove/level', 'class' => 'remove-level']) !!}
                          {!! Form::hidden('level', $level->id) !!}                          
                          {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                          {{ Form::hidden('course_exists', true, ['id' => 'course_check']) }}
                          <button type="submit" class="delete"></button>
                          {!! Form::close() !!} 
                        </td>
              @endforeach
              </tbody>
            </table>
    </div>
  </div>
</section>

@endsection

@section('after-scripts-end')
    <script>

    </script>
@stop
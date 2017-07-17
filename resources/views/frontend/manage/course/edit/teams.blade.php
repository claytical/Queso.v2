@extends('frontend.layouts.master')

@section('content')

<section class="section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
            <h1 class="title">Teams</h1>
          <div class="field">
              {!! Form::open(['url' => 'manage/course/add/team', 'class' => '', 'id' => 'add-team']) !!}
              <div class="field has-addons">
                <p class="control is-expanded">

                {{ Form::input('text', 'team', null, ['class' => 'input is-large', 'placeholder' => 'Team Name', 'id' => 'team_title']) }}
                {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                {!! Form::submit('Add', ['class' => 'button is-primary is-large']) !!}
                {!! Form::close() !!}
                </p>
                <p class="control">
                  {!! Form::submit('Add Team', ['class' => 'button is-primary is-large']) !!}
                </p>
              </div>            
            {!! Form::close() !!}
          </div>

            <table class="table">
              <thead>
                <tr>
                  <th>Team</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                @foreach($teams as $team)

                    <td>{!! link_to('manage/course/team/' . $team->id, $team->name) !!}</td>
                    <td>
                      <a class="button is-small" href="mailto:{!! Form::teamEmailList($team->id) !!}">Mail</a>

                      {!! Form::open(['url' => 'manage/course/remove/team', 'class' => 'remove-team']) !!}
                      {!! Form::hidden('team_id', $team->id) !!}
                      {!! Form::submit('Remove', ['class' => 'button is-small is-danger']) !!}                           
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
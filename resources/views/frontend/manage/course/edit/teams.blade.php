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
                {!! Form::close() !!}
                </p>
                <p class="control">
                  {!! Form::submit('Add Team', ['class' => 'button is-primary is-large']) !!}
                </p>
              </div>            
            {!! Form::close() !!}
          </div>
          @if($teams->isEmpty())
            <h2 class="subtitle">Teams allow you to group students together for easier management. For example, if you teach two sections of the same course you might have a Monday Team and a Tuesday Team.</h2>
          @else

            <table class="table">
              <thead>
                <tr>
                  <th>Team</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                @foreach($teams as $team)
                  <tr>
                    <td>{!! link_to('manage/course/team/' . $team->id, $team->name) !!}</td>
                    <td>

                      {!! Form::open(['url' => 'manage/course/remove/team', 'class' => 'remove-team']) !!}
                      {!! Form::hidden('team_id', $team->id) !!}
                      <a class="button is-small" href="mailto:{!! Form::teamEmailList($team->id) !!}">Mail</a>

                      {!! Form::submit('Remove', ['class' => 'button is-small is-danger']) !!}                           
                      {!! Form::close() !!}
                    </td>
                    </tr>
                @endforeach

              </tbody>
            </table>
          @endif
    </div>
  </div>
</section>
@endsection

@section('after-scripts-end')
    <script>



    </script>
@stop
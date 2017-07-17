@extends('frontend.layouts.master')

@section('content')

<section class="section">
    <div class="columns">
        <div class="column is-2">
        @include('frontend.includes.admin')
        </div>
        <div class="column">
            <h1 class="title">Skills</h1>
          <div class="field">
              {!! Form::open(['url' => 'course/add/skill', 'class' => '', 'id' => 'add-skill']) !!}
              <div class="field has-addons">
                <p class="control is-expanded">
                  {{ Form::hidden('course_exists', true, ['id' => 'course_check']) }}
                  {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}

                  {{ Form::input('text', 'skill', null, ['class' => 'input is-large', 'placeholder' => 'Skill Name', 'id' => 'skill_name']) }}
                </p>
                <p class="control">

                  {!! Form::submit('Add Skill', ['class' => 'button is-primary is-large']) !!}
                </p>
              </div>            
            {!! Form::close() !!}
          </div>

            <table class="table">
              <thead>
                <tr>
                  <th>Skill</th>
                  <th></th>
                </tr>
              </thead>
              <!--
              <tfoot>
                <tr>
                  <th>Headline</th>
                  <th>Date</th>
                  <th></th>
                </tr>
              </tfoot>
              -->
              <tbody>
              @foreach($skills as $skill)
                      <tr>
                        <td>{!! $skill->name !!}</td>
                        <td>
                          {!! Form::open(['url' => 'course/remove/skill', 'class' => 'remove-skill']) !!}
                          {!! Form::hidden('skill', $skill->id) !!}
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
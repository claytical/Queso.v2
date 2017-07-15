@extends('frontend.layouts.master')

@section('content')

<section class="hero is-dark is-bold">
  <div class="hero-body">
    <div class="container is-fluid">
        {!! Form::open(['url' => 'manage/announcements/create', 'id'=>'quest-create-form']) !!}
        {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
        <h1 class="title">
        New Announcement
      </h1>
        <div class="field">
          <p class="control">
            {{ Form::input('text', 'title', null, ['class' => 'input', 'placeholder' => 'Adventure Awaits!', 'id' => 'headline']) }}
          </p>
        </div>
        <div class="field">
            <p class="control">
            {!! Form::textarea('body', null, ['class' => 'input', 'files' => true]) !!}
            </p>
        </div>

        <div class="field">
            <p class="control">
                {!! Form::checkbox('sticky', 1) !!} Show on Dashboard
            </p>
        </div>

        {!! Form::submit('Post', ['class' => 'button is-primary is-large']) !!}


        {!! Form::close() !!}
    </div>
  </div>
</section>

@endsection

@section('after-scripts-end')

@stop
@extends('frontend.layouts.master')

@section('content')

<section class="section dark-section">
<div class="columns">
    <div class="column is-2">
        @include('frontend.includes.admin')
    </div>
    <div class="column">
        <div class="box">
            <div class="container is-fluid">
                {!! Form::open(['url' => 'manage/announcements/create', 'id'=>'quest-create-form']) !!}
                {{ Form::hidden('course_id', $course_id, ['id' => 'course_id']) }}
                <h1 class="title headline is-uppercase">
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

                {!! Form::submit('Post', ['class' => 'button is-primary is-large is-pulled-right']) !!}


                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
</section>

@endsection

@section('after-scripts-end')

@stop
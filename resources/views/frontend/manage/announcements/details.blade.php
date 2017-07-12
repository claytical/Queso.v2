@extends('frontend.layouts.master')

@section('content')
<section class="hero is-dark is-bold">
  <div class="hero-body">
    <div class="container is-fluid">
    {!! Form::open(['url' => 'manage/announcement/update', 'id'=>'announcement-update-form']) !!}
        {{ Form::hidden('announcement_id', $announcement->id)}}

        <h1 class="title">
        Update Announcement
      </h1>
        <div class="field">
          <p class="control">
            {{ Form::input('text', 'title', $announcement->title, ['class' => 'input', 'placeholder' => 'Adventure Awaits!', 'id' => 'headline']) }}
          </p>
        </div>
        <div class="field">
            <p class="control">
                {!! Form::textarea('body', $announcement->body, ['class' => 'input', 'files' => true]) !!}
            </p>
        </div>

        <div class="field">
            <p class="control">
                {!! Form::checkbox('sticky', 1, $announcement->sticky) !!} Show on Dashboard
            </p>
        </div>

        {!! Form::submit('Update', ['class' => 'button is-primary is-large']) !!}


        {!! Form::close() !!}
    </div>
  </div>
</section>
@endsection

@section('after-scripts-end')

@stop
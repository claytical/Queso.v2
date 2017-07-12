@extends('frontend.layouts.master')

@section('content')
<div class="tile is-ancestor">
  <div class="tile is-vertical is-8">
    <div class="tile">
      <div class="tile is-parent is-vertical">
        <article class="tile is-child box">
          <p class="title">{!! $course->name !!} with <a href="mailto:{!! $course->instructor_contact !!}">{!! $course->instructor_display_name !!}</a></p>

            @if (access()->instructor())
            <p class="subtitle">Instructor</h5>
            @else
            <p class="subtitle">{!! $current_level->name !!}</p>
            @endif
          <p>{!! $course->meeting_location !!}, {!! $course->meeting !!}</p>
          <p>Instructor Info Modal</p>
          <p>{!! $course->instructor_office_location !!}, {!! $course->office_hours !!}</p>
            @if($team_members)
                <h6>Your Peer Group</h6>
                <ul class="list-unstyled">
                    @foreach($team_members as $team_member)
                        <li><a href="mailto:{!! $team_member->email !!}">{!! $team_member->name !!}</a></li>
                    @endforeach
                </ul>
            @endif
            @foreach($courses as $class)
                <p> {!! link_to('course/switch/'.$class->id, $class->name) !!}</p>
            @endforeach
        </article>
      </div>
      <div class="tile is-parent">
        <article class="tile is-child box">
          <p class="title">Announcement Headline</p>
          <p class="subtitle">Class Name</p>
          <p>Lorem Ipsum</p>
            {{ link_to('announcements', 'View All', ['class' =>'button']) }}          
        </article>
        @if(!$announcements->isEmpty())
            @foreach($announcements as $announcement)
                <article class="tile is-child box">
                  <p class="title">{!! $announcement->title !!}</p>
                  <p class="subtitle">Class Name</p>
                  {!! $announcement->body !!}
                </article>
            @endforeach
        @else
        @endif

        <article class="tile is-child box">
          <p class="title">Announcement Headline</p>
          <p class="subtitle">Class Name</p>
          <p>Lorem Ipsum</p>
        </article>
        <article class="tile is-child box">
          <p class="title">Announcement Headline</p>
          <p class="subtitle">Class Name</p>
          <p>Lorem Ipsum</p>
        </article>

      </div>
    </div>
  </div>
  <div class="tile is-parent">
    <article class="tile is-child notifications is-light">
      <div class="content">
        <p class="title">Notifications</p>

            @if($feedback_requests)

            @foreach($feedback_requests as $feedback_request)
                <h5>{!! $feedback_request->quest_name !!}</h5>
                    <ul class="unstyled-list">
                    @foreach($feedback_request->requests as $request)
                        <li>{{ link_to('review/'.$feedback_request->quest_id.'/'.$request->sender->id.'/'.$request->revision, $request->sender->name) }}</li>
                    @endforeach
                    </ul>
            @endforeach
            @endif
        <div class="content">
            @if(!$notifications->isEmpty())
                    @foreach($notifications as $notice)
                        <p>
                            @if($notice->url)
                            {{ link_to($notice->url, $notice->message) }}
                            @else
                            {!! $notice->message !!}
                            @endif
                            <a href="{!! url('notification/dismiss', [$notice->id]);!!}"><span class="glyphicon glyphicon-remove pull-right text-danger"></span></a>
                        </p>
                    @endforeach
                @endif
            <p>Something Happened</p>
            <p>Another Thing Happened</p>
        </div>
      </div>
    </article>

    <article class="tile is-child box">
      <div class="content">
        <p class="title">Agenda</p>
        <p class="subtitle">Upcoming Deadlines</p>
        <div class="content">
            <p>Assignment Name</p>
            <p>Assignment #2 Name</p>
        </div>
        <p class="subtitle">Due Later</p>
        <div class="content">
            <p>Assignment #3</p>
            <p>Assignment #4</p>
        </div>

      </div>
    </article>

    <article class="tile is-child box">
      <div class="content">
        <p class="title">Submissions</p>
        <p class="subtitle">Course Name</p>
        <div class="content">
            <p>Assignment Name</p>
            <p>Assignment #2</p>
        </div>
        <p class="subtitle">Course Name</p>
        <div class="content">
            <p>Assignment #3</p>
            <p>Assignment #4</p>
        </div>

      </div>
    </article>

  </div>
</div>

@endsection

@section('after-scripts-end')
@stop
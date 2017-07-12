@extends('frontend.layouts.master')

@section('content')

<div class="tile is-ancestor">
  <div class="tile is-4 is-vertical is-parent">
    <div class="tile is-child box">
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
    </div>
    <div class="tile is-child box">
      <p class="title">Course Two</p>
    </div>
  </div>
  <div class="tile is-parent is-vertical is-4">
    <div class="tile is-child box">
      <p class="title">Announcement #1</p>
    </div>
    <div class="tile is-child box">
      <p class="title">Announcement #2</p>
    </div>
    @if(!$announcements->isEmpty())
        @foreach($announcements as $announcement)
            <div class="tile is-child box">
              <p class="title">{!! $announcement->title !!}</p>
              <p class="subtitle">Class Name</p>
              <p>{!! $announcement->body !!}</p>
            </div>
        @endforeach
    @else
    @endif


  </div>
  <div class="tile is-parent is-vertical is-4">
    <div class="tile is-child box">
      <p class="title">Notifications</p>
            @if($feedback_requests)

                @foreach($feedback_requests as $feedback_request)
                    <p class="subtitle">{!! $feedback_request->quest_name !!}</p>
                        <ul class="unstyled-list">
                        @foreach($feedback_request->requests as $request)
                            <li>{{ link_to('review/'.$feedback_request->quest_id.'/'.$request->sender->id.'/'.$request->revision, $request->sender->name) }}</li>
                        @endforeach
                        </ul>
                @endforeach
            @endif
            @if(!$notifications->isEmpty())
                    @foreach($notifications as $notice)
                        <p>
                            @if($notice->url)
                            <p class="subtitle">{{ link_to($notice->url, $notice->message) }}</p>
                            @else
                            <p class="subtitle">{!! $notice->message !!}</p>
                            @endif
                            <a href="{!! url('notification/dismiss', [$notice->id]);!!}"><span class="delete"></span></a>
                        </p>
                    @endforeach
                @endif



    </div>
    <div class="tile is-child box">
      <p class="title">Agenda</p>
    </div>
    <div class="tile is-child box">
      <p class="title">Submissions</p>
    </div>

  </div>

</div>


@endsection

@section('after-scripts-end')
@stop
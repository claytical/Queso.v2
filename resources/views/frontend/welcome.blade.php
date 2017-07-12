@extends('frontend.layouts.master')

@section('content')

<div class="tile is-ancestor">
  <div class="tile is-4 is-vertical is-parent">
    <div class="tile is-child box">
      <p class="title">Courses</p>
      <p class="subtitle">{!! $course->name !!}</p>
            @if (!access()->instructor())
            <p>{!! $current_level->name !!}</p>
            @endif
          <p>{!! $course->meeting_location !!}, {!! $course->meeting !!}</p>
            <div class="content is-small">
                <h1>Instructor Info</h1>
                <h2><a href="mailto:{!! $course->instructor_contact !!}">{!! $course->instructor_display_name !!}</a></h2>
                <h3>Office Location and Hours</h3>
                  <p>{!! $course->instructor_office_location !!}, {!! $course->office_hours !!}</p>
            </div>
    </div>
    <div class="tile is-child box">
      <p class="title">Peer Groups</p>
            @if($team_members)
                <p class="subtitle">Class Name</p>
                    @foreach($team_members as $team_member)
                        <p><a href="mailto:{!! $team_member->email !!}">{!! $team_member->name !!}</p>
                    @endforeach
            @endif
            <p class="subtitle">Example Course</p>
            <p>John Winslow</p>
            <p>Betty Rubble</p>
            <p>Fred Flinstone</p>
    </div>
  </div>
  <div class="tile is-parent is-vertical is-4">
    <div class="tile is-child box">
      <p class="title">Announcements</p>
    @if(!$announcements->isEmpty())
        @foreach($announcements as $announcement)
        <p class="subtitle">{!! $announcement->title !!}</p>
        <span class="tag is-info">{!! $course->name !!}</span>
        <div class="content">
            <p>{!! $announcement->body !!}</p>
        </div>
        @endforeach
    @else
        <p class="subtitle">Fake Announcement #1</p>
        <span class="tag is-info">Demo Course</span>
        <div class="content">
            <p>Lorem ipsum dolor consequat</p>
        </div>
        <p class="subtitle">Fake Announcement #2</p>
        <span class="tag is-info">Example Course</span>
        <div class="content">
            <p>Lorem ipsum dolor consequat</p>
        </div>

    @endif


    </div>


  </div>
  <div class="tile is-parent is-vertical is-4">
    <div class="tile is-child box">
      <p class="title">Notifications</p>
            @if($feedback_requests)
                <p class="subtitle">Feedback Requests</p>
                <div class="content is-small">
                @foreach($feedback_requests as $feedback_request)
                    <h1>{!! $feedback_request->quest_name !!}</h1>
                        @foreach($feedback_request->requests as $request)
                            <p>{{ link_to('review/'.$feedback_request->quest_id.'/'.$request->sender->id.'/'.$request->revision, $request->sender->name) }}</p>
                        @endforeach
                @endforeach
                </div>
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
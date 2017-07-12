@extends('frontend.layouts.master')

@section('content')
<section class="section is-dark is-bold">
    <div class="tile is-ancestor">
      <div class="tile is-parent is-vertical is-5">
        <div class="tile is-child notification">
          <p class="title">Announcements</p>
        @if(!$announcements->isEmpty())
            @foreach($announcements as $announcement)
            <span class="tag is-info">{!! $course->name !!}</span>
            <p class="subtitle">{!! $announcement->title !!}</p>
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
        <div class="tile is-child notification">
          <p class="title">Agenda</p>
        </div>
        <div class="tile is-child notification">
          <p class="title">Submissions</p>
        </div>

      </div>

      <div class="tile is-2 is-vertical is-parent">
        @if($feedback_requests || !$notifications->isEmpty())

        <div class="tile is-child notification">
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
        @endif
        <div class="tile is-child notification">
          <p class="title">Courses</p>
          <p class="subtitle">{!! $course->name !!}</p>
                @if (!access()->instructor())
                <p>{!! $current_level->name !!}</p>
                @endif
                <div class="content is-small">
                    <h3>Class Location: {!! $course->meeting_location !!}</h3>
                    <h3>Class Time: {!! $course->meeting !!}</h3>
                </div>
                <div class="content is-small">
                    <h2><a href="mailto:{!! $course->instructor_contact !!}">{!! $course->instructor_display_name !!}</a></h2>
                    <h3>Office Location: {!! $course->instructor_office_location !!}</h3>
                    <h3>Office Hours: {!! $course->office_hours !!}</h3>
                </div>
        </div>
        <div class="tile is-child notification">
          <p class="title">Peer Groups</p>
                @if($team_members)
                    <p class="subtitle">Class Name</p>
                        @foreach($team_members as $team_member)
                            <p><a href="mailto:{!! $team_member->email !!}">{!! $team_member->name !!}</a></p>
                        @endforeach
                @endif
                <p class="subtitle">Example Course</p>
                <p>John Winslow</p>
                <p>Betty Rubble</p>
                <p>Fred Flinstone</p>
        </div>
      </div>

    </div>
</section>
@endsection

@section('after-scripts-end')
@stop
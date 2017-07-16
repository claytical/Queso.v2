@extends('frontend.layouts.master')

@section('content')
<section class="section">
<div class="tile is-ancestor">
      <div class="tile is-parent is-vertical is-5">
        <div class="tile is-child notification">
          <p class="title">Announcements</p>
        @if(!$announcements->isEmpty())
            @foreach($announcements as $announcement)
            <span class="tag is-info is-pulled-right">{!! $course->name !!}</span>
            <p class="subtitle">{!! $announcement->title !!}</p>
            <div class="content">
                <p>{!! $announcement->body !!}</p>
            </div>
            <hr/>
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
          <h3 class="title">Agenda</h3>           
            @foreach(access()->agenda() as $date => $quest)
                @if($date)
                    <h4 class="subtitle">{!! date('m-d-Y', strtotime($date)) !!}</h4>
                @else
                    <h4 class="subtitle">Anytime</h4>
                @endif

                @foreach($quest as $q)
                    <h5>{!! $q->name !!}</h5>
                @endforeach
            @endforeach 
        </div>

        <div class="tile is-child notification">
            <p class="title">Submissions</p>
        </div>

    </div>

    <div class="tile is-3 is-vertical is-parent">
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
            @foreach(access()->courses() as $c)
                <p class="subtitle">{!! $c->name !!}</p>
                <div class="content is-small">
                    <h5>Class Location</h5>
                    <p><strong>{!! $c->meeting_location !!}</strong></p>
                    <h5>Class Time</h5>
                    <p><strong>{!! $c->meeting !!}</strong></p>
                </div>
                <div class="content is-small">
                    <a class="is-large is-pulled-right" href="mailto:{!! $c->instructor_contact !!}"><span class="icon is-small"><i class="fa fa-envelope"></i></span></a>                
                    <h3>{!! $c->instructor_display_name !!}</h3>
                    <h5>Office Location</h5>
                    <p><strong>{!! $c->instructor_office_location !!}</strong></p>
                    <h5>Office Hours</h5>
                    <p><strong>{!! $c->office_hours !!}</strong></p>
                </div>
            @endforeach
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
@extends('frontend.layouts.master')

@section('content')
<section class="section">
<div class="tile is-ancestor">
      <div class="tile is-parent is-vertical is-4">
        <div class="tile is-child">
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
        <div class="tile is-child">
          <h3 class="title">Agenda</h3>           
            @foreach(access()->agenda() as $date => $quest)
                <div class="is-clearfix">
                    @if($date)
                        <h4 class="subtitle is-pulled-right">{!! date('m-d-Y', strtotime($date)) !!}</h4>
                    @else
                        <h4 class="subtitle is-pulled-right">Anytime</h4>
                    @endif
                </div>
                @foreach($quest as $q)
                    <div class="field">
                    @if($q->quest_type_id == 1)
                        <a href="{!! URL::to('quest/attempt/response/'.$q->id) !!}" class="button is-small is-pulled-right">Attempt</a>                    
                    @endif
                    @if($q->quest_type_id == 2)
                    @endif
                    @if($q->quest_type_id == 3)
                        <a href="{!! URL::to('quest/watch/'.$q->id) !!}" class="button is-small is-pulled-right">Attempt</a>                    
                    @endif
                    @if($q->quest_type_id == 4)
                        <a href="{!! URL::to('quest/attempt/link/'.$q->id) !!}" class="button is-small is-pulled-right">Attempt</a>                    
                    @endif
                    @if($q->quest_type_id == 5)
                        <a href="{!! URL::to('quest/attempt/upload/'.$q->id) !!}" class="button is-small is-pulled-right">Attempt</a>                    
                    @endif
                    @if($q->quest_type_id == 6)
                        <a href="{!! URL::to('quest/attempt/group/upload/'.$q->id) !!}" class="button is-small is-pulled-right">Attempt</a>                    
                    @endif
                    @if($q->quest_type_id == 7)
                        <a href="{!! URL::to('quest/attempt/group/link/'.$q->id) !!}" class="button is-small is-pulled-right">Attempt</a>                    
                    @endif
                        
                        <h5>{!! $q->name !!}</h5>
                    </div>
                @endforeach
                <hr/>
            @endforeach 
        </div>

        <div class="tile is-child">
            <p class="title">Submissions</p>
            @foreach(access()->awaiting_grade() as $course => $quest)
                <div class="is-clearfix">
                    <h4 class="subtitle">{!! $course !!}</h4>
                </div>
                @foreach($quest as $q)
                    @if($q['attempt'])
                    <div class="field">
                        <a href="{!! URL::to('grade/quest/'.$q['quest_id'].'/'.$q['attempt']->id) !!}">{!! $q['quest'] !!}</a>
                        <div class="is-pulled-right">
                            {!! $q['student'] . ' on ' . date('m/d', strtotime($q['attempt']->created_at)) !!}
                        </div>                
                    </div>
                    @endif
                @endforeach
            @endforeach
        </div>

    </div>

    <div class="tile is-4 is-vertical is-parent">
        @if($feedback_requests || !$notifications->isEmpty())

            <div class="tile is-child">
              <p class="title">Notifications</p>
                    @if($feedback_requests)
                        <div class="notification">
                             <a href="{!! URL::to('feedback') !!}" class="button is-small is-primary is-pulled-right">View</a>
                             <p>You have {!! count($feedback_requests) !!} feedback requests.</p>
                        </div>
                    @endif

                    @if(!$notifications->isEmpty())

                        @foreach($notifications as $notice)

                            <div class="notification">
                                 <a href="{!! url('notification/dismiss', [$notice->id]);!!}" class="delete"></a>
                                                             
                                @if($notice->url)
                                    {{ link_to($notice->url, $notice->message) }}
                                @else
                                    {!! $notice->message !!}
                                @endif                              
                            </div>
                        @endforeach
                    @endif
            </div>
        @endif

        <div class="tile is-child">
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

    </div>

</div>
</section>
@endsection

@section('after-scripts-end')
@stop
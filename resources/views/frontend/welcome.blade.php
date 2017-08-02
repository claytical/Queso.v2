@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section">

    <div class="columns">
        <div class="column">
            <div class="box">
              <p class="title is-uppercase headline">Announcements</p>
                @if(!$announcements->isEmpty())
                    @foreach($announcements as $announcement)
                        <a href="{!! URL::to('announcements/' . $announcement->course_id) !!}"><span class="tag is-dark is-pulled-right">{!! $course->name !!}</span></a>
                        <p class="subtitle">{!! $announcement->title !!}</p>
                        <div class="content announcement">
                            <p>{!! $announcement->body !!}</p>
                        </div>
                    @endforeach
                @else
                    <div class="content">
                        <p>No announcements have been made</p>
                    </div>
                @endif
            </div>



        </div>
        <div class="column">
            @if(count(access()->courses_taught()) > 0)
                <div class="box">
                    <p class="title is-uppercase headline">Submissions</p>
                    @foreach(access()->awaiting_grade() as $course => $quest)
                        @if(count($quest))

                            <div class="is-clearfix">
                                <h4 class="subtitle is-uppercase">{!! $course !!}</h4>
                            </div>
                            @foreach($quest as $q)
                                @if($q['attempt'])
                                <div class="field">
                                    <div class="is-pulled-right">
                                        {!! $q['student'] . ' on ' . date('m/d', strtotime($q['attempt']->created_at)) !!}
                                    </div>                
                                    <a href="{!! URL::to('grade/quest/'.$q['quest_id'].'/'.$q['attempt']->id) !!}">{!! $q['quest'] !!}</a>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                </div>
            @endif

            <div class="box">
                <h3 class="title is-uppercase headline">Agenda</h3>           
                @foreach(access()->agenda() as $date => $quest)
                    <div class="is-clearfix agenda">
                        @if($date)
                            <h4 class="subtitle is-pulled-right is-uppercase">Due {!! date('m/d', strtotime($date)) !!}</h4>
                        @else
                            <h4 class="subtitle is-pulled-right is-uppercase">Due Anytime</h4>
                        @endif
                    </div>
                    @foreach($quest as $q)
                        <div class="field">
                        @if($q->quest_type_id == 1)
                            <a href="{!! URL::to('quest/attempt/response/'.$q->id) !!}" class="">{!! $q->name !!}</a>                    
                        @endif
                        @if($q->quest_type_id == 2)
                        @endif
                        @if($q->quest_type_id == 3)
                            <a href="{!! URL::to('quest/watch/'.$q->id) !!}" class="">{!! $q->name !!}</a>                    
                        @endif
                        @if($q->quest_type_id == 4)
                            <a href="{!! URL::to('quest/attempt/link/'.$q->id) !!}" class="">{!! $q->name !!}</a>                    
                        @endif
                        @if($q->quest_type_id == 5)
                            <a href="{!! URL::to('quest/attempt/upload/'.$q->id) !!}" class="">{!! $q->name !!}</a>                    
                        @endif
                        @if($q->quest_type_id == 6)
                            <a href="{!! URL::to('quest/attempt/group/upload/'.$q->id) !!}" class="">{!! $q->name !!}</a>                    
                        @endif
                        @if($q->quest_type_id == 7)
                            <a href="{!! URL::to('quest/attempt/group/link/'.$q->id) !!}" class="">{!! $q->name !!}</a>                    
                        @endif
                        </div>
                    @endforeach
                @endforeach 
            </div>          
        </div>

        <div class="column">
            @if($feedback_requests || !$notifications->isEmpty())

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
            @endif
        <div class="box">
            <p class="title is-uppercase headline">Courses</p>
            @foreach($courses as $c)
                <div class="content is-small course">
                    <h3 class="title is-uppercase">{!! $c->name !!}</h3>
                    <h5>Class Time and Location</h5>
                    <p><strong>{!! $c->meeting !!}, {!! $c->meeting_location !!}</strong></p>
                    <h3>{!! $c->instructor_display_name !!} <a class="is-large is-pulled-right" href="mailto:{!! $c->instructor_contact !!}"><span class="icon is-medium"><i class="fa fa-envelope"></i></span></a></h3>
                    <h5>Office Hours and Location</h5>
                    <p><strong>{!! $c->office_hours !!}, {!! $c->instructor_office_location !!}</strong></p>
                </div>
            @endforeach
        </div>
    </div>
</div>
</section>
@endsection

@section('after-scripts-end')
@stop
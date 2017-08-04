@extends('frontend.layouts.master')

@section('content')
<section class="section dark-section">

    <div class="columns">
    @if(!$announcements->isEmpty())
        <div class="column">
            <div class="box">
              <p class="title is-uppercase headline">Announcements</p>
                    @foreach($announcements as $announcement)
                        <a href="{!! URL::to('announcements/' . $announcement->course_id) !!}"><span class="tag is-dark is-pulled-right">{!! $course->name !!}</span></a>
                        <p class="subtitle">{!! $announcement->title !!}</p>
                        <div class="content announcement">
                            <p>{!! $announcement->body !!}</p>
                        </div>
                    @endforeach
            </div>
        </div>
    @endif

        <div class="column">
            @if(count(access()->courses_taught()) > 0)
                <div class="box">
                    <p class="title is-uppercase headline">Submissions</p>
                    @php($has_submissions = false)
                    @foreach(access()->awaiting_grade() as $course => $quest)
                        @if(count($quest))
                            @php($has_submissions = true)
                            <div class="is-clearfix">
                                <h4 class="subtitle is-uppercase">{!! $course !!}</h4>
                            </div>
                            @foreach($quest as $q)
                                @if($q['attempt'])
                                <div class="field">
                                    <div class="is-pulled-right">
                                        {!! $q['student'] . ' on ' . date('n/j', strtotime($q['attempt']->created_at)) !!}
                                    </div>                
                                    <a href="{!! URL::to('grade/quest/'.$q['quest_id'].'/'.$q['attempt']->id) !!}">{!! $q['quest'] !!}</a>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    @endforeach
                    @if(!$has_submissions)
                        <p>There are currently no submissions.</p>
                    @endif
                </div>
            @endif

            <div class="box">
                <h3 class="title is-uppercase headline">Agenda</h3>           

                @php($has_agenda = false)
                @foreach(access()->agenda() as $date => $quest)
                    @php($has_agenda = true)
                    <div class="is-clearfix agenda">
                        @if($date)
                            <h4 class="subtitle is-pulled-right is-uppercase">{!! date('n/j', strtotime($date)) !!}</h4>
                        @else
                            <h4 class="subtitle is-pulled-right is-uppercase">Due Anytime</h4>
                        @endif
                    </div>
                    @foreach($quest as $q)
                        <div class="">
                        @if($q->quest_type_id == 1)
                            <a href="{!! URL::to('quest/attempt/response/'.$q->id) !!}" class="">{!! $q->name !!}</a>                    
                        @endif
                        @if($q->quest_type_id == 2)
                        {!! $q->name !!}
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
                            <span class="tag is-pulled-right is-primary">{!! $q->course->name !!}</span>
                        </div>
                    @endforeach
                @endforeach
                @if(!$has_agenda)
                    <p>There is nothing currently due.</p>
                @endif 
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
            @if(!$courses->isEmpty())
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
            @else
                <p>You aren't enrolled in any active courses.</p>
                <p><a href="#">View Archived Courses</a> | <a href="{!! URL::to('choose') !!}">Enroll in a New Course</a></p>
            @endif
        </div>
    </div>
</div>
</section>
@endsection

@section('after-scripts-end')
@stop
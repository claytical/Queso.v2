@extends('frontend.layouts.master')

@section('content')
   <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Announcements {{ link_to('announcements', 'View All', ['class' =>'btn btn-default btn-xs pull-right']) }}</div>
                  <div class="panel-body">
                    @if(!$announcements->isEmpty())
                        @foreach($announcements as $announcement)
                            <h4>{!! $announcement->title !!}</h4>
                            <div>
                                {!! $announcement->body !!}
                            </div>
                            <hr>
                        @endforeach
                    @else
                        <p>No Announcements</p>
                    @endif
                  </div>
                </div>            
            </div>

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">{!! $course->name !!} <a href="#" data-toggle="modal" data-target="#course_list" class="btn btn-default btn-xs pull-right">Switch Course</a></div>
                        <div class="panel-body">
                            @if (access()->instructor())
                            <h5>You are the instructor for this course</h5>
                            @else
                            <h5>Current Level: {!! $current_level->name !!}</h5>
                            @endif
                            <h5>Time: {!! $course->meeting !!}</h5>
                            <h5>Location: {!! $course->meeting_location !!}</h5>
                            <hr/>
                            <h5><a href="mailto:{!! $course->instructor_contact !!}">{!! $course->instructor_display_name !!}</a></h5>
                            <h5>Office: {!! $course->instructor_office_location !!}</h5>
                            <h5>Hours: {!! $course->office_hours !!}</h5>
                            @if($team_members)
                                <hr/>
                                <h6>Your Peer Group</h6>
                                <ul class="list-unstyled">
                                    @foreach($team_members as $team_member)
                                        <li><a href="mailto:{!! $team_member->email !!}">{!! $team_member->name !!}</a></li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                </div>
            </div>
            @if($feedback_requests)

                <div class="col-lg-6">
                    <div class="panel panel-default">
                      <div class="panel-heading">Peer Feedback Requests</div>
                      <div class="panel-body">
                            @foreach($feedback_requests as $feedback_request)
                                <h5>{!! $feedback_request->quest_name !!}</h5>
                                    <ul class="unstyled-list">
                                    @foreach($feedback_request->requests as $request)
                                        <li>{{ link_to('review/'.$feedback_request->quest_id.'/'.$request->sender->id.'/'.$request->revision, $request->sender->name) }}</li>
                                    @endforeach
                                    </ul>
                            @endforeach
                      </div>
                    </div>            
                </div>
            @endif
            <div class="col-lg-6">                
                <div class="panel panel-default">
                    <div class="panel-heading">Notifications</div>
                        <div class="panel-body">
                        <ul class="list-unstyled">
                        @if(!$notifications->isEmpty())
                                @foreach($notifications as $notice)
                                    <li>
                                        @if($notice->url)
                                        {{ link_to($notice->url, $notice->message) }}
                                        @else
                                        {!! $notice->message !!}
                                        @endif
                                        <a href="{!! url('notification/dismiss', [$notice->id]);!!}"><span class="glyphicon glyphicon-remove pull-right text-danger"></span></a>
                                    </li>
                                @endforeach
                            @else
                                <p>You have no new notifications</p>
                            @endif
                        </ul>                
                        </div>
                </div>

            </div>


        </div>
    </div>

<div class="modal fade" id="course_list" tabindex="-1" role="dialog" aria-labelledby="courseListLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="courseListLabel">Switch Course</h4>
      </div>
      <div class="modal-body">
        <ul class="list-unstyled">
        @foreach($courses as $class)
            <li> {!! link_to('course/switch/'.$class->id, $class->name) !!}
        @endforeach
        </ul>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop
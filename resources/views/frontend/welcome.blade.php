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
                            <h4>Current Level: {!! $current_level->name !!}</h4>
                            <h4>Time: {!! $course->meeting !!}</h4>
                            <h4>Location: {!! $course->meeting_location !!}</h4>
                            <hr/>
                            <h4><a href="mailto:{!! $course->instructor_contact !!}">{!! $course->instructor_display_name !!}</a></h4>
                            <h4>Office: {!! $course->instructor_office_location !!}</h4>
                            <h4>Hours: {!! $course->office_hours !!}</h4>
                            @if($team_members)
                                <hr/>
                                <h5>Your Peer Group</h5>
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
                                    <li>{{ link_to($notice->url, $notice->message) }}
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
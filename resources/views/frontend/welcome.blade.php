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
                        <p>No Announcements!</p>
                    @endif
                  </div>
                </div>            
            </div>

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">{!! $course->name !!} <a href="#" class="btn btn-default btn-xs pull-right">Switch Course</a></div>
                        <div class="panel-body">
                            <h4>Instructor: John Doe</h4>
                            <h4>Class Time: {!! $course->meeting !!}</h4>
                            <h4>Current Level: B+ (89/100)</h4>
                            <h5>Your Peer Group</h5>
                            <p>Edward Sharp, Joan Dawson, Donny Walker, Sally Fields</p>
                        </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Peer Feedback Requests</div>
                  <div class="panel-body">
                    <h4>Quest Name</h4>

                    <ul class="list-unstyled">
                        <li>{{ link_to('review/1', 'Edward Sharp') }}</li>
                        <li>{{ link_to('review/2', 'Joan Dawson') }}</li>
                    </ul>

                    <h4>Quest Name</h4>

                    <ul class="list-unstyled">
                        <li>{{ link_to('review/3', 'Donny Walker') }}</li>
                        <li>{{ link_to('review/4', 'Sally Fields') }}</li>
                    </ul>

                  </div>
                </div>            
            </div>

            <div class="col-lg-6">                
                <div class="panel panel-default">
                    <div class="panel-heading">Notifications</div>
                        <div class="panel-body">
                        <ul class="list-unstyled">
                        @if(!$notifications->isEmpty())
                                @foreach($notifications as $notice)
                                    <li>{{ link_to($notice->url, $notice->message) }}
                                    <span class="pull-right">{!! link_to('notification/dismiss/' . $notice->id, 'Dismiss', ['class' => 'btn btn-xs btn-danger']) !!}</span></li>
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
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop
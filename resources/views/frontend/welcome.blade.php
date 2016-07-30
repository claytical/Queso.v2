@extends('frontend.layouts.master')

@section('content')
   <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Announcements {{ link_to('announcements', 'View All', ['class' =>'btn btn-default btn-xs pull-right']) }}</div>
                  <div class="panel-body">
                    <h4>Announcement Headline</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>

                    <h4>Announcement Headline</h4>
                    <p>Donec id elit non mi porta gravida at eget metus. Cras mattis consectetur purus sit amet fermentum. Integer posuere erat a ante venenatis dapibus posuere velit aliquet. Maecenas sed diam eget risus varius blandit sit amet non magna.</p>
                    {!! var_dump(access()->user() !!}
                  </div>
                </div>            
            </div>

            <div class="col-lg-6">
                <div class="panel panel-default">
                    <div class="panel-heading">Class Name <a href="#" class="btn btn-default btn-xs pull-right">Switch Course</a></div>
                        <div class="panel-body">
                            <h4>Instructor: John Doe</h4>
                            <h4>Class Time: Wednesdays at 3pm</h4>
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
                            <li>Quest was graded</li>
                            <li>{{ link_to('quest/1/feedback', 'Feedback from Doris on Quest Name') }}</li>
                            <li>Someone did something</li>
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
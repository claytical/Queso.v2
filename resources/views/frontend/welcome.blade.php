@extends('frontend.layouts.master')

@section('content')
   <div class="row">
        <div class="col-lg-12">
            <div class="col-lg-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Peer Feedback Requests</div>
                  <div class="panel-body">
                    <h4>Quest Name</h4>

                    <ul class="list-unstyled">
                        <li>Student Name</li>
                        <li>Student Name</li>
                        <li>Student Name</li>
                    </ul>

                    <h4>Quest Name</h4>

                    <ul class="list-unstyled">
                        <li>Student Name</li>
                        <li>Student Name</li>
                        <li>Student Name</li>
                    </ul>

                    <h4>Quest Name</h4>

                    <ul class="list-unstyled">
                        <li>Student Name</li>
                        <li>Student Name</li>
                        <li>Student Name</li>
                    </ul>

                  </div>
                </div>            
            </div>

            <div class="col-lg-6">
                <div class="panel panel-default">
                  <div class="panel-heading">Class Name</div>
                  <div class="panel-body">
                    <h4>Instructor: John Doe</h4>
                    <h4>Class Time: Wednesdays at 3pm</h4>
                    <h4>Current Level: B+ (89/100)</h4>
                </div>

                <div class="panel panel-default">
                  <div class="panel-heading">Notifications</div>
                  <div class="panel-body">
                    <ul class="list-unstyled">
                        <li>Quest was graded</li>
                        <li>You got feedback on something</li>
                        <li>Someone did something</li>
                    </ul>                
                  </div>
            </div>

        </div>
    </div>
@endsection

@section('after-scripts-end')
    <script>
    </script>
@stop
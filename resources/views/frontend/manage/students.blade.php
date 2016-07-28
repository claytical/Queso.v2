@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Students</h2>
    </div>
</div>


<div class="row">
        <div class="col-lg-6">
            <h5>Student Name</h5>
        </div>
        <div class="col-lg-3">
            <h5>Current Grade</h5>
        </div>
        <div class="col-lg-3">
            <h5>Team</h5>
        </div>

        <div class="col-lg-12">
             <ul class="list-unstyled list">
                <li>
                    <div class="row">
                        <div class="col-lg-9 student">
                            {{ link_to('manage/student/1', 'Sally Fields') }}
                        </div>

                        <div class="col-lg-3 grade">
                            96 / 100
                        </div>
                        <div class="col-lg-3 team">
                            Red Team
                        </div>

                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-9 student">
                            {{ link_to('manage/student/1', 'Joan Rivers') }}
                        </div>

                        <div class="col-lg-3 grade">
                            26 / 100
                        </div>
                        <div class="col-lg-3 team">
                            Blue Team
                        </div>

                    </div>
                </li>

                <li>
                    <div class="row">
                        <div class="col-lg-9 student">
                            {{ link_to('manage/student/1', 'Dwayne Johnson') }}
                        </div>

                        <div class="col-lg-3 grade">
                            88 / 100
                        </div>
                        <div class="col-lg-3 team">
                            Green Team
                        </div>

                    </div>
                </li>

            </ul>
    </div>
</div>


@endsection

@section('after-scripts-end')
    <script>
  /*      var quest_list_options = {
        valueNames: [ 'submission', 'date', 'student' ]
    };
*/
//    var hackerList = new List('submission-list', submission_list_options);
    </script>
@stop
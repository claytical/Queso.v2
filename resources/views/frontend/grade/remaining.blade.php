@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
        <h2>{!! $quest->name !!}</h2>
        <p>Graded submission by STUDENT NAME</p>

</div>

<div class="col-lg-12">
    <h2>Remaining Submissions for Quest</h2>
            <div id="quest-list">
            <div class="col-lg-12">
                    <div class="col-lg-9">
                        <h4>Student Name</h4>
                    </div>
                    <div class="col-lg-3">
                        <h4>Submission Date</h4>
                    </div>
                  

                <ul class="list-unstyled list">
                    <li>
                            <div class="col-lg-9 student">
                                {{ link_to('grade/submission/1', 'Sally Fields') }}
                            </div>

                            <div class="col-lg-3 date">
                                00/00/0000
                            </div>
                    </li>

                    <li>
                            <div class="col-lg-9 student">
                                {{ link_to('grade/submission/1', 'Don Johnson') }}
                            </div>

                            <div class="col-lg-3 date">
                                00/00/0000
                            </div>
                    </li>
                    <li>
                            <div class="col-lg-9 student">
                                {{ link_to('grade/submission/1', 'Tom Hanks') }}
                            </div>

                            <div class="col-lg-3 date">
                                00/00/0000
                            </div>
                    </li>

                </ul>
            </div>
            </div>
        </div>

@endsection

@section('after-scripts-end')
    <script>
        var quest_list_options = {
        valueNames: [ 'student', 'date' ]
    };

    var questList = new List('quest-list', quest_list_options);
    </script>
@stop
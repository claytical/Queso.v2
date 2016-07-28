@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
        <h2>Quest Name</h2>
        <p>Graded submission by STUDENT NAME</p>
        <ul class="list-unstyled">
            <li>00 Skill name</li>
            <li>00 Skill name</li>
            <li>00 Skill name</li>
            <li>00 Skill name</li>
            <li></li>
            <li>00 Points Total</li>

        </ul>
</div>

<div class="col-lg-12">
    <h2>Remaining Submissions for Quest</h2>
            <div id="quest-list">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-9">
                        <h4>Student Name</h4>
                    </div>
                    <div class="col-lg-3">
                        <h4>Submission Date</h4>
                    </div>

                </div>                  
                  

                <ul class="list-unstyled list">
                    <li>
                        <div class="row">
                            <div class="col-lg-9 student">
                                {{ link_to('quest/1/attempt/submission', 'Sally Fields') }}
                            </div>

                            <div class="col-lg-3 date">
                                00/00/0000
                            </div>
                        </div>
                    </li>

                    <li>
                        <div class="row">
                            <div class="col-lg-9 student">
                                {{ link_to('quest/1/attempt/submission', 'Don Johnson') }}
                            </div>

                            <div class="col-lg-3 date">
                                00/00/0000
                            </div>
                        </div>
                    </li>
                    <li>
                        <div class="row">
                            <div class="col-lg-9 student">
                                {{ link_to('quest/1/attempt/submission', 'Tom Hanks') }}
                            </div>

                            <div class="col-lg-3 date">
                                00/00/0000
                            </div>
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
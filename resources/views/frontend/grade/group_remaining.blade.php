@extends('frontend.layouts.master')

@section('content')
<div class="col-lg-12">
        <h2>Quest Name</h2>
        <p>Grades submitted for by STUDENT NAME, STUDENT NAME, STUDENT NAME</p>
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
    <h2>Students Remaining for This Quest</h2>
            <div id="quest-list">
                <div class="col-lg-12">
                            <h4>Student Name</h4>
                </div>
                  
                <div class="col-lg-9">
                    <ul class="list-unstyled list">
                        <li>
                                <div class="col-lg-9 student">
                                Sally Fields
                                </div>

                        </li>
                        <li>
                                <div class="col-lg-9 student">
                                Tom Hanks
                                </div>

                        </li>

                    </ul>
                </div>
                <div class="col-lg-3">
                    {{ link_to('grade/activity/1', 'Keep Going', ['class' => 'btn btn-default btn-lg']) }}
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
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
            <h5>Points</h5>
        </div>
        <div class="col-lg-3">
            <h5>Tags</h5>
        </div>

        <div class="col-lg-12">
             <ul class="list-unstyled list">
                <li>

                @foreach($students as $student)
                    @if($student->id != $user->id)
                        <div class="row">
                            <div class="col-lg-6 student">
                                {{ link_to('manage/student/'.$student->id, $student->name) }}
                            </div>

                            <div class="col-lg-3 grade">
                                {!! $student->skills()->sum('amount') !!}
                            </div>
                            <div class="col-lg-3 team">
                            </div>
                        </div>
                    @endif
                @endforeach
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
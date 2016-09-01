@extends('frontend.layouts.master')

@section('content')

<h2>Manage Students</h2>

@if(!$students->isEmpty())
<table class="table table-hover">
        <thead>
            <th>Name</th>
            <th>Points</th>
            <th></th>
        </thead>

        @foreach($students as $student)
            <tr>
                <td>{{ link_to('manage/student/'.$student->id, $student->name) }}</td>
                <td>{!! $student->skills()->where('course_id', '=', session('current_course'))->sum('amount') !!}</td>
                <td></td>
            </tr>
        @endforeach
</table>

@else
    <p class="lead">There are currently no students in this course.</p>
@endif

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
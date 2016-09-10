@extends('frontend.layouts.master')

@section('content')

<h2>Manage Students</h2>

@if(!$students->isEmpty())
<table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
        <thead>
            <th data-field="name" 
            data-sortable="true">Name</th>
            <th data-field="email" data-sortable="true">Email</th>
            <th data-field="points" 
            data-sortable="true">Points</th>
        </thead>

        @foreach($students as $student)
            <tr>
                <td>{{ link_to('manage/student/'.$student->id, $student->name) }}</td>
                <td><a href="mailto:{!! $student->email !!}">{!! $student->email !!}</td>
                <td>{!! $student->skills()->where('course_id', '=', session('current_course'))->sum('amount') !!}</td>
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
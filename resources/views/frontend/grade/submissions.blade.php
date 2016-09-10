@extends('frontend.layouts.master')

@section('content')
@if($lists)
<div class="col-lg-12">
    <h2>Ungraded Submissions</h2>
</div>

<div class="col-lg-12">
    <table class="table table-hover" data-toggle="table">
        <thead>
            <tr>
                <th data-field="name" 
                data-sortable="true"></th>
                <th data-field="submitted" 
                data-sortable="true">Submitted On</th>
                <th data-field="student" 
                data-sortable="true">Student</th>
            </tr>
        </thead>
        <tbody>
            @foreach($lists as $list)
                <tr>
                    <td>{{ link_to('grade/quest/'.$list['quest_id'].'/'.$list['attempt']->id, $list['quest']) }}</td>
                    <td>{!! date('m-d-Y', strtotime($list['attempt']->created_at)) !!}</td>
                    <td>{!! $list['student'] !!}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@else
    <h2>Ungraded Submissions</h2>
    <p class="lead">There are no submissions to grade!</p>
@endif
@endsection

@section('after-scripts-end')
    <script>
        var submission_list_options = {
        valueNames: [ 'submission', 'date', 'student' ]
    };

    var hackerList = new List('submission-list', submission_list_options);
    </script>
@stop
@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Announcements {{ link_to('manage/announcement/create', 'New Announcement', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>

@if(!$announcements->isEmpty())
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
            <thead>
                <th data-field="name" 
            data-sortable="true">Headline</th>
                <th data-field="date" 
            data-sortable="true">Date</th>
                <th></th>
            </thead>
            <tbody>
                @foreach($announcements as $announcement)
                    <tr>
                        <td>{{ link_to('manage/announcement/' . $announcement->id, $announcement->title) }}</td>
                        <td>{!! date('m-d-Y', strtotime($announcement->created_at)) !!}</td>
                        <td>
                            @if($announcement->sticky)
                                <a class="btn btn-default" href="{!! url('manage/announcement/'.$announcement->id.'/hide');!!}"><span class="glyphicon glyphicon-eye-close"></span> Hide</a>

                            @else
                                <a class="btn btn-default" href="{!! url('manage/announcement/'.$announcement->id.'/show');!!}"><span class="glyphicon glyphicon-eye-open"></span> Show</a>

                            @endif
                                <a class="btn btn-danger" href="{!! url('manage/announcement/'.$announcement->id.'/delete');!!}"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
    </table>
@else
<p class="lead">There are currently no announcements.</p>
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
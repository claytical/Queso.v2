@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Announcements {{ link_to('manage/announcement/create', 'New Announcement', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>

@if(!$announcements->isEmpty())

    <div class="row">
            <div class="col-lg-6">
                <h5>Headline</h5>
            </div>
            <div class="col-lg-3">
                <h5>Date</h5>
            </div>
            <div class="col-lg-3">
            </div>
        <div class="col-lg-12">
             <ul class="list-unstyled list">
                @foreach($announcements as $announcement)
                <li>
                    <div class="row">
                        <div class="col-lg-6 announcement">
                            {{ link_to('manage/announcement/' . $announcement->id, $announcement->title) }}
                        </div>

                        <div class="col-lg-3 date">
                            {!! date('m-d-Y', strtotime($announcement->created_at)) !!}
                        </div>

                        <div class="col-lg-3">
                            @if($announcement->sticky)
                                <a class="btn btn-default" href="{!! url('manage/announcement/'.$announcement->id.'/hide');!!}"><span class="glyphicon glyphicon-eye-close"></span> Hide</a>

                            @else
                                <a class="btn btn-default" href="{!! url('manage/announcement/'.$announcement->id.'/show');!!}"><span class="glyphicon glyphicon-eye-open"></span> Show</a>

                            @endif
                                <a class="btn btn-danger" href="{!! url('manage/announcement/'.$announcement->id.'/delete');!!}"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                        </div>
 
                    </div>
                </li>
                @endforeach
            </ul>
    </div>
</div>
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
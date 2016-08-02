@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Announcements {{ link_to('manage/announcement/create', 'New Announcement', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>

{!! var_dump($announcements) !!}
<div class="row">
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
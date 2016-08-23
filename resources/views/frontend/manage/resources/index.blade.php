@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Resources {{ link_to('manage/resources/create', 'New Resource', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>
@if(!$resources->isEmpty())

@else
<p class="lead">There are currently no resources.</p>
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
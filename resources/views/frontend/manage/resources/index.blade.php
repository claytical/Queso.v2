@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Resources {{ link_to('manage/resources/create', 'New Resource', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>

@if(!$resources->isEmpty())
<div class="row">
        <div class="col-lg-6">
            <h5><em>Name</em></h5>
        </div>
        <div class="col-lg-3">
            <h5><em>Category</em></h5>
        </div>
        <div class="col-lg-3">

        </div>

        <div class="col-lg-12">
             <ul class="list-unstyled list">
                <li>
                    <div class="row">
                        @foreach($resources as $resource)
                            <div class="col-lg-6 name">
                                {{ link_to('manage/resource/' . $resource->id, $resource->title) }}
                            </div>

                            <div class="col-lg-3 category">
                                {{ $resource->tag }}
                            </div>

                            <div class="col-lg-3">
                                <a class="btn btn-danger" href="{!! url('manage/resource/'.$resource->id.'/delete');!!}"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                            </div>
                        @endforeach
                    </div>
                </li>
            </ul>
    </div>
</div>
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
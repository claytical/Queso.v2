@extends('frontend.layouts.master')

@section('content')
<div class="row">
    <div class="col-lg-12">
        <h2>Manage Resources {{ link_to('manage/resources/create', 'New Resource', ['class' => 'btn btn-primary btn-lg pull-right']) }}</h2>
    </div>
</div>
@if(!$resources->isEmpty())
    <table class="table table-hover" data-toggle="table" data-classes="table-no-bordered">
            <thead>
                <th data-field="name" 
            data-sortable="true">Name</th>
                <th data-field="tag" 
            data-sortable="true">Tag</th>
                <th></th>
            </thead>
        @foreach($resources as $resource)
            <tr>
                <td>
                    {{ link_to('manage/resource/' . $resource->id, $resource->title) }}
                </td>

                <td>
                    {{ $resource->tag }}
                </td>

                <td>
                    <a class="btn btn-danger pull-right" data-toggle="modal" data-target="#resource-{!! $resource->id !!}" href="#"><span class="glyphicon glyphicon-trash"></span> Delete</a>
                </td>
            </tr>
        @endforeach
    </table>
    @foreach($resources as $resource)

        <div class="modal fade" tabindex="-1" role="dialog" id="resource-{!! $resource->id !!}">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">{!! $resource->title !!}</h4>
              </div>
              <div class="modal-body">
                <p>Are you sure you want to delete this resource?</p>
                    
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                   {{ link_to('manage/resource/'.$resource->id.'/delete', 'Delete', ['class' => 'btn btn-primary']) }}
              </div>
            </div><!-- /.modal-content -->
          </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->    
    @endforeach


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